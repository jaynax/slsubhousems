@extends('layouts.users.index')

@section('content')
<div class="container mt-5">
    <div class="card p-4">
        <h2 class="mb-4">Edit Profile</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form id="profile-form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Corrected from POST to PUT -->

            <!-- Profile Image -->
            <div class="mb-3 text-center">
                <img id="profile-preview" 
                     src="{{ Auth::user()->profile && Auth::user()->profile->profile_image ? asset('storage/profile_images/' . Auth::user()->profile->profile_image) : asset('assets/img/default-profile.png') }}" 
                     class="rounded-circle border border-2 shadow-sm" width="150" height="150">
                <input type="file" name="profile_image" id="profile_image" class="form-control mt-2">
            </div>

            <!-- Name Field -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
            </div>

            <!-- Phone Field -->
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" id="phone" name="phone" class="form-control" value="{{ Auth::user()->profile->phone ?? '' }}">
            </div>

            <!-- Address Field -->
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea id="address" name="address" class="form-control">{{ Auth::user()->profile->address ?? '' }}</textarea>
            </div>

            <!-- Bio Field -->
            <div class="mb-3">
                <label for="bio" class="form-label">Bio</label>
                <textarea id="bio" name="bio" class="form-control">{{ Auth::user()->profile->bio ?? '' }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
</div>

<script>
document.getElementById('profile_image').addEventListener('change', function(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const newImage = reader.result;
        document.getElementById('profile-preview').src = newImage;
        
        // Update the navbar image as well (Ensures instant update without refresh)
        const navbarProfileImage = document.getElementById('navbar-profile-image');
        if (navbarProfileImage) {
            navbarProfileImage.src = newImage;
        }
    };
    reader.readAsDataURL(event.target.files[0]);
});
</script>
@endsection
