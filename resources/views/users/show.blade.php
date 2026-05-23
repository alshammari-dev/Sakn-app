@extends('layouts.dashboard')

@section('main')
    <x-sakn-show-page 
        title="User Details" 
        :subtitle="$user->name"
        :backRoute="route('users.index')"
    >
        <div class="row g-4 justify-content-center">
            <div class="col-lg-8">
                <div class="row g-4">
                    {{-- Profile Header Card --}}
                    <div class="col-12">
                        <div class="d-flex align-items-center p-4 bg-light rounded-4 border border-light shadow-sm">
                            <div class="bg-white p-1 rounded-circle border shadow-sm me-4">
                                <div class="bg-success rounded-circle d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; background-color: #2F4F3E !important;">
                                    <span class="text-white fw-bold fs-2">{{ substr($user->name, 0, 1) }}</span>
                                </div>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-1" style="color: #2F4F3E;">{{ $user->name }}</h4>
                                <p class="text-muted mb-0"><i class="bi bi-envelope me-2"></i>{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Details Section --}}
                    <div class="col-md-6">
                        <div class="p-4 border rounded-4 bg-white h-100 shadow-sm">
                            <h5 class="sakn-section-title">
                                <i class="bi bi-person-badge"></i> Identification
                            </h5>
                            <div class="mb-3">
                                <span class="sakn-info-label">Full Name</span>
                                <span class="sakn-info-value">{{ $user->name }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="sakn-info-label">Email Address</span>
                                <span class="sakn-info-value text-lowercase">{{ $user->email }}</span>
                            </div>
                            <div class="mb-0">
                                <span class="sakn-info-label">Member Since</span>
                                <span class="sakn-info-value">{{ $user->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Roles & Access Section --}}
                    <div class="col-md-6">
                        <div class="p-4 border rounded-4 bg-white h-100 shadow-sm">
                            <h5 class="sakn-section-title">
                                <i class="bi bi-shield-check"></i> Roles & Access
                            </h5>
                            <div class="mb-4">
                                <span class="sakn-info-label">Assigned Roles</span>
                                <div class="mt-2">
                                    @forelse($user->getRoleNames() as $role)
                                        <span class="status-badge status-available me-2 mb-2">{{ $role }}</span>
                                    @empty
                                        <span class="text-muted italic">No roles assigned.</span>
                                    @endforelse
                                </div>
                            </div>
                            <div class="mt-auto">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary w-100">
                                    <i class="bi bi-pencil me-2"></i> Edit User Access
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-sakn-show-page>
@endsection
