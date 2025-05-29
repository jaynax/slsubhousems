@extends('layouts.users.index')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <!-- Welcome Message -->
            <div class="alert alert-primary text-center fw-bold fs-4">
                👋 Welcome, {{ Auth::user()->name }}!
            </div>

            <!-- User Profile Section -->
            <div class="card shadow-sm mb-4">
                <div class="row g-0 align-items-center">
                    <div class="col-md-4 text-center p-4">
                        <img id="profile-preview"
                            src="{{ Auth::user()->profile_image ? asset('storage/profile_images/' . Auth::user()->profile_image) : asset('assets/img/default-profile.png') }}"
                            class="rounded-circle border border-2 shadow-sm"
                            style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-title">{{ Auth::user()->name }}</h4>
                            <p><i class="fas fa-map-marker-alt"></i> {{ Auth::user()->address ?? 'No address provided' }}</p>
                            <p><i class="fas fa-phone"></i> {{ Auth::user()->phone ?? 'No phone provided' }}</p>
                            <p><i class="fas fa-envelope"></i> {{ Auth::user()->email }}</p>
                            <p><i class="fas fa-calendar"></i> Member Since: {{ Auth::user()->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Boarding House Section -->
            @if(!$tenantStatus || $tenantStatus === 'none' || $tenantStatus === 'rejected')
                <div class="card shadow-sm mb-4">
                    <div class="card-header fw-bold">🏠 Boarding Houses</div>
                    <div class="card-body">
                        @if($boardingHouses->count() > 0)
                            <div class="row g-3">
                                @foreach($boardingHouses as $house)
                                    <div class="col-md-12 mb-3">
                                        <div class="card border-primary shadow-sm">
                                            <div class="card-body">
                                                
                                                <!-- Boarding House Image Styled Like Profile -->
                                                <!-- Boarding House Image Styled Like Profile -->
                                                    <div class="text-center mb-4">
                                                        <img 
                                                            src="{{ $house->image ? asset('storage/boardinghouses/' . $house->image) : asset('assets/img/default-house.png') }}"
                                                            alt="{{ $house->name }} Image"
                                                            class="img-fluid border border-2 shadow-sm"
                                                            style="width: 100%; max-height: 300px; object-fit: cover;">
                                                    </div>

                                                <h5 class="card-title text-primary">{{ $house->name }}</h5>
                                                <p><strong>📍 Location:</strong> {{ $house->location }}</p>
                                                <p><strong>📞 Contact:</strong> {{ $house->contact_number }}</p>
                                                <p><strong>📝 Description:</strong> {{ $house->description ?? 'No description provided' }}</p>
                                                <p class="text-danger fw-semibold mt-3">💬 Please meet the owner in person to discuss payment and finalize your stay.</p>

                                                <form action="{{ route('tenant.apply') }}" method="POST" class="mt-3">
                                                    @csrf
                                                    <input type="hidden" name="boarding_house_id" value="{{ $house->id }}">
                                                    
                                                    <div class="mb-3">
                                                        <label for="contact_number_{{ $house->id }}" class="form-label">Contact Number</label>
                                                        <input type="text" name="contact_number" id="contact_number_{{ $house->id }}"
                                                            class="form-control" required
                                                            value="{{ old('contact_number', Auth::user()->phone) }}">
                                                    </div>
                                                    
                                                    <div class="mb-3">
                                                        <label for="notes_{{ $house->id }}" class="form-label">Additional Notes (Optional)</label>
                                                        <textarea name="notes" id="notes_{{ $house->id }}" class="form-control" rows="3">{{ old('notes') }}</textarea>
                                                    </div>

                                                    <button type="submit" class="btn btn-success w-100">Apply Now</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted">No boarding house details available right now.</p>
                        @endif
                    </div>
                </div>
            @elseif($tenantStatus === 'pending')
                <div class="alert alert-warning text-center fw-bold">
                    Your boarding house application is <span class="text-info">pending</span>. Please wait for confirmation.
                </div>
            @elseif($tenantStatus === 'approved' && $tenant)
                <div class="card shadow-sm mb-4">
                    <div class="card-header fw-bold">🏠 Your Stay Details</div>
                    <div class="card-body">
                        <p><strong>Full Name:</strong> {{ Auth::user()->name }}</p>
                        <p><strong>Contact Number:</strong> {{ $tenant->contact_number ?? Auth::user()->phone ?? 'N/A' }}</p>
                        <p><strong>Additional Notes:</strong> {{ $tenant->notes ?? 'No notes provided' }}</p>
                        <p><strong>Payment Status:</strong> {{ ucfirst($tenant->payment_status ?? 'Pending') }}</p>
                        <p><strong>Due Amount:</strong> ₱{{ number_format($tenant->due_amount ?? 0, 2) }}</p>
                        <p><strong>Room Number:</strong> {{ $tenant->room_number ?? 'Not assigned yet' }}</p>
                        <p><strong>Lease Period:</strong>
                            @if($tenant->start_date && $tenant->end_date)
                                {{ \Carbon\Carbon::parse($tenant->start_date)->format('M d, Y') }}
                                to
                                {{ \Carbon\Carbon::parse($tenant->end_date)->format('M d, Y') }}
                            @else
                                N/A
                            @endif
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Footer with Calendar -->
    <footer class="bg-light text-center py-3 mt-4">
        <div class="container">
            <h5 class="fw-bold">📅 Calendar</h5>
            <div id="calendar"></div>
        </div>
    </footer>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let today = new Date();
        let options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById("calendar").innerHTML = `<p class="fw-bold text-primary">${today.toLocaleDateString('en-US', options)}</p>`;
    });
</script>
@endsection
