@extends('layouts.dashboard')

@section('main')
    <x-sakn-form-page 
        title="Edit Document" 
        subtitle="Update document type or adjust privacy settings for: {{ $property->title }}"
        :backRoute="route('property-documents.index', ['property_id' => $document->property_id])"
        :action="route('property-documents.update', $document->id)"
        method="PUT"
        submitLabel="Update Document"
    >
        <div class="col-md-6">
            <label class="form-label">Document Category</label>
            <select name="doc_type" class="form-select" required>
                <option value="ownership_deed" {{ $document->doc_type == 'ownership_deed' ? 'selected' : '' }}>Ownership Deed</option>
                <option value="floor_plan" {{ $document->doc_type == 'floor_plan' ? 'selected' : '' }}>Floor Plan</option>
                <option value="contract" {{ $document->doc_type == 'contract' ? 'selected' : '' }}>Legal Contract</option>
                <option value="other" {{ $document->doc_type == 'other' ? 'selected' : '' }}>Other Document</option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label d-block mb-3">Privacy Setting</label>
            <div class="form-check form-switch p-3 border rounded-4 bg-white">
                <input class="form-check-input ms-0 me-3" type="checkbox" name="is_private" value="1" id="privateSwitchEdit" {{ $document->is_private ? 'checked' : '' }}>
                <label class="form-check-label fw-bold" for="privateSwitchEdit">
                    Private (Admin only)
                </label>
            </div>
        </div>

        <div class="col-12 mt-4">
            <div class="p-3 border rounded-4 bg-light d-flex align-items-center">
                <div class="sakn-icon-circle bg-white me-3">
                    <i class="bi bi-file-earmark-check text-success"></i>
                </div>
                <div>
                    <span class="text-muted small d-block">Current File</span>
                    <a href="{{ asset('storage/' . $document->file_url) }}" target="_blank" class="text-decoration-none fw-bold text-dark">
                        View/Download Document <i class="bi bi-box-arrow-up-right ms-1 small"></i>
                    </a>
                </div>
            </div>
        </div>
    </x-sakn-form-page>
@endsection
