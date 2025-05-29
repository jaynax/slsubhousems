@extends('layouts.boardinghouse.index')

@section('content')
<div class="container mt-4">
    <div class="card p-4">

        {{-- Boarding House Info --}}
        @if(isset($boardinghouse))
            @if($boardinghouse->image)
                <div class="mb-3 text-center">
                    <img src="{{ asset('storage/boardinghouses/' . $boardinghouse->image) }}" alt="Boarding House Image" class="img-fluid rounded" style="max-height: 300px;">
                </div>
            @endif
            <h3 class="mb-4 text-primary">{{ $boardinghouse->name }}</h3>
            <p><strong>📍 Location:</strong> {{ $boardinghouse->location }}</p>
            <p><strong>📞 Contact:</strong> {{ $boardinghouse->contact_number }}</p>
            <p><strong>📝 Description:</strong> {{ $boardinghouse->description ?? 'No description.' }}</p>
        @else
            <div class="alert alert-info">
                {{ $info ?? 'Please register your boarding house first.' }}
            </div>
        @endif

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Tenant Applications --}}
        <h4 class="mt-4 mb-3">👥 Tenant Applications</h4>

        @if(isset($tenants) && $tenants->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Profile Image</th>
                            <th>Tenant Name</th>
                            <th>Room No.</th>
                            <th>Status</th>
                            <th>Due (PHP)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tenants as $tenant)
                            <tr>
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
                                <td>{{ $tenant->name }}</td>
                                <td>{{ $tenant->room_number ?? 'Not assigned' }}</td>
                                <td class="text-center">
                                    @switch($tenant->status)
                                        @case('pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                            @break
                                        @case('approved')
                                            <span class="badge bg-success">Approved</span>
                                            @break
                                        @case('rejected')
                                            <span class="badge bg-danger">Denied</span>
                                            @break
                                        @default
                                            <span class="badge bg-secondary">{{ ucfirst($tenant->status) }}</span>
                                    @endswitch
                                </td>
                                <td class="text-center">{{ number_format($tenant->due_amount ?? 0, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">No tenant applications yet.</p>
        @endif

    </div>
</div>
@endsection
