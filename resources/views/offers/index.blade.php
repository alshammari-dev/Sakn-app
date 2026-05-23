@extends('layouts.dashboard')

@section('main')
    <x-sakn-index-page 
        title="Purchase Offers & Negotiations" 
        subtitle="Manage client offers and price negotiations"
        :hasFilters="true"
    >
        @slot('filters')
            <form action="{{ route('offers.index') }}" method="GET" class="row g-3 align-items-center">
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
                        @foreach(['pending', 'accepted', 'rejected', 'cancelled'] as $status)
                            <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5 d-flex justify-content-end gap-2 ms-auto">
                    <button type="submit" class="btn btn-sm px-4" style="background-color: #2F4F3E; color: #fff; border-radius: 8px; font-weight: 600; border: none; transition: 0.2s;" onmouseover="this.style.backgroundColor='#1a2e24'" onmouseout="this.style.backgroundColor='#2F4F3E'">
                        <i class="bi bi-funnel me-1"></i> Filter
                    </button>
                    <a href="{{ route('offers.index') }}" class="btn btn-sm sakn-btn-outline px-3" style="border-radius: 8px;">Reset</a>
                    
                    <div class="border-start mx-1" style="height: 30px; border-color: #e0d8c3 !important;"></div>
                    
                    <a href="{{ route('offers.export') }}" class="btn btn-sm shadow-sm px-3" style="border: 1px solid #c3e6cb; background-color: #d4edda; color: #155724; border-radius: 8px; font-weight: 600; transition: 0.2s; display: inline-flex; align-items: center;" onmouseover="this.style.backgroundColor='#c3e6cb'" onmouseout="this.style.backgroundColor='#d4edda'">
                        <i class="bi bi-file-earmark-spreadsheet me-1"></i> Export Excel
                    </a>
                </div>
            </form>
        @endslot

        <thead>
            <tr>
                <th class="text-start ps-4">Property & Client</th>
                <th>Original</th>
                <th>Offered</th>
                <th>Difference</th>
                <th>Type</th>
                <th>Agent</th>
                <th>Status</th>
                <th class="text-center">Note</th>
            </tr>
        </thead>
        <tbody>
            @foreach($offers as $offer)
            @php 
                $diff = $offer->offered_price - $offer->property->price;
                $diffClass = $diff >= 0 ? 'text-success' : 'text-danger';
            @endphp
            <tr>
                <td class="text-start ps-4">
                    <span class="fw-bold" style="color: #2F4F3E;">{{ optional($offer->property)->title ?? 'N/A' }}</span><br>
                    <small class="text-muted"><i class="bi bi-person"></i> {{ optional($offer->client)->name ?? 'Unknown' }}</small>
                </td>
                <td class="text-muted small">${{ number_format(optional($offer->property)->price ?? 0) }}</td>
                <td class="fw-bold text-primary">${{ number_format($offer->offered_price) }}</td>
                <td class="{{ $diffClass }} fw-bold small">
                    {{ $diff > 0 ? '+' : '' }}${{ number_format($diff) }}
                </td>
                <td>
                    <span class="badge border text-dark fw-normal">{{ str_replace('_', ' ', ucfirst($offer->offer_type)) }}</span>
                </td>
                <td>
                    @if(auth()->user()->hasRole('admin'))
                        <form action="{{ route('offers.quickUpdate', $offer->id) }}" method="POST">
                            @csrf @method('PUT')
                            <select name="agent_id" onchange="this.form.submit()" class="form-select form-select-sm">
                                <option value="">Assign Agent</option>
                                @foreach($agents as $agent)
                                    <option value="{{ $agent->id }}" {{ $offer->agent_id == $agent->id ? 'selected' : '' }}>{{ $agent->name }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="status" value="{{ $offer->status }}">
                        </form>
                    @else
                        <span class="badge bg-light text-dark">{{ optional($offer->agent)->name ?? 'Unassigned' }}</span>
                    @endif
                </td>
                <td>
                    <form action="{{ route('offers.quickUpdate', $offer->id) }}" method="POST">
                        @csrf @method('PUT')
                        <select name="status" onchange="this.form.submit()" class="form-select form-select-sm fw-bold">
                            <option value="pending" {{ $offer->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="accepted" {{ $offer->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                            <option value="rejected" {{ $offer->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            <option value="cancelled" {{ $offer->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </form>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-sm {{ $offer->notes ? 'btn-primary' : 'btn-outline-secondary' }}" data-bs-toggle="modal" data-bs-target="#noteModal{{ $offer->id }}">
                        <i class="bi bi-chat-left-text"></i>
                    </button>

                    <div class="modal fade" id="noteModal{{ $offer->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content text-start">
                                <div class="modal-header bg-light border-0">
                                    <h6 class="modal-title">Notes: {{ optional($offer->client)->name ?? 'Unknown' }}</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="mb-0 p-3 bg-light rounded shadow-sm text-dark italic">
                                        "{{ $offer->notes ?? 'No additional notes provided.' }}"
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>

        @slot('pagination')
            @if(method_exists($offers, 'links'))
                {{ $offers->appends(request()->query())->links() }}
            @endif
        @endslot
    </x-sakn-index-page>
@endsection
