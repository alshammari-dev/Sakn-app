@extends('layouts.dashboard')

@section('main')
    <x-sakn-form-page 
        title="Create Permission" 
        subtitle="Define a new system-level permission"
        :backRoute="url('permissions')"
        :action="url('permissions')"
        submitLabel="Save Permission"
    >
        <div class="col-12">
            <label class="form-label">Permission Name</label>
            <input type="text" name="name" placeholder="e.g. edit-properties" class="form-control" required>
        </div>
    </x-sakn-form-page>
@endsection
