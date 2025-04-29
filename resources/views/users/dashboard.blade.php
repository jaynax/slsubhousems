@extends('layouts.users.index')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <!-- User Profile Card -->
        <div class="col-md-6 col-lg-4 mx-auto mb-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <!-- User Profile Image -->
                    <div class="mb-3 text-center">
                        <img id="profile-preview" 
                             src="{{ Auth::user()->profile_image ? asset('storage/profile_images/' . Auth::user()->profile_image) : asset('assets/img/default-profile.png') }}" 
                             class="rounded-circle border border-2 shadow-sm" 
                             style="width: 150px; height: 150px; object-fit: cover;">
                    </div>

                    <!-- User Name -->
                    <h5 class="card-title">{{ Auth::user()->name }}</h5>

                    <!-- User Info -->
                   
                                      <p><i class="fas fa-envelope"></i> {{ Auth::user()->email }}</p>
                    <p class="mt-2"><i class="fas fa-calendar"></i> Member Since: {{ Auth::user()->created_at->format('M d, Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    
        
                    <form action="{{ route('tenant.request') }}" method="POST">
                        @csrf
                        

                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">👤 Full Name:</label>
                                <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" required readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">📞 Contact Number:</label>
                                <input type="text" name="contact_number" class="form-control" value="{{ Auth::user()->phone }}" required readonly>
                            </div>

                        

                            <div class="mb-3">
                                <label class="form-label">📜 Additional Notes:</label>
                                <textarea name="notes" class="form-control" rows="3" placeholder="Any special requests?"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success w-100">Submit Application</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
       
    </div>
</div>

<footer class="bg-light text-center py-3 mt-4">
    <div class="container">
        <h5 class="fw-bold">📅 Calendar</h5>
        <div id="calendar"></div>
    </div>
</footer>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let today = new Date();
        let options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById("calendar").innerHTML = `<p class="fw-bold text-primary">${today.toLocaleDateString('en-US', options)}</p>`;
    });
</script>

@endsection
