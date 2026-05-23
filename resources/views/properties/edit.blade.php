@extends('layouts.dashboard')

@section('main')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <x-sakn-form-page 
        title="Edit Property: {{ $property->title }}" 
        subtitle="Modify listing details, pricing, or update location on map"
        :backRoute="route('properties.index')"
        :action="route('properties.update', $property->id)"
        method="PUT"
        submitLabel="Update Property"
    >
        <div class="col-md-8">
            <label class="form-label">Property Title</label>
            <input type="text" class="form-control" name="title" value="{{ old('title', $property->title) }}" required maxlength="255">
        </div>

        <div class="col-md-4">
            <label class="form-label">Price ($)</label>
            <input type="number" step="0.01" class="form-control" name="price" value="{{ old('price', $property->price) }}" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">City</label>
            <input type="text" class="form-control" name="city" value="{{ old('city', $property->city) }}" required maxlength="255">
        </div>

        <div class="col-md-4">
            <label class="form-label">District</label>
            <input type="text" class="form-control" name="district" value="{{ old('district', $property->district) }}" required maxlength="255">
        </div>

        <div class="col-md-4">
            <label class="form-label">Listing Status</label>
            <select class="form-select" name="status" required>
                <option value="available" {{ old('status', $property->status) == 'available' ? 'selected' : '' }}>Available</option>
                <option value="under_negotiation" {{ old('status', $property->status) == 'under_negotiation' ? 'selected' : '' }}>Under Negotiation</option>
                <option value="reserved" {{ old('status', $property->status) == 'reserved' ? 'selected' : '' }}>Reserved</option>
                <option value="sold" {{ old('status', $property->status) == 'sold' ? 'selected' : '' }}>Sold</option>
            </select>
        </div>

        <div class="col-12">
            <label class="form-label">Description (Optional)</label>
            <textarea class="form-control" name="ai_description" rows="4">{{ old('ai_description', $property->ai_description) }}</textarea>
        </div>

        <div class="col-12 mt-4">
            <div class="p-3 bg-light rounded-4">
                <h6 class="fw-bold mb-3"><i class="bi bi-geo-alt-fill me-2 text-danger"></i> Update Location on Map</h6>
                <div id="map" style="height: 400px; width: 100%; border-radius: 12px; border: 2px solid #fff; box-shadow: 0 4px 15px rgba(0,0,0,0.05);"></div>
            </div>
        </div>

        <div class="col-md-6">
            <label class="form-label">Latitude</label>
            <input type="text" class="form-control bg-light" id="lat" name="lat" value="{{ old('lat', $property->lat) }}" readonly required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Longitude</label>
            <input type="text" class="form-control bg-light" id="lng" name="lng" value="{{ old('lng', $property->lng) }}" readonly required>
        </div>

        <div class="col-12">
            <div class="form-check form-switch p-3 border rounded-4">
                <input class="form-check-input ms-0 me-3" type="checkbox" name="is_archived" value="1" id="archiveSwitch" {{ old('is_archived', $property->is_archived) ? 'checked' : '' }}>
                <label class="form-check-label fw-bold text-dark" for="archiveSwitch">
                    Archive this property?
                </label>
                <small class="d-block text-muted mt-1">Hides the property from search results.</small>
            </div>
        </div>
    </x-sakn-form-page>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        var initialLat = {{ $property->lat ?? 24.7136 }};
        var initialLng = {{ $property->lng ?? 46.6753 }};
        var map = L.map('map').setView([initialLat, initialLng], 14);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var marker = L.marker([initialLat, initialLng]).addTo(map);

        function onMapClick(e) {
            var clickedLat = e.latlng.lat.toFixed(7);
            var clickedLng = e.latlng.lng.toFixed(7);
            document.getElementById('lat').value = clickedLat;
            document.getElementById('lng').value = clickedLng;
            marker.setLatLng(e.latlng);
        }
        map.on('click', onMapClick);
    </script>
@endsection
