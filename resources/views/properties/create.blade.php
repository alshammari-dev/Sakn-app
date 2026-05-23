@extends('layouts.dashboard')

@section('main')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <x-sakn-form-page 
        title="Add New Property" 
        subtitle="List a new property in the system with location and pricing details"
        :backRoute="route('properties.index')"
        :action="route('properties.store')"
        submitLabel="Publish Property"
    >
        <div class="col-md-8">
            <label class="form-label">Property Title</label>
            <input type="text" class="form-control" name="title" placeholder="e.g. Luxury Villa with Pool" required maxlength="255" value="{{ old('title') }}">
        </div>

        <div class="col-md-4">
            <label class="form-label">Price ($)</label>
            <input type="number" step="0.01" class="form-control" name="price" placeholder="0.00" required value="{{ old('price') }}">
        </div>

        <div class="col-md-4">
            <label class="form-label">City</label>
            <input type="text" class="form-control" name="city" placeholder="e.g. Riyadh" required maxlength="255" value="{{ old('city') }}">
        </div>

        <div class="col-md-4">
            <label class="form-label">District</label>
            <input type="text" class="form-control" name="district" placeholder="e.g. Al-Malqa" required maxlength="255" value="{{ old('district') }}">
        </div>

        <div class="col-md-4">
            <label class="form-label">Listing Status</label>
            <select class="form-select" name="status" required>
                <option value="available">Available</option>
                <option value="under_negotiation">Under Negotiation</option>
                <option value="reserved">Reserved</option>
                <option value="sold">Sold</option>
            </select>
        </div>

        <div class="col-12">
            <label class="form-label">Description (Optional)</label>
            <textarea class="form-control" name="ai_description" rows="4" placeholder="Describe the property highlights...">{{ old('ai_description') }}</textarea>
        </div>

        <div class="col-12 mt-4">
            <div class="p-3 bg-light rounded-4">
                <h6 class="fw-bold mb-3"><i class="bi bi-geo-alt-fill me-2 text-danger"></i> Pin Location on Map</h6>
                <div id="map" style="height: 400px; width: 100%; border-radius: 12px; border: 2px solid #fff; box-shadow: 0 4px 15px rgba(0,0,0,0.05);"></div>
            </div>
        </div>

        <div class="col-md-6">
            <label class="form-label">Latitude</label>
            <input type="text" class="form-control bg-light" id="lat" name="lat" readonly placeholder="Auto-set from map" value="{{ old('lat') }}">
        </div>

        <div class="col-md-6">
            <label class="form-label">Longitude</label>
            <input type="text" class="form-control bg-light" id="lng" name="lng" readonly placeholder="Auto-set from map" value="{{ old('lng') }}">
        </div>

        <div class="col-12">
            <div class="form-check form-switch p-3 border rounded-4">
                <input class="form-check-input ms-0 me-3" type="checkbox" name="is_archived" value="1" id="archiveSwitch" {{ old('is_archived') ? 'checked' : '' }}>
                <label class="form-check-label fw-bold text-dark" for="archiveSwitch">
                    Archive this property immediately?
                </label>
                <small class="d-block text-muted mt-1">If enabled, the property will be hidden from public listings.</small>
            </div>
        </div>
    </x-sakn-form-page>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        var defaultLat = 24.7136; 
        var defaultLng = 46.6753; 
        var map = L.map('map').setView([defaultLat, defaultLng], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var marker;

        function onMapClick(e) {
            var clickedLat = e.latlng.lat.toFixed(7);
            var clickedLng = e.latlng.lng.toFixed(7);
            document.getElementById('lat').value = clickedLat;
            document.getElementById('lng').value = clickedLng;
            if (marker) {
                marker.setLatLng(e.latlng);
            } else {
                marker = L.marker(e.latlng).addTo(map);
            }
        }
        map.on('click', onMapClick);
    </script>
@endsection
