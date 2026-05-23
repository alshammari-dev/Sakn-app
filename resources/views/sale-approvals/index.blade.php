@extends('layouts.dashboard')

@section('main')
    <x-sakn-index-page 
        title="Sale Approvals" 
        subtitle="Manage final sale approvals and contracts"
        :createRoute="null"
    >
        <thead>
            <tr>
                <th class="ps-4">ID & Date</th>
                <th>Property</th>
                <th>Deposit Ref</th>
                <th>Approved By</th>
                <th>Notes</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($saleApprovals as $approval)
            <tr>
                <td class="ps-4">
                    <span class="fw-bold text-dark d-block">#{{ $approval->id }}</span>
                    <small class="text-muted"><i class="bi bi-calendar-check me-1"></i>{{ \Carbon\Carbon::parse($approval->approved_at)->format('M d, Y') }}</small>
                </td>
                <td>
                    <div class="fw-bold text-sakn">{{ $approval->property->title ?? 'N/A' }}</div>
                    <small class="text-muted"><i class="bi bi-geo-alt-fill me-1 text-gold"></i>{{ $approval->property->city ?? '' }}</small>
                </td>
                <td>
                    <span class="badge bg-sakn-light text-sakn border border-sakn">
                        <i class="bi bi-cash-stack me-1"></i> Dep #{{ $approval->deposit->id ?? 'N/A' }}
                    </span>
                </td>
                <td>
                    <span class="badge" style="background-color: #F5F2EC; color: #2F4F3E; border: 1px solid #e0d8c3;">
                        <i class="bi bi-person-check-fill me-1"></i> {{ $approval->approver->name ?? 'System' }}
                    </span>
                </td>
                <td>
                    <span class="text-muted small text-truncate d-inline-block" style="max-width: 200px;" title="{{ $approval->notes }}">
                        {{ $approval->notes ?: 'No notes provided' }}
                    </span>
                </td>
                <td class="text-center pe-4">
                    <div class="btn-group shadow-sm" role="group" style="border-radius: 8px; overflow: hidden;">
                        <a href="#" class="btn btn-sm sakn-btn-outline" title="View">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="#" class="btn btn-sm sakn-btn-outline" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a href="#" class="btn btn-sm sakn-btn-outline text-danger" title="Delete" style="border-left: none;">
                            <i class="bi bi-trash3"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-5">
                        <i class="bi bi-check2-all display-4 text-muted"></i>
                        <p class="mt-2 text-muted">No sale approvals found in the system.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>

        @slot('pagination')
            @if(method_exists($saleApprovals, 'links'))
                {{ $saleApprovals->links() }}
            @endif
        @endslot
    </x-sakn-index-page>
@endsection
