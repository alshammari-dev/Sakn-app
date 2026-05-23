@extends('layouts.dashboard')

@section('main')
    <x-sakn-index-page 
        title="Role Management" 
        subtitle="Manage and configure application roles and permissions"
        :createRoute="Auth::user()->can('role-create') ? route('roles.create') : null"
        createLabel="Create New Role"
    >
        <thead>
            <tr>
                <th class="ps-4">No</th>
                <th>Role Name</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($roles as $key => $role)
                <tr>
                    <td class="ps-4 text-muted">{{ ++$i }}</td>
                    <td>
                        <span class="fw-bold" style="color: #2F4F3E;">
                            <i class="bi bi-shield-check me-2" style="color: #C8A96A;"></i>{{ $role->name }}
                        </span>
                    </td>
                    <td class="text-center pe-4">
                        <div class="btn-group shadow-sm" role="group" style="border-radius: 8px; overflow: hidden;">
                            <a href="{{ route('roles.show', $role->id) }}" class="btn btn-sm sakn-btn-outline" title="Show">
                                <i class="bi bi-list-ul"></i>
                            </a>
                            @can('role-edit')
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm sakn-btn-outline" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            @endcan
                            @can('role-delete')
                                <form method="POST" action="{{ route('roles.destroy', $role->id) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm sakn-btn-outline" title="Delete" onclick="return confirm('Delete this role?')" style="border-left: none;">
                                        <i class="bi bi-trash3 text-danger"></i>
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center py-5">
                        <i class="bi bi-shield-exclamation display-4 text-muted"></i>
                        <p class="mt-2 text-muted">No roles found.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>

        @slot('pagination')
            @if(method_exists($roles, 'links'))
                {{ $roles->links('pagination::bootstrap-5') }}
            @endif
        @endslot
    </x-sakn-index-page>
@endsection
