@extends('layouts.dashboard')

@section('main')
    <x-sakn-form-page 
        title="Upload Image" 
        subtitle="Add a new visual asset to: {{ $property->title }}"
        :backRoute="route('property-images.index', ['property_id' => $property->id])"
        :action="route('property-images.store')"
        enctype="multipart/form-data"
        submitLabel="Upload Image"
    >
        <input type="hidden" name="property_id" value="{{ $property->id }}">

        <div class="col-12">
            <label class="form-label">Select Image File</label>
            <input type="file" class="form-control" name="image" required accept="image/*">
            <small class="text-muted">High-quality JPG or PNG recommended.</small>
        </div>

        <div class="col-md-6">
            <label class="form-label">Sort Order</label>
            <input type="number" class="form-control" name="sort_order" value="1" min="0" required>
        </div>

        <div class="col-md-6">
            <label class="form-label d-block mb-3">Set as main image?</label>
            <div class="form-check form-switch p-3 border rounded-4 bg-white">
                <input class="form-check-input ms-0 me-3" type="checkbox" name="is_main" value="1" id="mainSwitch">
                <label class="form-check-label fw-bold" for="mainSwitch">
                    Use as primary thumbnail
                </label>
            </div>
        </div>
    </x-sakn-form-page>
@endsection
