@extends('layouts.dashboard')

@section('main')
    <x-sakn-index-page 
        title="Properties Management" 
        subtitle="Manage and track your real estate listings"
        :createRoute="route('properties.create')"
        createLabel="Add New Property"
        :hasFilters="true"
    >
        @slot('filters')
            <form action="{{ route('properties.index') }}" method="GET" class="row g-3 align-items-center">
                <div class="col-md-4">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-white border-end-0 text-muted" style="border-color: #e0d8c3;">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Search by title, city, or district..." value="{{ request('search') }}" style="border-color: #e0d8c3; font-size: 0.85rem;">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select form-select-sm text-capitalize" style="border-color: #e0d8c3; font-size: 0.85rem;">
                        <option value="">All Statuses</option>
                        @foreach(['available' => 'Available', 'under_negotiation' => 'Under Negotiation', 'reserved' => 'Reserved', 'sold' => 'Sold'] as $val => $label)
                            <option value="{{ $val }}" {{ request('status') == $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5 d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-sm px-4" style="background-color: #2F4F3E; color: #fff; border-radius: 8px; font-weight: 600; border: none; transition: 0.2s;" onmouseover="this.style.backgroundColor='#1a2e24'" onmouseout="this.style.backgroundColor='#2F4F3E'">
                        <i class="bi bi-funnel me-1"></i> Filter
                    </button>
                    <a href="{{ route('properties.index') }}" class="btn btn-sm sakn-btn-outline px-3" style="border-radius: 8px;">Reset</a>
                    
                    <div class="border-start mx-1" style="height: 30px; border-color: #e0d8c3 !important;"></div>
                    
                    <a href="{{ route('properties.export') }}" class="btn btn-sm shadow-sm" style="border: 1px solid #c3e6cb; background-color: #d4edda; color: #155724; border-radius: 8px; font-weight: 600; transition: 0.2s; display: inline-flex; align-items: center;" onmouseover="this.style.backgroundColor='#c3e6cb'" onmouseout="this.style.backgroundColor='#d4edda'">
                        <i class="bi bi-file-earmark-spreadsheet me-1"></i> Export Excel
                    </a>
                    <button type="button" class="btn btn-sm shadow-sm" style="border: 1px solid #bee5eb; background-color: #d1ecf1; color: #0c5460; border-radius: 8px; font-weight: 600; transition: 0.2s; display: inline-flex; align-items: center;" onmouseover="this.style.backgroundColor='#bee5eb'" onmouseout="this.style.backgroundColor='#d1ecf1'" data-bs-toggle="modal" data-bs-target="#importPropertiesModal">
                        <i class="bi bi-upload me-1"></i> Import Excel
                    </button>
                </div>
            </form>
            
            <!-- Import Modal -->
            <div class="modal fade" id="importPropertiesModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
                        <div class="modal-header border-bottom-0 pb-0" style="background-color: #F5F2EC; padding: 1.5rem 1.5rem 0.5rem 1.5rem;">
                            <h6 class="modal-title fw-bold text-sakn" style="font-size: 1.1rem; color: #2F4F3E;">
                                <i class="bi bi-file-earmark-arrow-up text-gold me-2" style="color: #C8A96A;"></i> Import Properties Data
                            </h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('properties.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body text-start py-4" style="background-color: #F5F2EC; padding: 1.5rem;">
                                <p class="small text-muted mb-3">Upload your spreadsheet file (.xlsx, .xls, .csv) with properties data to sync listing assets.</p>
                                <div class="mb-3 p-4 bg-white rounded-3 border border-dashed text-center" style="border-color: #C8A96A !important; border-style: dashed !important; border-width: 2px !important; border-radius: 10px;">
                                    <i class="bi bi-cloud-arrow-up display-5 mb-2 d-block" style="color: #C8A96A;"></i>
                                    <input type="file" name="file" class="form-control form-control-sm mt-3" required accept=".xlsx,.xls,.csv" style="border-color: #e0d8c3;">
                                </div>
                            </div>
                            <div class="modal-footer border-top-0 pt-0 bg-sakn-light" style="background-color: #F5F2EC; padding: 0.5rem 1.5rem 1.5rem 1.5rem;">
                                <button type="button" class="btn btn-sm btn-outline-secondary px-4" style="border-radius: 8px;" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-sm px-4 text-white" style="background-color: #2F4F3E; border-radius: 8px; font-weight: 600; border: none;">Upload Spreadsheet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endslot

        <thead>
            <tr>
                <th class="ps-4">ID</th>
                <th>Title</th>
                <th>Price</th>
                <th>Location</th>
                <th>Status</th>
                <th>Archived</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($properties as $property)
                <tr>
                    <td class="ps-4 text-muted">{{ $property->id }}</td>
                    <td>
                        <span class="fw-bold" style="color: #2F4F3E;">{{ $property->title }}</span>
                    </td>
                    <td>
                        <span class="text-dark fw-semibold">${{ number_format($property->price, 2) }}</span>
                    </td>
                    <td>
                        <small class="text-muted"><i class="bi bi-geo-alt-fill me-1" style="color: #C8A96A;"></i>{{ $property->city }}, {{ $property->district }}</small>
                    </td>
                    <td>
                        <x-sakn-status-badge :status="$property->status" />
                    </td>
                    <td>
                        @if($property->is_archived)
                            <span class="status-badge bg-danger-light text-danger border border-danger-subtle" style="font-size: 0.65rem; padding: 2px 8px;">ARCHIVED</span>
                        @else
                            <span class="status-badge bg-success-light text-success border border-success-subtle" style="font-size: 0.65rem; padding: 2px 8px;">ACTIVE</span>
                        @endif
                    </td>
                    <td class="text-center pe-4">
                        <div class="btn-group shadow-sm" role="group" style="border-radius: 8px; overflow: hidden;">
                            <a href="{{ route('property-images.index', ['property_id' => $property->id]) }}" class="btn btn-sm sakn-btn-outline" title="Images">
                                <i class="bi bi-images"></i>
                            </a>
                            <a href="{{ route('property-documents.index', ['property_id' => $property->id]) }}" class="btn btn-sm sakn-btn-outline" title="Files">
                                <i class="bi bi-file-earmark-pdf"></i>
                            </a>
                            <a href="{{ route('properties.edit', $property->id) }}" class="btn btn-sm sakn-btn-outline" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            @can('delete-propertie')
                            <form action="{{ route('properties.destroy', $property->id) }}" method="POST" onsubmit="return confirm('Delete this property?');" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm sakn-btn-outline" title="Delete" style="border-left: none;">
                                    <i class="bi bi-trash3 text-danger"></i>
                                </button>
                            </form>
                            @endcan
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-5">
                        <i class="bi bi-house-exclamation display-4 text-muted"></i>
                        <p class="mt-2 text-muted">No properties in your list yet.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>

        @slot('pagination')
            @if(method_exists($properties, 'links'))
                {{ $properties->links() }}
            @endif
        @endslot
    </x-sakn-index-page>
@endsection
