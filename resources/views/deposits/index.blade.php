@extends('layouts.dashboard')

@section('main')
    <x-sakn-index-page 
        title="Deposits Management" 
        subtitle="Manage property deposits and transaction approvals"
        :createRoute="route('deposits.create')"
        createLabel="New Deposit"
        :hasFilters="true"
    >
        @slot('filters')
            <form action="{{ route('deposits.index') }}" method="GET" class="row g-3 align-items-center">
                <div class="col-md-4">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-white border-end-0 text-muted" style="border-color: #e0d8c3;">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Search property or client..." value="{{ request('search') }}" style="border-color: #e0d8c3; font-size: 0.85rem;">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select form-select-sm text-capitalize" style="border-color: #e0d8c3; font-size: 0.85rem;">
                        <option value="">All Statuses</option>
                        @foreach(['pending', 'approved', 'rejected', 'refunded'] as $status)
                            <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5 d-flex justify-content-end gap-2 ms-auto">
                    <button type="submit" class="btn btn-sm px-4" style="background-color: #2F4F3E; color: #fff; border-radius: 8px; font-weight: 600; border: none; transition: 0.2s;" onmouseover="this.style.backgroundColor='#1a2e24'" onmouseout="this.style.backgroundColor='#2F4F3E'">
                        <i class="bi bi-funnel me-1"></i> Filter
                    </button>
                    <a href="{{ route('deposits.index') }}" class="btn btn-sm sakn-btn-outline px-3" style="border-radius: 8px;">Reset</a>
                    
                    <div class="border-start mx-1" style="height: 30px; border-color: #e0d8c3 !important;"></div>
                    
                    <a href="{{ route('deposits.export') }}" class="btn btn-sm shadow-sm px-3" style="border: 1px solid #c3e6cb; background-color: #d4edda; color: #155724; border-radius: 8px; font-weight: 600; transition: 0.2s; display: inline-flex; align-items: center;" onmouseover="this.style.backgroundColor='#c3e6cb'" onmouseout="this.style.backgroundColor='#d4edda'">
                        <i class="bi bi-file-earmark-spreadsheet me-1"></i> Export Excel
                    </a>
                </div>
            </form>
        @endslot

        <thead>
            <tr>
                <th class="ps-4">ID</th>
                <th>Property</th>
                <th>Client / Agent</th>
                <th>Amount</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($deposits as $deposit)
            <tr>
                <td class="ps-4"><span class="text-muted fw-bold">#{{ $deposit->id }}</span></td>
                <td>
                    <div class="fw-bold" style="color: #2F4F3E;">{{ $deposit->property->title ?? 'N/A' }}</div>
                    <small class="text-muted"><i class="bi bi-geo-alt me-1"></i>{{ $deposit->property->city }}</small>
                </td>
                <td>
                    <div class="small"><i class="bi bi-person text-primary"></i> {{ optional($deposit->client)->name ?? 'Unknown' }}</div>
                    <div class="text-muted" style="font-size: 11px;"><i class="bi bi-person-badge me-1"></i> Agent: {{ optional($deposit->approvedBy)->name ?? 'System' }}</div>
                </td>
                <td><span class="fw-bold text-dark">${{ number_format($deposit->amount) }}</span></td>
                <td>
                    <x-sakn-status-badge :status="$deposit->status" type="deposit" />
                </td>
                <td class="text-center pe-4">
                    <div class="btn-group shadow-sm" role="group" style="border-radius: 8px; overflow: hidden;">
                        <a href="{{ route('deposits.show', $deposit->id) }}" class="btn btn-sm sakn-btn-outline" title="View">
                            <i class="bi bi-eye"></i>
                        </a>

                        @if($deposit->status === 'pending')
                            <form action="{{ route('deposits.approve', $deposit->id) }}" method="POST" class="d-inline">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-sm sakn-btn-outline text-success" title="Approve">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                            </form>

                            <form action="{{ route('deposits.reject', $deposit->id) }}" method="POST" class="d-inline">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-sm sakn-btn-outline text-danger" title="Reject">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </form>
                        @endif

                        <form action="{{ route('deposits.destroy', $deposit->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete record?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm sakn-btn-outline" title="Delete" style="border-left: none;">
                                <i class="bi bi-trash3 text-danger"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-5">
                        <i class="bi bi-cash-stack display-4 text-muted"></i>
                        <p class="mt-2 text-muted">No deposit records found.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>

        @slot('pagination')
            @if(method_exists($deposits, 'links'))
                {{ $deposits->links() }}
            @endif
        @endslot
    </x-sakn-index-page>
@endsection
