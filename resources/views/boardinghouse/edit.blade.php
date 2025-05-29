@extends('layouts.boardinghouse.index')

@section('content')
@extends('layouts.boardinghouse.index')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow">
        <h2 class="mb-4 text-center fw-bold">Edit Boarding House Info</h2>

        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif

        <form id="boardinghouse-form" action="{{ route('boardinghouse.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Image Preview -->
            <div class="mb-4 text-center">
                <img id="image-preview"
                    src="{{ $boardingHouse->image ? asset('storage/' . $boardingHouse->image) : asset('assets/img/default-image.png') }}"
                    class="rounded border shadow-sm"
                    style="max-width: 200px; max-height: 150px; object-fit: cover;">
                <input type="file" name="image" id="image" class="form-control mt-2 @error('image') is-invalid @enderror" accept="image/*">
                @error('image')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Boarding House Name</label>
                <input type="text" name="name" id="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $boardingHouse->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Location -->
            <div class="mb-3">
                <label for="location" class="form-label fw-semibold">Location</label>
                <input type="text" name="location" id="location"
                    class="form-control @error('location') is-invalid @enderror"
                    value="{{ old('location', $boardingHouse->location) }}" required>
                @error('location')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Contact -->
            <div class="mb-3">
                <label for="contact_number" class="form-label fw-semibold">Contact Number</label>
                <input type="text" name="contact_number" id="contact_number"
                    class="form-control @error('contact_number') is-invalid @enderror"
                    value="{{ old('contact_number', $boardingHouse->contact_number) }}" required>
                @error('contact_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label fw-semibold">Description</label>
                <textarea name="description" id="description" rows="4"
                    class="form-control @error('description') is-invalid @enderror"
                    placeholder="Add a description...">{{ old('description', $boardingHouse->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary px-4">Update Info</button>
            </div>
        </form>
    </div>
</div>

<!-- JS: Image Preview -->
<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const reader = new FileReader();
        reader.onload = function () {
            document.getElementById('image-preview').src = reader.result;
        };
        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    });
</script>
@endsection
