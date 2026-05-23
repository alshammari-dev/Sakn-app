<?php

namespace App\Http\Controllers;

use App\Models\SaleApproval;
use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleApprovalController extends Controller
{
    public function __construct()
    {
         $this->middleware('permission:sale-approval-list|sale-approval-create|sale-approval-edit|sale-approval-delete', ['only' => ['index','show']]);
         $this->middleware('permission:sale-approval-create', ['only' => ['create','store']]);
         $this->middleware('permission:sale-approval-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:sale-approval-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $saleApprovals = SaleApproval::with(['property', 'deposit', 'approvedBy'])->latest()->get();
        return view('sale-approvals.index', compact('saleApprovals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'deposit_id'  => 'required|exists:deposits,id',
            'notes'       => 'nullable|string',
        ]);

        return DB::transaction(function () use ($request) {
            // 1. تسجيل الموافقة النهائية
            SaleApproval::create([
                'property_id' => $request->property_id,
                'deposit_id'  => $request->deposit_id,
                'approved_by' => auth()->id(),
                'notes'       => $request->notes,
                'approved_at' => now(),
            ]);

            // 2. تحديث حالة العقار نهائياً
            $deposit = Deposit::findOrFail($request->deposit_id);
            $deposit->property->update(['status' => 'sold']);

            return redirect()->route('deposits.show', $request->deposit_id)
                ->with('success', 'The deal has been finalized and the property is now marked as SOLD.');
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(SaleApproval $saleApproval)
    {
        $saleApproval->load(['property', 'deposit', 'approvedBy']);
        return view('sale-approvals.show', compact('saleApproval'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SaleApproval $saleApproval)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SaleApproval $saleApproval)
    {
        $request->validate([
            'notes' => 'nullable|string',
        ]);

        $saleApproval->update([
            'notes' => $request->notes,
        ]);

        return redirect()->route('sale-approvals.index')
            ->with('success', 'Sale approval updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SaleApproval $saleApproval)
    {
        DB::transaction(function () use ($saleApproval) {
            // If deleting sale approval, revert the property back to reserved or re-sync status
            $property = $saleApproval->property;
            $saleApproval->delete();
            $property->syncStatus();
        });

        return redirect()->route('sale-approvals.index')
            ->with('success', 'Sale approval deleted successfully.');
    }
}
