@extends('layouts.dashboard')

@section('main')
    <x-sakn-index-page 
        title="Users Management" 
        subtitle="Manage application users and their assigned roles"
        :createRoute="route('users.create')"
        createLabel="Create New User"
        :hasFilters="true"
    >
        @slot('filters')
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                

                <div>
                    <a href="{{ route('users.export') }}" class="btn btn-sm sakn-btn-outline px-3 py-2 shadow-sm">
                        <i class="bi bi-file-earmark-spreadsheet text-success me-1"></i> Export to Excel
                    </a>
                </div>
            </div>
        @endslot

        <thead>
            <tr>
                <th class="ps-4">No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $key => $user)
                <tr>
                    <td class="ps-4 text-muted">{{ ++$i }}</td>
                    <td>
                        <span class="fw-bold" style="color: #2F4F3E;">{{ $user->name }}</span>
                    </td>
                    <td><small class="text-muted">{{ $user->email }}</small></td>
                    <td>
                        <x-sakn-role-badge :user="$user" />
                    </td>
                    <td class="text-center pe-4">
                        <div class="btn-group shadow-sm" role="group" style="border-radius: 8px; overflow: hidden;">
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm sakn-btn-outline" title="Show">
                                <i class="bi bi-person-lines-fill"></i>
                            </a>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm sakn-btn-outline" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm sakn-btn-outline" title="Delete" onclick="return confirm('Delete this user?')" style="border-left: none;">
                                    <i class="bi bi-trash3 text-danger"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <i class="bi bi-people display-4 text-muted"></i>
                        <p class="mt-2 text-muted">No users found.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>

        @slot('pagination')
            @if(method_exists($data, 'links'))
                {{ $data->links('pagination::bootstrap-5') }}
            @endif
        @endslot
    </x-sakn-index-page>
@endsection
