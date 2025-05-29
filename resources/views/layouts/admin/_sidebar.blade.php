<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <!-- Logo -->
    <div class="logo d-flex align-items-center" style="padding: 20px; text-align: center;">
        <a href="{{ url('/') }}" class="app-brand-link d-flex align-items-center">
            <span class="app-brand-logo demo"
                  style="width: 80px; height: 80px; border-radius: 50%; overflow: hidden; border: 2px solid #ddd; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); display: flex; align-items: center; justify-content: center;">
                <img src="{{ asset('assets/img/logo/logo-slsu.png') }}" 
                     alt="SLSU Logo" 
                     class="img-fluid" 
                     style="width: 100%; height: 100%; object-fit: cover;">
            </span>
            <p style="margin-left: 10px; font-weight: bold; color: #333;">SLSUBHMS</p>
        </a>
    </div>

    <!-- Menu -->
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
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
<!-- Manage Users -->
<li class="menu-item">
    <a href="{{ route('manage.users') }}" class="menu-link" style="background-color: #e0f7fa; border-radius: 8px; margin-top: 10px;">
        <i class="menu-icon bx bx-user"></i>
        <span>Manage Users</span>
    </a>
</li>


        <!-- Boarding Houses -->
        <li class="menu-item">
            <a href="{{ route('admin.boardinghouse.index') }}" class="menu-link">
                <i class="menu-icon bx bx-building-house"></i>
                <span data-i18n="BoardingHouses">Boarding Houses</span>
            </a>
        </li>
    </ul>
</aside>