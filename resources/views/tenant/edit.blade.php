@extends('layouts.boardinghouse.index')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Tenant Application</h2>

    <!-- Flash messages for feedback -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('tenant.update', $tenant->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Tenant Name</label>
            <input type="text" class="form-control" value="{{ $tenant->name }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Contact Number</label>
            <input type="text" class="form-control" value="{{ $tenant->contact_number }}" disabled>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Application Status</label>
            <select name="status" class="form-select" required>
                <option value="Pending" {{ $tenant->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Approved" {{ $tenant->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                <option value="Rejected" {{ $tenant->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="room_number" class="form-label">Room Number</label>
            <input type="text" name="room_number" class="form-control" value="{{ $tenant->room_number }}">
        </div>

        <div class="mb-3">
            <label for="due_amount" class="form-label">Due Amount (₱)</label>
            <input type="number" name="due_amount" class="form-control" step="0.01" value="{{ $tenant->due_amount }}">
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea name="notes" class="form-control" rows="4">{{ $tenant->notes }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Tenant</button>
        <a href="{{ route('boardinghouse.tenants.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
    