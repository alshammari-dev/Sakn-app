@extends('layouts.dashboard')

@section('main')
    <x-sakn-form-page 
        title="Edit User: {{ $user->name }}" 
        subtitle="Update account details and manage user access levels"
        :backRoute="route('users.index')"
        :action="route('users.update', $user->id)"
        method="PUT"
        submitLabel="Update User Account"
    >
        <div class="col-md-6">
            <label class="form-label">Full Name</label>
            <input type="text" name="name" placeholder="Enter full name" class="form-control" value="{{ $user->name }}" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" placeholder="email@example.com" class="form-control" value="{{ $user->email }}" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Password</label>
            <input type="password" name="password" placeholder="Leave blank to keep current" class="form-control">
            <small class="text-muted">Only enter a password if you want to change it.</small>
        </div>

        <div class="col-md-6">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="confirm-password" placeholder="Confirm new password" class="form-control">
        </div>

        <div class="col-12">
            <label class="form-label fw-bold mb-3">Assigned Roles</label>
            <div class="row g-3">
                @foreach ($roles as $value => $label)
                    <div class="col-md-4 col-lg-3">
                        <div class="role-card-wrapper">
                            <input type="checkbox" name="roles[]" value="{{ $value }}" id="role_{{ $value }}" 
                                class="role-check-input d-none" {{ isset($userRole[$value]) ? 'checked' : '' }}>
                            <label for="role_{{ $value }}" class="role-card d-flex align-items-center p-3 border rounded-3 cursor-pointer h-100 transition">
                                <div class="role-icon bg-light rounded-circle p-2 me-3">
                                    <i class="bi bi-shield-check text-muted"></i>
                                </div>
                                <div>
                                    <span class="d-block fw-bold text-dark">{{ $label }}</span>
                                    <small class="text-muted small">System Access</small>
                                </div>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <style>
                .role-card {
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    cursor: pointer;
                    background: #fff;
                    border: 2px solid #eee !important;
                }
                .role-card:hover {
                    border-color: var(--sakn-gold) !important;
                    background: var(--sakn-gold-soft);
                    transform: translateY(-3px);
                }
                .role-check-input:checked + .role-card {
                    background: var(--sakn-gold-soft) !important;
                    border-color: var(--sakn-gold) !important;
                    box-shadow: 0 5px 15px rgba(188, 147, 85, 0.1);
                }
                .role-check-input:checked + .role-card .role-icon {
                    background: var(--sakn-gold) !important;
                }
                .role-check-input:checked + .role-card .role-icon i {
                    color: #fff !important;
                }
                .role-check-input:checked + .role-card span {
                    color: var(--sakn-gold) !important;
                }
                .cursor-pointer { cursor: pointer; }
            </style>
        </div>
    </x-sakn-form-page>
@endsection
