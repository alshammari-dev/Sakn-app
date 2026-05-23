<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\User;
use App\Models\Property;
use App\Exports\DynamicExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class VisitController extends Controller
{
    public function __construct()
    {
         $this->middleware('permission:visit-list|visit-create|visit-edit|visit-delete', ['only' => ['index','show']]);
         $this->middleware('permission:visit-create', ['only' => ['create','store']]);
         $this->middleware('permission:visit-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:visit-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = Visit::with(['property', 'client', 'agent']);

        if ($user->hasRole('admin')) {
            $agents = User::role('sale-agent')->get();
            if ($request->filled('agent_id')) {
                $query->forAgent($request->agent_id);
            }
        } else {
            $query->where('agent_id', $user->id);
            $agents = collect();
        }

        $visits = $query->search($request->search)
            ->withStatus($request->status)
            ->latest('scheduled_at')
            ->paginate(10);

        return view('visits.index', compact('visits', 'agents'));
    }

    /**
     * Export visits to Excel
     */
    public function export() 
    {
        $user = auth()->user();
        $query = Visit::with(['property', 'client', 'agent']);

        if (!$user->hasRole('admin')) {
            $query->where('agent_id', $user->id);
        }

        $data = $query->get()->map(function($visit) {
            return [
                'id' => $visit->id,
                'property' => $visit->property->title ?? '-',
                'client' => $visit->client->name ?? '-',
                'agent' => $visit->agent->name ?? '-',
                'scheduled_at' => $visit->scheduled_at ? $visit->scheduled_at->format('Y-m-d H:i:s') : '-',
                'status' => $visit->status,
            ];
        });
        $headings = ['ID', 'Property', 'Client', 'Agent', 'Scheduled At', 'Status'];

        return Excel::download(new DynamicExport($data, $headings), 'visits.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $properties = Property::available()->get();
        $clients = User::role('client')->get();
        $agents = User::role('sale-agent')->get();
        return view('visits.create', compact('properties', 'clients', 'agents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'property_id'  => 'required|exists:properties,id',
            'client_id'    => 'required|exists:users,id',
            'agent_id'     => 'nullable|exists:users,id',
            'scheduled_at' => 'required|date',
            'status'       => 'required|in:pending,approved,rejected,completed,cancelled',
            'notes'        => 'nullable|string',
        ]);

        $visit = Visit::create($request->all());

        // Sync status of property
        if ($visit->property) {
            $visit->property->syncStatus();
        }

        return redirect()->route('visits.index')
            ->with('success', 'Visit scheduled successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Visit $visit)
    {
        $visit->load(['property', 'client', 'agent']);
        return view('visits.show', compact('visit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visit $visit)
    {
        $properties = Property::all();
        $clients = User::role('client')->get();
        $agents = User::role('sale-agent')->get();
        return view('visits.edit', compact('visit', 'properties', 'clients', 'agents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Visit $visit)
    {
        $request->validate([
            'property_id'  => 'sometimes|required|exists:properties,id',
            'client_id'    => 'sometimes|required|exists:users,id',
            'agent_id'     => 'nullable|exists:users,id',
            'scheduled_at' => 'sometimes|required|date',
            'status'       => 'sometimes|required|in:pending,approved,rejected,completed,cancelled',
            'notes'        => 'nullable|string',
        ]);

        $visit->update($request->all());

        if ($visit->property) {
            $visit->property->syncStatus();
        }

        return redirect()->route('visits.index')
            ->with('success', 'Visit updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visit $visit)
    {
        $property = $visit->property;
        $visit->delete();

        if ($property) {
            $property->syncStatus();
        }

        return redirect()->route('visits.index')
            ->with('success', 'Visit deleted successfully.');
    }

    /**
     * Quick update of visit status/agent
     */
    public function quickUpdate(Request $request, Visit $visit)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,approved,rejected,completed,cancelled',
            'agent_id' => 'nullable|exists:users,id'
        ]);

        $property = $visit->property;
        $newStatus = $request->status;

        if ($newStatus === 'approved' && $visit->scheduled_at->isPast()) {
            return back()->with('error', 'لا يمكن الموافقة على موعد قديم! يرجى طلب تعديل الموعد من العميل أولاً.');
        }

        if (in_array($newStatus, ['approved', 'completed']) && in_array($property->status, ['sold', 'reserved'])) {
            return back()->with('error', 'عذراً، هذا العقار لم يعد متاحاً للتفاوض أو الزيارة حالياً.');
        }

        $visit->update($data);
        $property->syncStatus();

        return back()->with('success', 'تم تحديث حالة الزيارة ومزامنة حالة العقار بنجاح!');
    }
}
