@extends('layouts.dashboard')

@section('main')
    <div class="container-fluid py-4">
        <div class="row g-4">
            <!-- Page Title -->
            <div class="col-12 mb-2">
                <h3 class="fw-bold text-dark mb-1">Account Settings</h3>
                <p class="text-muted small">Manage your profile information, password, and account security</p>
            </div>

            <!-- Profile Info -->
            <div class="col-lg-6">
                <div class="sakn-card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <div class="sakn-card-header bg-white p-4 border-bottom d-flex align-items-center">
                        <div class="bg-gold-soft p-2 rounded-3 me-3">
                            <i class="bi bi-person-badge fs-4 text-gold"></i>
                        </div>
                        <h5 class="mb-0 fw-bold">Personal Information</h5>
                    </div>
                    <div class="card-body p-4">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <!-- Security / Password -->
            <div class="col-lg-6">
                <div class="sakn-card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <div class="sakn-card-header bg-white p-4 border-bottom d-flex align-items-center">
                        <div class="bg-green-soft p-2 rounded-3 me-3">
                            <i class="bi bi-shield-lock fs-4 text-green"></i>
                        </div>
                        <h5 class="mb-0 fw-bold">Security Settings</h5>
                    </div>
                    <div class="card-body p-4">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <!-- Dangerous Zone -->
            <div class="col-12">
                <div class="sakn-card border-0 shadow-sm rounded-4 overflow-hidden bg-white mt-2">
                    <div class="p-4 border-bottom d-flex align-items-center bg-danger-soft">
                        <div class="bg-danger rounded-3 p-2 me-3">
                            <i class="bi bi-exclamation-triangle text-white"></i>
                        </div>
                        <h5 class="mb-0 fw-bold text-danger">Advanced Actions</h5>
                    </div>
                    <div class="card-body p-4">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-gold-soft { background: var(--sakn-gold-soft); }
        .text-gold { color: var(--sakn-gold); }
        .bg-green-soft { background: var(--sakn-green-soft); }
        .text-green { color: var(--sakn-green); }
        .bg-danger-soft { background: rgba(220, 53, 69, 0.03); }
        .sakn-card { background: #fff; transition: transform 0.3s ease; }
        .sakn-card:hover { transform: translateY(-5px); }
    </style>
@endsection
