@extends('layouts.admin.index')
{{-- Use your admin layout file --}}

@section('content')
<div class="container mt-4">
    <h2>Create Boarding House for {{ $user->name }}</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('manage.users.boardinghouse.store', $user->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Boarding House Name <span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" 
                class="form-control @error('name') is-invalid @enderror" 
                value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location <span class="text-danger">*</span></label>
            <input type="text" id="location" name="location" 
                class="form-control @error('location') is-invalid @enderror" 
                value="{{ old('location') }}" required>
            @error('location')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="capacity" class="form-label">Capacity <span class="text-danger">*</span></label>
            <input type="number" id="capacity" name="capacity" min="1" 
                class="form-control @error('capacity') is-invalid @enderror" 
                value="{{ old('capacity') }}" required>
            @error('capacity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="contact_number" class="form-label">Contact Number <span class="text-danger">*</span></label>
            <input type="text" id="contact_number" name="contact_number" 
                class="form-control @error('contact_number') is-invalid @enderror" 
                value="{{ old('contact_number') }}" required>
            @error('contact_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description (Optional)</label>
            <textarea id="description" name="description" rows="3" 
                class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create Boarding House</button>
        <a href="{{ route('manage.users.show', $user->id) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
