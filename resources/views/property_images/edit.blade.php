@extends('layouts.dashboard')

@section('main')
    <x-sakn-form-page 
        title="Edit Image Details" 
        subtitle="Update sorting order or set as main property image"
        :backRoute="route('property-images.index', ['property_id' => $image->property_id])"
        :action="route('property-images.update', $image->id)"
        method="PUT"
        submitLabel="Update Details"
    >
        <div class="col-md-4">
            <label class="form-label d-block mb-2">Current Preview</label>
            <div class="sakn-image-preview p-2 border rounded-4 bg-light text-center">
                <img src="{{ asset('storage/' . $image->url) }}" class="img-fluid rounded-3 shadow-sm" style="max-height: 200px;">
            </div>
        </div>

        <div class="col-md-8">
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ $image->sort_order }}" required min="0">
                    <small class="text-muted">Determines the display position in gallery.</small>
                </div>

                <div class="col-12 mt-4">
                    <label class="form-label d-block mb-3">Main Status</label>
                    <div class="form-check form-switch p-3 border rounded-4 bg-white">
                        <input class="form-check-input ms-0 me-3" type="checkbox" name="is_main" value="1" id="mainSwitchEdit" {{ $image->is_main ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold" for="mainSwitchEdit">
                            Use as primary thumbnail
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </x-sakn-form-page>
@endsection
