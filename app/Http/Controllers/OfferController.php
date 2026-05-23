<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\User;
use App\Models\Property;
use App\Exports\DynamicExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    public function __construct()
    {
         $this->middleware('permission:offer-list|offer-create|offer-edit|offer-delete', ['only' => ['index','show']]);
         $this->middleware('permission:offer-create', ['only' => ['create','store']]);
         $this->middleware('permission:offer-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:offer-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = Offer::with(['property', 'client', 'agent']);

        // Apply filters
        $query->filter($request->only(['status', 'search']));

        if ($user->hasRole('admin')) {
            $offers = $query->latest()->paginate(15);
            $agents = User::role('sale-agent')->get();
        } else {
            $offers = $query->where('agent_id', $user->id)->latest()->paginate(15);
            $agents = collect();
        }

        return view('offers.index', compact('offers', 'agents'));
    }

    /**
     * Export offers to Excel
     */
    public function export() 
    {
        $user = auth()->user();
        $query = Offer::with(['property', 'client', 'agent']);

        if (!$user->hasRole('admin')) {
            $query->where('agent_id', $user->id);
        }

        $data = $query->get()->map(function($offer) {
            return [
                'id' => $offer->id,
                'property' => $offer->property->title ?? '-',
                'client' => $offer->client->name ?? '-',
                'agent' => $offer->agent->name ?? '-',
                'offered_price' => $offer->offered_price,
                'status' => $offer->status,
            ];
        });
        $headings = ['ID', 'Property', 'Client', 'Agent', 'Offered Price', 'Status'];

        return Excel::download(new DynamicExport($data, $headings), 'offers.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $properties = Property::available()->get();
        $clients = User::role('client')->get();
        $agents = User::role('sale-agent')->get();
        return view('offers.create', compact('properties', 'clients', 'agents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'property_id'   => 'required|exists:properties,id',
            'client_id'     => 'required|exists:users,id',
            'agent_id'      => 'nullable|exists:users,id',
            'offered_price' => 'required|numeric|min:0',
            'offer_type'    => 'required|in:negotiation,direct_purchase',
            'status'        => 'required|in:pending,accepted,rejected,cancelled',
            'notes'         => 'nullable|string',
        ]);

        return DB::transaction(function () use ($request) {
            $offer = Offer::create($request->all());
            
            // Sync status of property
            if ($offer->property) {
                $offer->property->syncStatus();
            }

            return redirect()->route('offers.index')
                ->with('success', 'Offer placed successfully.');
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer)
    {
        $offer->load(['property', 'client', 'agent']);
        return view('offers.show', compact('offer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Offer $offer)
    {
        $properties = Property::all();
        $clients = User::role('client')->get();
        $agents = User::role('sale-agent')->get();
        return view('offers.edit', compact('offer', 'properties', 'clients', 'agents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Offer $offer)
    {
        $request->validate([
            'property_id'   => 'sometimes|required|exists:properties,id',
            'client_id'     => 'sometimes|required|exists:users,id',
            'agent_id'      => 'nullable|exists:users,id',
            'offered_price' => 'sometimes|required|numeric|min:0',
            'offer_type'    => 'sometimes|required|in:negotiation,direct_purchase',
            'status'        => 'sometimes|required|in:pending,accepted,rejected,cancelled',
            'notes'         => 'nullable|string',
        ]);

        return DB::transaction(function () use ($request, $offer) {
            $offer->update($request->all());

            if ($offer->property) {
                $offer->property->syncStatus();
            }

            return redirect()->route('offers.index')
                ->with('success', 'Offer updated successfully.');
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer)
    {
        $property = $offer->property;

        DB::transaction(function () use ($offer, $property) {
            $offer->delete();
            if ($property) {
                $property->syncStatus();
            }
        });

        return redirect()->route('offers.index')
            ->with('success', 'Offer deleted successfully.');
    }

    /**
     * Quick update of offer status/agent
     */
    public function quickUpdate(Request $request, Offer $offer)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,accepted,rejected,cancelled',
            'agent_id' => 'nullable|exists:users,id',
            'notes' => 'nullable|string'
        ]);

        if ($request->status === 'accepted' && $offer->property->status === 'reserved') {
            return back()->withErrors([
                'status' => 'Action Denied! This property is already RESERVED by a deposit. You cannot accept new offers.'
            ])->withInput();
        }

        try {
            DB::transaction(function () use ($offer, $data) {
                $offer->update($data);
                $offer->property->syncStatus();
            });

            return back()->with('success', 'Offer updated and property status synchronized!');

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
