@extends('layouts.dashboard')

@section('main')
    <x-sakn-form-page 
        title="Edit Deposit #{{ $deposit->id }}" 
        subtitle="Update payment details and transaction status"
        :backRoute="route('deposits.index')"
        :action="route('deposits.update', $deposit->id)"
        method="PUT"
        submitLabel="Update Transaction"
    >
        <div class="col-md-6">
            <label class="form-label">Property</label>
            <select class="form-select" name="property_id" required>
                <option value="">Choose property</option>
                @foreach($properties as $property)
                    <option value="{{ $property->id }}" {{ old('property_id', $deposit->property_id) == $property->id ? 'selected' : '' }}>
                        {{ $property->title }} ({{ $property->city }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Client</label>
            <select class="form-select" name="client_id" required>
                <option value="">Choose client</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ old('client_id', $deposit->client_id) == $client->id ? 'selected' : '' }}>
                        {{ $client->name }} ({{ $client->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Approved By (Agent)</label>
            <select class="form-select" name="approved_by">
                <option value="">Choose agent (optional)</option>
                @foreach($agents as $agent)
                    <option value="{{ $agent->id }}" {{ old('approved_by', $deposit->approved_by) == $agent->id ? 'selected' : '' }}>
                        {{ $agent->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Amount ($)</label>
            <input type="number" step="0.01" class="form-control" name="amount" value="{{ old('amount', $deposit->amount) }}" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Status</label>
            <select class="form-select" name="status" required>
                <option value="{{ App\Models\Deposit::STATUS_PENDING }}" {{ old('status', $deposit->status) == App\Models\Deposit::STATUS_PENDING ? 'selected' : '' }}>Pending</option>
                <option value="{{ App\Models\Deposit::STATUS_APPROVED }}" {{ old('status', $deposit->status) == App\Models\Deposit::STATUS_APPROVED ? 'selected' : '' }}>Approved</option>
                <option value="{{ App\Models\Deposit::STATUS_REJECTED }}" {{ old('status', $deposit->status) == App\Models\Deposit::STATUS_REJECTED ? 'selected' : '' }}>Rejected</option>
                <option value="{{ App\Models\Deposit::STATUS_REFUNDED }}" {{ old('status', $deposit->status) == App\Models\Deposit::STATUS_REFUNDED ? 'selected' : '' }}>Refunded</option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Payment Date</label>
            <input type="datetime-local" class="form-control" name="paid_at" value="{{ old('paid_at', optional($deposit->paid_at)->format('Y-m-d\TH:i')) }}">
        </div>

        <div class="col-12">
            <label class="form-label">Receipt Link (URL)</label>
            <input type="url" class="form-control" name="receipt_url" value="{{ old('receipt_url', $deposit->receipt_url) }}" placeholder="https://example.com/receipt.pdf">
        </div>
    </x-sakn-form-page>
@endsection
