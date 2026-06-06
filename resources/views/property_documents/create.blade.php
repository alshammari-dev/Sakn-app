@extends('layouts.dashboard')

@section('main')
    <x-sakn-form-page 
        title="Upload Document" 
        subtitle="Add a legal or technical file to: {{ $property->title }}"
        :backRoute="route('property-documents.index', ['property_id' => $property->id])"
        :action="route('property-documents.store')"
        enctype="multipart/form-data"
        submitLabel="Upload Document"
    >
        <input type="hidden" name="property_id" value="{{ $property->id }}">

        <div class="col-md-6">
            <label class="form-label">Document Category</label>
            <select class="form-select" name="doc_type" required>
                <option value="ownership_deed">Ownership Deed</option>
                <option value="floor_plan">Floor Plan</option>
                <option value="contract">Legal Contract</option>
                <option value="other">Other Document</option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label d-block mb-3">Privacy Setting</label>
            <div class="form-check form-switch p-3 border rounded-4 bg-white">
                <input class="form-check-input ms-0 me-3" type="checkbox" name="is_private" value="1" id="privateSwitch" checked>
                <label class="form-check-label fw-bold" for="privateSwitch">
                    Private (Admin only)
                </label>
            </div>
        </div>

        <div class="col-12 mt-4">
            <div class="p-4 border-2 border-dashed rounded-4 bg-light text-center" style="border: 2px dashed #dee2e6;">
                <label class="form-label d-block fw-bold mb-3">
                    <i class="bi bi-file-earmark-arrow-up display-6 text-primary d-block mb-2"></i>
                    Select Document File
                </label>
                <div class="col-md-6 mx-auto">
                    <input type="file" class="form-control" name="file" required accept=".pdf,image/*">
                </div>
                <small class="text-muted mt-2 d-block">Allowed: PDF, JPG, PNG (Max: 50MB)</small>
            </div>
        </div>
    </x-sakn-form-page>
@endsection
