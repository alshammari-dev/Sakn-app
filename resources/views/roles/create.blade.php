@extends('layouts.dashboard')

@section('main')
    <x-sakn-form-page 
        title="Create New Role" 
        subtitle="Define a new user role and its associated permissions"
        :backRoute="route('roles.index')"
        :action="route('roles.store')"
        submitLabel="Create Role"
    >
        <div class="col-12">
            <label class="form-label">Role Name</label>
            <input type="text" name="name" placeholder="e.g. Sales Manager" class="form-control" required>
        </div>

        <div class="col-12 mt-4">
            <label class="form-label d-block mb-3">Assign Permissions</label>
            <div class="row g-3 p-3 bg-light rounded-4">
                @foreach($permission as $value)
                    <div class="col-md-3">
                        <div class="form-check custom-checkbox">
                            <input class="form-check-input" type="checkbox" name="permission[]" value="{{$value->id}}" id="permission-{{ $value->id }}">
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
