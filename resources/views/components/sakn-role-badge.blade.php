@props(['user'])

@php
    $roles = $user->getRoleNames();
    
    // We consider it a Super Admin if they have all main roles 
    // or if we manually define a threshold.
    // For now, let's say 3 or more roles makes you a Super Admin in this context, 
    // or specifically all roles.
    $allRolesCount = \Spatie\Permission\Models\Role::count();
    $isSuperAdmin = $roles->count() >= $allRolesCount && $allRolesCount > 0;

    $getRoleData = function($roleName) {
        return match($roleName) {
            'admin' => [
                'class' => 'bg-dark text-white', 
                'style' => 'background-color: #2F4F3E !important;',
                'label' => 'Admin'
            ],
            'content manager' => [
                'class' => 'bg-success text-white', 
                'style' => 'background-color: #3d6350 !important;',
                'label' => 'Manager'
            ],
            'sale-agent' => [
                'class' => 'bg-warning text-dark', 
                'style' => 'background-color: #C8A96A !important; color: #fff !important;',
                'label' => 'Agent'
            ],
            'client' => [
                'class' => 'bg-light text-dark border', 
                'style' => 'background-color: #F5F2EC !important; color: #2F4F3E !important; border: 1px solid #e0d8c3 !important;',
                'label' => 'Client'
            ],
            default => [
                'class' => 'bg-secondary text-white', 
                'style' => '',
                'label' => $roleName
            ]
        };
    };
@endphp

@if($isSuperAdmin)
    <span class="status-badge shadow-sm px-3 py-2" style="background: linear-gradient(45deg, #2F4F3E 0%, #1a2e24 50%, #C8A96A 100%); color: white; border: none; font-weight: 800; letter-spacing: 0.5px; border-radius: 20px;">
        <i class="bi bi-shield-fill-check me-1"></i> SUPER ADMIN
    </span>
@else
    @foreach($roles as $role)
        @php $data = $getRoleData($role); @endphp
        <span class="status-badge {{ $data['class'] }} px-2 py-1 shadow-sm" style="{{ $data['style'] }} font-size: 0.75rem; border-radius: 6px;">
            {{ $data['label'] }}
        </span>
    @endforeach
@endif

<style>
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.4em 0.8em;
        font-size: 0.75rem;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.375rem;
        transition: all 0.2s ease-in-out;
    }
    .status-badge:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1) !important;
    }
</style>
