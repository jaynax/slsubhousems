@extends('layouts.admin.index')

@section('content')
<div class="container mt-4">

    {{-- Welcome Card --}}
    <div class="card p-4 mb-4">
        <div class="row align-items-center">
            {{-- Left Side: Welcome message --}}
            <div class="col-md-8">
                <h3>Welcome, Admin {{ Auth::user()->name }}!</h3>
                <p class="text-muted">"Great leaders don’t set out to be a leader… they set out to make a difference."</p>
            </div>

            {{-- Right Side: Profile image --}}
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

    {{-- Stats Cards --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Boarding Houses</h5>
                    <h2>{{ $totalBoardingHouses }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <h2>{{ $totalUsers }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-warning shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Admins</h5>
                    <h2>{{ $totalAdmins }}</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- Tenants per Boarding House --}}
    <div class="card p-4">
        <h4>Tenants per Boarding House</h4>

        @foreach($boardingHouses as $house)
            <div class="mb-4">
                <h5 class="mb-3">{{ $house->name }}</h5>

                @if($house->tenants->isEmpty())
                    <p>No tenants currently.</p>
                @else
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Profile Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Room Number</th>
                                <th>Move-in Date</th>
                                <th>Payment Amount</th>
                                <th>Other Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($house->tenants as $tenant)
                                <tr>
                                    <td class="text-center">
                                        <img 
                                            src="{{ $tenant->user && $tenant->user->profile_image 
                                                ? asset('storage/profile_images/' . $tenant->user->profile_image) 
                                                : asset('assets/img/default-profile.png') }}" 
                                            alt="Profile Image" 
                                            class="rounded-circle border shadow" 
                                            width="50" height="50">
                                    </td>
                                    <td>{{ $tenant->user->name ?? 'N/A' }}</td>
                                    <td>{{ $tenant->user->email ?? 'N/A' }}</td>
                                    <td>{{ $tenant->user->phone ?? 'N/A' }}</td>
                                    <td>{{ $tenant->room_number }}</td>
                                    <td>{{ \Carbon\Carbon::parse($tenant->move_in_date)->format('M d, Y') }}</td>
                                    <td>
                                        {{ $tenant->due_amount !== null 
                                            ? '₱' . number_format($tenant->due_amount, 2) 
                                            : '₱0.00' }}
                                    </td>
                                    <td>{{ $tenant->other_details ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
