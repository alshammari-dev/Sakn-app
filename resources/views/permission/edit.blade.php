@extends('layouts.dashboard')

@section('main')
    <x-sakn-form-page 
        title="Edit Permission" 
        subtitle="Update the permission identification name"
        :backRoute="url('permissions')"
        :action="url('permissions/' . $permission->id)"
        method="PUT"
        submitLabel="Update Permission"
    >
        <div class="col-12">
            <label class="form-label">Permission Name</label>
            <input type="text" name="name" class="form-control" value="{{ $permission->name }}" required>
        </div>
    </x-sakn-form-page>
@endsection
