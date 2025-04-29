@extends('layouts.admin.index')

@section('content')
<div class="container mt-4">
    <div class="card p-4">
        <div class="row align-items-center">
            <!-- Left Side: Welcome message -->
            <div class="col-md-8">
                <h3>Welcome, {{ Auth::user()->name }}!</h3>
                <p class="text-muted">"Great leaders don’t set out to be a leader… they set out to make a difference."</p>
            </div>

            <!-- Right Side: Profile image -->
            <div class="col-md-4 text-center">
                <img src="{{ Auth::user()->profile_image 
                    ? asset('storage/profile_images/' . Auth::user()->profile_image)
                    : asset('assets/img/default-profile.png') }}" 
                    class="rounded-circle border shadow" 
                    width="120" height="120" 
                    alt="Profile Image">
            </div>
        </div>
    </div>
</div>
@endsection
