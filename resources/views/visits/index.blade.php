@extends('layouts.dashboard')

@section('main')
    <x-sakn-index-page 
        title="Visits Management " 
        subtitle="Manage and track property visits and client schedules"
        :hasFilters="true"
    >
        @slot('filters')
            <form action="{{ route('visits.index') }}" method="GET" class="row g-3 align-items-center">
                <div class="col-md-3">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-white border-end-0 text-muted" style="border-color: #e0d8c3;">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Search property or client..." value="{{ request('search') }}" style="border-color: #e0d8c3; font-size: 0.85rem;">
                    </div>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select form-select-sm text-capitalize" style="border-color: #e0d8c3; font-size: 0.85rem;">
                        <option value="">All Statuses</option>
                        @foreach(['pending','approved','completed','rejected','cancelled'] as $status)
                            <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </div>
                @if(count($agents) > 0)
                <div class="col-md-2">
                    <select name="agent_id" class="form-select form-select-sm text-capitalize" style="border-color: #e0d8c3; font-size: 0.85rem;">
                        <option value="">All Agents</option>
                        @foreach($agents as $agent)
                            <option value="{{ $agent->id }}" {{ request('agent_id') == $agent->id ? 'selected' : '' }}>{{ $agent->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div class="col-md-5 d-flex justify-content-end gap-2 ms-auto">
                    <button type="submit" class="btn btn-sm px-4" style="background-color: #2F4F3E; color: #fff; border-radius: 8px; font-weight: 600; border: none; transition: 0.2s;" onmouseover="this.style.backgroundColor='#1a2e24'" onmouseout="this.style.backgroundColor='#2F4F3E'">
                        <i class="bi bi-funnel me-1"></i> Filter
                    </button>
                    <a href="{{ route('visits.index') }}" class="btn btn-sm sakn-btn-outline px-3" style="border-radius: 8px;">Reset</a>
                    
                    <div class="border-start mx-1" style="height: 30px; border-color: #e0d8c3 !important;"></div>
                    
                    <a href="{{ route('visits.export') }}" class="btn btn-sm shadow-sm px-3" style="border: 1px solid #c3e6cb; background-color: #d4edda; color: #155724; border-radius: 8px; font-weight: 600; transition: 0.2s; display: inline-flex; align-items: center;" onmouseover="this.style.backgroundColor='#c3e6cb'" onmouseout="this.style.backgroundColor='#d4edda'">
                        <i class="bi bi-file-earmark-spreadsheet me-1"></i> Export Excel
                    </a>
                </div>
            </form>
        @endslot

        <thead>
            <tr class="text-uppercase" style="font-size: 11px; letter-spacing: 1px;">
                <th class="ps-4">ID & Property</th>
                <th>Scheduled At</th>
                <th>Sales Agent</th>
                <th>Status Control</th>
                <th class="text-center">Note</th>
            </tr>
        </thead>
        <tbody>
            @foreach($visits as $visit)
            @php 
                $isExpired = \Carbon\Carbon::parse($visit->scheduled_at)->isPast() && $visit->status == 'pending';
            @endphp
            <tr class="{{ $isExpired ? 'table-danger' : '' }}">
                <td class="ps-4">
                    <div class="fw-bold text-dark">{{ $visit->id }} - {{ optional($visit->property)->title ?? 'N/A' }}</div>
                    <small class="text-muted"><i class="bi bi-person-badge"></i> {{ optional($visit->client)->name ?? 'Unknown' }}</small>
                </td>
                <td>
                    <div class="d-flex flex-column">
                        <span class="{{ $isExpired ? 'text-danger fw-bold' : '' }}">
                            {{ \Carbon\Carbon::parse($visit->scheduled_at)->format('M d, h:i A') }}
                        </span>
                        @if($isExpired)
                            <small class="text-danger fw-bold" style="font-size: 9px;">[EXPIRED - ACTION REQUIRED]</small>
                        @endif
                    </div>
                </td>
                
                <td>
                    @if(auth()->user()->hasRole('admin'))
                        <form action="{{ route('visits.quickUpdate', $visit->id) }}" method="POST">
                            @csrf @method('PUT')
                            <select name="agent_id" onchange="this.form.submit()" class="form-select form-select-sm border-sakn {{ $isExpired ? 'bg-light' : '' }}">
                                <option value="">Assign Agent</option>
                                @foreach($agents as $agent)
                                    <option value="{{ $agent->id }}" {{ $visit->agent_id == $agent->id ? 'selected' : '' }}>
                                        {{ $agent->name }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="status" value="{{ $visit->status }}">
                        </form>
                    @else
                        <span class="badge" style="background-color: #F5F2EC; color: #2F4F3E; border: 1px solid #e0d8c3;">{{ optional($visit->agent)->name ?? 'Unassigned' }}</span>
                    @endif
                </td>

                <td>
                    <form action="{{ route('visits.quickUpdate', $visit->id) }}" method="POST">
                        @csrf @method('PUT')
                        <select name="status" onchange="this.form.submit()" 
                            class="form-select form-select-sm fw-bold
                            @if($visit->status == 'pending') border-gold text-gold 
                            @elseif($visit->status == 'approved') border-sakn text-sakn 
                            @elseif($visit->status == 'completed') border-sakn-dark text-sakn-dark 
                            @elseif($visit->status == 'rejected' || $visit->status == 'cancelled') border-secondary text-secondary
                            @endif">
                            
                            @if($isExpired)
                                <option value="pending" disabled selected>Expired</option>
                                <option value="cancelled">Cancel</option>
                                <option value="rejected">Reject</option>
                            @else
                                <option value="pending" {{ $visit->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $visit->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="completed" {{ $visit->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="rejected" {{ $visit->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                <option value="cancelled" {{ $visit->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            @endif
                        </select>
                    </form>
                </td>

                <td class="text-center">
                    <button type="button" class="btn btn-sm {{ $visit->notes ? 'btn-primary' : 'btn-outline-secondary' }}" data-bs-toggle="modal" data-bs-target="#noteModal{{ $visit->id }}">
                        <i class="bi bi-chat-dots"></i>
                    </button>

                    <div class="modal fade" id="noteModal{{ $visit->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-light border-0">
                                    <h6 class="modal-title">Client Message: {{ optional($visit->client)->name ?? 'Unknown' }}</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <p class="mb-0 p-3 bg-light rounded shadow-sm text-dark italic">
                                        "{{ $visit->notes ?? 'No specific notes provided.' }}"
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
            @if(method_exists($visits, 'links'))
                {{ $visits->links() }}
            @endif
        @endslot
    </x-sakn-index-page>
@endsection
