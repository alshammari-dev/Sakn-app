@extends('layouts.dashboard')

@section('main')
    <x-sakn-index-page 
        title="Permissions Management" 
        subtitle="Manage permissions used by roles across the app"
        :createRoute="url('permissions/create')"
        createLabel="Add Permission"
    >
        <thead>
            <tr>
                <th class="ps-4">ID</th>
                <th>Permission Name</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($permissions as $permission)
                <tr>
                    <td class="ps-4 text-muted">{{ $permission->id }}</td>
                    <td>
                        <span class="fw-bold" style="color: #2F4F3E;">
                            <i class="bi bi-key me-2" style="color: #C8A96A;"></i>{{ $permission->name }}
                        </span>
                    </td>
                    <td class="text-center pe-4">
                        <div class="btn-group shadow-sm" role="group" style="border-radius: 8px; overflow: hidden;">
                            <a href="{{ url('permissions/' . $permission->id . '/edit') }}" class="btn btn-sm sakn-btn-outline" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="{{ url('permissions/' . $permission->id . '/delete') }}" class="btn btn-sm sakn-btn-outline" title="Delete" onclick="return confirm('Delete this permission?')" style="border-left: none;">
                                <i class="bi bi-trash3 text-danger"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center py-5">
                        <i class="bi bi-key display-4 text-muted"></i>
                        <p class="mt-2 text-muted">No permissions found.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </x-sakn-index-page>
@endsection
