@extends('layouts.dashboard')

@section('main')
    <x-sakn-show-page 
        title="Role Details" 
        :subtitle="'Role: ' . $role->name"
        :backRoute="route('roles.index')"
    >
        <div class="row g-4">
            {{-- Role Basic Info --}}
            <div class="col-lg-4">
                <div class="p-4 border rounded-4 bg-white shadow-sm h-100">
                    <h5 class="sakn-section-title">
                        <i class="bi bi-shield-lock"></i> Role Info
                    </h5>
                    <div class="mb-4 text-center">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="bi bi-person-gear fs-1" style="color: #2F4F3E;"></i>
                        </div>
                        <h4 class="fw-bold mb-0 text-uppercase" style="letter-spacing: 1px; color: #2F4F3E;">{{ $role->name }}</h4>
                        <span class="text-muted small">Access Level</span>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary w-100 py-2">
                            <i class="bi bi-pencil-square me-2"></i> Edit Permissions
                        </a>
                    </div>
                </div>
            </div>

            {{-- Permissions Grid --}}
            <div class="col-lg-8">
                <div class="p-4 border rounded-4 bg-white shadow-sm h-100">
                    <h5 class="sakn-section-title">
                        <i class="bi bi-key"></i> Assigned Permissions
                    </h5>
                    <div class="row g-2">
                        @forelse($rolePermissions as $v)
                        <div class="col-md-4 col-sm-6">
                            <div class="d-flex align-items-center p-2 rounded-3 bg-light border border-white transition-hover">
                                <i class="bi bi-check2-circle text-success me-2"></i>
                                <span class="small fw-semibold text-dark">{{ $v->name }}</span>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center py-5 text-muted italic">
                            <i class="bi bi-exclamation-circle display-4 mb-3 d-block"></i>
                            No permissions assigned to this role.
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </x-sakn-show-page>

    <style>
        .transition-hover:hover {
            border-color: #C8A96A !important;
            transform: translateX(5px);
        }
    </style>
@endsection
