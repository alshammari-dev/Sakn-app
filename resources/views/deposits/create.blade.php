@extends('layouts.dashboard')

@section('main')
    <x-sakn-form-page 
        title="Create New Deposit" 
        subtitle="Link a payment to a specific property and client for reservation"
        :backRoute="route('deposits.index')"
        :action="route('deposits.store')"
        enctype="multipart/form-data"
        submitLabel="Save Transaction"
    >
        {{-- 1. Property & Offer --}}
        <div class="col-md-6">
            <label class="form-label">Target Property</label>
            <select class="form-select" name="property_id" required>
                <option value="">Select Property</option>
                @foreach($properties as $property)
                    <option value="{{ $property->id }}" {{ old('property_id') == $property->id ? 'selected' : '' }}>
                        {{ $property->title }} ({{ $property->city }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Linked Offer (Optional)</label>
            <select class="form-select" name="offer_id">
                <option value="">Direct Deposit (No Offer)</option>
                @foreach($offers as $offer)
                    <option value="{{ $offer->id }}" {{ old('offer_id') == $offer->id ? 'selected' : '' }}>
                        Offer #{{ $offer->id }} - {{ $offer->client->name }} (${{ number_format($offer->amount) }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- 2. Client & Amount --}}
        <div class="col-md-6">
            <label class="form-label">Client</label>
            <select class="form-select" name="client_id" required>
                <option value="">Select Client</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="form-label">Amount ($)</label>
            <input type="number" step="0.01" class="form-control" name="amount" value="{{ old('amount') }}" placeholder="0.00" required>
        </div>

        <div class="col-md-3">
            <label class="form-label">Payment Method</label>
            <select class="form-select" name="payment_method" required>
                <option value="cash">Cash</option>
                <option value="bank_transfer">Bank Transfer</option>
                <option value="check">Check</option>
                <option value="online">Online Payment</option>
            </select>
        </div>

        {{-- 3. Status & Date --}}
        <div class="col-md-6">
            <label class="form-label">Status</label>
            <select class="form-select bg-light" name="status" required>
                <option value="pending" selected>Pending (Verification Required)</option>
                <option value="approved">Approved (Reserved Property)</option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Payment Date</label>
            <input type="datetime-local" class="form-control" name="paid_at" value="{{ old('paid_at', now()->format('Y-m-d\TH:i')) }}">
        </div>

        {{-- 4. Receipt Upload --}}
        <div class="col-12 mt-4">
            <div class="p-4 border-2 border-dashed rounded-4 bg-light text-center" style="border: 2px dashed #dee2e6;">
                <label class="form-label d-block fw-bold mb-3">
                    <i class="bi bi-cloud-upload display-6 text-primary d-block mb-2"></i>
                    Upload Payment Receipt
                </label>
                <div class="col-md-6 mx-auto">
                    <input type="file" class="form-control" name="receipt" accept="image/*,.pdf">
                </div>
                <small class="text-muted mt-2 d-block">Accepted: JPG, PNG, PDF (Max: 2MB)</small>
            </div>
        </div>

        <div class="col-12 mt-3">
            <div class="form-check form-switch p-3 border rounded-4 bg-white shadow-sm">
                <input class="form-check-input ms-0 me-3" type="checkbox" id="notify_client" name="notify_client" checked>
                <label class="form-check-label fw-bold" for="notify_client">
                    Send email notification to client automatically?
                </label>
            </div>
        </div>
    </x-sakn-form-page>
@endsection
