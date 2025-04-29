<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="logo" style="position: fixed; top: 20px; left: 20px; z-index: 1000;">
        <a href="{{ url('/') }}" class="app-brand-link d-flex align-items-center">
            <span class="app-brand-logo demo" 
                  style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; border: 2px solid #ddd; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); display: flex; align-items: center; justify-content: center;">
                <img src="{{ asset('assets/img/logo/logo-slsu.png') }}" 
                     alt="SLSU Logo" 
                     class="img-fluid" 
                     style="width: 100%; height: 100%; object-fit: cover;">
            </span>
            <p style="margin-left: 10px; font-weight: bold; color: #333;">SLSUBHMS</p>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1" style="margin-top: 140px;">
        <!-- Dashboard -->
        <li class="menu-item">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon bx bx-home-circle"></i>
                <span data-i18n="Analytics">Dashboard</span>
            </a>
        </li>
        <!-- Edit Profile Button -->
<li class="menu-item">
    <a href="{{ route('profile.edit') }}" class="menu-link" style="background-color: #e0f7fa; border-radius: 8px; margin-top: 10px;">
        <i class="menu-icon bx bx-user-circle"></i>
        <span>Edit Profile</span>
    </a>
</li>

        <!-- Login History -->
     
        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon bx bx-calendar"></i>
                <span>Registered Since: {{ Auth::user()->created_at->format('M d, Y') }}</span>
            </a>
        </li>


        <!-- View Full Login History Button -->
        <li class="menu-item">
            <a href="{{ route('login.history') }}" class="menu-link" style="background-color: #f0f0f0; border-radius: 8px; margin-top: 10px;">
                <i class="menu-icon bx bx-list-ul"></i>
                <span>View Full Login History</span>
            </a>
        </li>
    </ul>
    <!-- View Full Login History Button -->
<li class="menu-item">
    <a href="{{ route('login.history') }}" class="menu-link" style="background-color: #f0f0f0; border-radius: 8px; margin-top: 10px;">
        <i class="menu-icon bx bx-list-ul"></i>
        <span>View Full Login History</span>
    </a>
</li>



</aside>
