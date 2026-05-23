@extends('layouts.dashboard')

@section('main')
    <x-sakn-form-page 
        title="Edit Role: {{ $role->name }}" 
        subtitle="Modify role name and adjust its permission access"
        :backRoute="route('roles.index')"
        :action="route('roles.update', $role->id)"
        method="PUT"
        submitLabel="Update Role"
    >
        <div class="col-12">
            <label class="form-label">Role Name</label>
            <input type="text" name="name" placeholder="Name" class="form-control" value="{{ $role->name }}" required>
        </div>

        <div class="col-12 mt-4">
            <label class="form-label d-block mb-3">Adjust Permissions</label>
            <div class="row g-3 p-3 bg-light rounded-4">
                @foreach($permission as $value)
                    <div class="col-md-3">
                        <div class="form-check custom-checkbox">
                            <input class="form-check-input" type="checkbox" name="permission[]" value="{{$value->id}}" id="permission-{{ $value->id }}" {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold text-dark" for="permission-{{ $value->id }}">
                                {{ str_replace('-', ' ', ucfirst($value->name)) }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </x-sakn-form-page>

    <style>
        .custom-checkbox .form-check-input:checked {
            background-color: var(--sakn-gold);
            border-color: var(--sakn-gold);
        }
    </style>
@endsection
