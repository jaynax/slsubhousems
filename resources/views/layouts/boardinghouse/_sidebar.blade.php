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

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->routeIs('boardinghouse.dashboard') ? 'active' : '' }}">
            <a href="{{ route('boardinghouse.dashboard') }}" class="menu-link">
                <i class="menu-icon bx bx-home-circle"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        <!-- Tenants Management -->
        <!-- <li class="menu-item {{ request()->is('boardinghouse/tenant*') ? 'active' : '' }}">
            <a href="{{ route('tenant.edit', ['tenant' => Auth::user()->boardingHouse->tenants()->first()?->id ?? 0]) }}#tenants" class="menu-link">
                <i class="menu-icon bx bx-user-check"></i>
                <div data-i18n="Tenants">Tenants</div>
            </a>
        </li> -->

        <!-- Profile Edit -->
        <li class="menu-item">
    <a href="{{ route('profile.edit') }}" class="menu-link" style="background-color: #e0f7fa; border-radius: 8px; margin-top: 10px;">
        <i class="menu-icon bx bx-user-circle"></i>
        <span>Edit Profile</span>
    </a>
</li>
<!-- Tenants List (Index) -->
<li class="menu-item {{ request()->routeIs('boardinghouse.tenants.index') ? 'active' : '' }}">
    <a href="{{ route('boardinghouse.tenants.index') }}" class="menu-link">
        <i class="menu-icon bx bx-list-ul"></i>
        <div data-i18n="Tenants List">Tenants List</div>
    </a>
</li>
<!-- Edit Boarding House -->
<li class="menu-item {{ request()->routeIs('boardinghouse.edit') ? 'active' : '' }}">
    <a href="{{ route('boardinghouse.edit') }}" class="menu-link" style="background-color: #e0f7fa; border-radius: 8px; margin-top: 10px;">
        <i class="menu-icon bx bx-buildings"></i>
        <span>Edit Boarding House</span>
    </a>
</li>

    </ul>
</aside>
