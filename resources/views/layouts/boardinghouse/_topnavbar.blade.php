<!-- Navbar -->
<nav
    class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar"
>
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>
    
   

    <!-- Navbar Items -->
    <ul class="navbar-nav flex-row align-items-center ms-auto">
        <!-- Dark/Light Mode Toggle -->
        <li class="nav-item">
            <a href="javascript:void(0);" id="theme-toggle" class="nav-link">
                <i id="theme-icon" class="bx bx-moon fs-4"></i>
            </a>
        </li>

        <!-- User -->
        <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                <div class="avatar avatar-online">
                    <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="#">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar avatar-online">
                                    <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                    </a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="dropdown-item">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 text-dark">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">Log Out</span>
                        </button>
                    </form>
                </li>
            </ul>
        </li>
        <!--/ User -->
    </ul>
</nav>

<!-- Main Content -->
<div class="container-xxl mt-4">
    <div class="content-wrapper mx-auto">
       
    </div>
</div>

<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        const rootElement = document.documentElement;

        // Load saved theme from localStorage
        const currentTheme = localStorage.getItem('theme') || 'light';
        rootElement.setAttribute('data-theme', currentTheme);
        themeIcon.className = currentTheme === 'dark' ? 'bx bx-sun fs-4' : 'bx bx-moon fs-4';

        // Toggle theme on icon click
        themeToggle.addEventListener('click', () => {
            const newTheme = rootElement.getAttribute('data-theme') === 'light' ? 'dark' : 'light';
            rootElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);

            // Update icon
            themeIcon.className = newTheme === 'dark' ? 'bx bx-sun fs-4' : 'bx bx-moon fs-4';
        });
    });
</script>

<!-- Styles -->
<style>
    /* Global Theme Variables */
    :root {
        --bg-color: #ffffff;
        --text-color: #000000;
    }

    [data-theme="dark"] {
        --bg-color: #333333;
        --text-color: #ffffff;
    }

    /* Apply Theme */
    body {
        background-color: var(--bg-color);
        color: var(--text-color);
    }

    .navbar {
        background-color: var(--bg-color);
        color: var(--text-color);
    }

    .content-wrapper {
        text-align: center;
        padding: 15px;
    }

    /* Responsive navbar search */
    @media (max-width: 768px) {
        .navbar-search {
            width: 100%;
            padding: 10px;
        }
    }
</style>
