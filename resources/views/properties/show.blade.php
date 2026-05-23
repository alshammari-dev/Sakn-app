@extends('layouts.dashboard')

@section('main')
    <x-sakn-show-page 
        :title="$property->title" 
        subtitle="Property Details & Management"
        :backRoute="route('properties.index')"
    >
        <div class="row g-4">
            {{-- Left Column: Images and Description --}}
            <div class="col-lg-8">
                {{-- Main Image Display --}}
                <div class="mb-4">
                    @if($property->mainImage)
                        <img src="{{ $property->mainImage->url }}" class="property-gallery-img" id="mainPropertyImage" alt="{{ $property->title }}">
                    @else
                        <div class="property-gallery-img d-flex align-items-center justify-content-center bg-light text-muted">
                            <i class="bi bi-house-door display-1"></i>
                        </div>
                    @endif
                </div>

                {{-- Thumbnail Gallery --}}
                @if($property->images->count() > 1)
                <div class="row g-2 mb-5">
                    @foreach($property->images as $image)
                    <div class="col-2">
                        <img src="{{ $image->url }}" 
                             class="property-thumb {{ $image->is_main ? 'active' : '' }}" 
                             onclick="document.getElementById('mainPropertyImage').src = this.src; document.querySelectorAll('.property-thumb').forEach(el => el.classList.remove('active')); this.classList.add('active');"
                             alt="Thumbnail">
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- Description Section --}}
                <div class="mb-5">
                    <h5 class="sakn-section-title">
                        <i class="bi bi-justify-left"></i> Description
                    </h5>
                    <div class="p-4 bg-light rounded-4 text-dark" style="line-height: 1.8; font-size: 1.05rem;">
                        {!! nl2br(e($property->ai_description ?? 'No description provided for this property.')) !!}
                    </div>
                </div>

                {{-- Documents Section --}}
                <div>
                    <h5 class="sakn-section-title">
                        <i class="bi bi-file-earmark-text"></i> Documents
                    </h5>
                    <div class="row g-3">
                        @forelse($property->documents as $doc)
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 border rounded-3 bg-white shadow-sm transition-hover">
                                <div class="bg-light p-2 rounded-2 me-3">
                                    <i class="bi bi-file-pdf text-danger fs-4"></i>
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <div class="fw-bold text-dark text-truncate">{{ $doc->name }}</div>
                                    <small class="text-muted text-uppercase" style="font-size: 0.65rem;">{{ $doc->type ?? 'Document' }}</small>
                                </div>
                                <a href="{{ $doc->url }}" target="_blank" class="btn btn-sm btn-light ms-2">
                                    <i class="bi bi-download"></i>
                                </a>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-muted italic">No documents uploaded for this property.</div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Right Column: Quick Info & Actions --}}
            <div class="col-lg-4">
                {{-- Quick Details Card --}}
                <div class="card border-0 bg-light rounded-4 mb-4 shadow-sm">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-4 text-dark border-bottom pb-2">Quick Information</h6>
                        
                        <div class="mb-4">
                            <span class="sakn-info-label">Price</span>
                            <span class="sakn-info-value" style="font-size: 1.75rem; color: #C8A96A;">${{ number_format($property->price, 2) }}</span>
                        </div>

                        <div class="row mb-4">
                            <div class="col-6">
                                <span class="sakn-info-label">Status</span>
                                <x-sakn-status-badge :status="$property->status" />
                            </div>
                            <div class="col-6">
                                <span class="sakn-info-label">Archived</span>
                                @if($property->is_archived)
                                    <span class="status-badge bg-danger text-white px-3 py-2">YES</span>
                                @else
                                    <span class="status-badge bg-success text-white px-3 py-2">NO</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-4">
                            <span class="sakn-info-label">Location</span>
                            <span class="sakn-info-value"><i class="bi bi-geo-alt-fill me-1" style="color: #C8A96A;"></i>{{ $property->city }}, {{ $property->district }}</span>
                        </div>

                        <div class="mb-4">
                            <span class="sakn-info-label">Added By</span>
                            <span class="sakn-info-value"><i class="bi bi-person-circle me-1"></i>{{ $property->addedBy->name ?? 'System' }}</span>
                        </div>

                        <div class="mb-0">
                            <span class="sakn-info-label">Created At</span>
                            <span class="sakn-info-value" style="font-size: 0.9rem;">{{ $property->created_at->format('M d, Y h:i A') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Management Actions Card --}}
                <div class="card border-0 bg-white border border-light rounded-4 shadow-sm">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3 text-dark">Management Actions</h6>
                        
                        <div class="d-grid gap-2">
                            <a href="{{ route('properties.edit', $property->id) }}" class="btn btn-primary py-2 fw-bold">
                                <i class="bi bi-pencil-square me-2"></i> Edit Property
                            </a>
                            
                            <a href="{{ route('property-images.index', ['property_id' => $property->id]) }}" class="btn btn-outline-dark py-2 fw-bold">
                                <i class="bi bi-images me-2"></i> Manage Images
                            </a>

                            <a href="{{ route('property-documents.index', ['property_id' => $property->id]) }}" class="btn btn-outline-dark py-2 fw-bold">
                                <i class="bi bi-files me-2"></i> Manage Documents
                            </a>

                            <hr class="my-3">

                            @can('delete-propertie')
                            <form action="{{ route('properties.destroy', $property->id) }}" method="POST" onsubmit="return confirm('Are you absolutely sure you want to delete this property? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger w-100 py-2 fw-bold">
                                    <i class="bi bi-trash3 me-2"></i> Delete Property
                                </button>
                            </form>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-sakn-show-page>

    <style>
        .transition-hover {
            transition: all 0.3s ease;
        }
        .transition-hover:hover {
            transform: translateY(-5px);
            border-color: #C8A96A !important;
        }
    </style>
@endsection
