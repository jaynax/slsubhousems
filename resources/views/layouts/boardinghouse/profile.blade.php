@extends('layouts.boardinghouse.index')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow">
        <h2 class="mb-4 text-center fw-bold">Edit Profile</h2>

        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <form id="profile-form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Profile Image -->
            <div class="mb-4 text-center">
                <img id="profile-preview" 
                     src="{{ Auth::user()->profile_image ? asset('storage/profile_images/' . Auth::user()->profile_image) : asset('assets/img/default-profile.png') }}" 
                     class="rounded-circle border border-2 shadow-sm" width="150" height="150">
                <input type="file" name="profile_image" id="profile_image" class="form-control mt-2" accept="image/*">
            </div>

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Name</label>
                <input type="text" id="name" name="name" 
                       class="form-control" 
                       value="{{ old('name', Auth::user()->name) }}" required>
            </div>

            <!-- Email (read-only) -->
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input type="email" id="email" name="email" 
                       class="form-control" 
                       value="{{ Auth::user()->email }}" readonly>
            </div>

            <!-- Address -->
            <div class="mb-3">
                <label for="address" class="form-label fw-semibold">Address</label>
                <input type="text" id="address" name="address" 
                       class="form-control" 
                       value="{{ old('address', Auth::user()->address) }}">
            </div>

            <!-- Phone -->
            <div class="mb-3">
                <label for="phone" class="form-label fw-semibold">Phone Number</label>
                <input type="text" id="phone" name="phone" 
                       class="form-control" 
                       value="{{ old('phone', Auth::user()->phone) }}">
            </div>

            <!-- Submit -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary px-4">Update Profile</button>
            </div>
        </form>
    </div>
</div>

<!-- Image Preview Script -->
<script>
document.getElementById('profile_image').addEventListener('change', function(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const newImage = reader.result;
        document.getElementById('profile-preview').src = newImage;

        const navbarProfileImage = document.getElementById('navbar-profile-image');
        if (navbarProfileImage) {
            navbarProfileImage.src = newImage;
        }
    };
    if (event.target.files[0]) {
        reader.readAsDataURL(event.target.files[0]);
    }
});
</script>
@endsection
