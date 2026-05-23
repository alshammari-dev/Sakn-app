<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Sakn Dashboard</title>
    
    <!-- Favicons -->
    <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
    <link href="{{ asset('assets/img/logo.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Outfit', sans-serif !important;
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <!-- Preloader -->
    <div id="preloader" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: #ffffff; z-index: 999999; display: flex; align-items: center; justify-content: center; transition: opacity 0.5s ease, visibility 0.5s ease;">
        <div class="text-center d-flex align-items-center">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Sakn Logo" style="max-height: 80px; animation: saknPulse 2s infinite ease-in-out;">
            <span style="font-family: 'Outfit', sans-serif; font-size: 3rem; font-weight: 800; color: #2F4F3E; margin-left: 15px; letter-spacing: -2px;">SAKN</span>
        </div>
    </div>

    <style>
        @keyframes saknPulse {
            0% { transform: scale(0.9); opacity: 0.8; }
            50% { transform: scale(1); opacity: 1; }
            100% { transform: scale(0.9); opacity: 0.8; }
        }
        .preloader-hidden {
            opacity: 0 !important;
            visibility: hidden !important;
        }
    </style>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center text-decoration-none">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Sakn" class="me-2" style="height: 40px;">
                <span class="d-none d-lg-block fw-bold text-dark" style="font-size: 1.5rem; letter-spacing: -1px;">Sakn</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn fs-4 text-dark ms-3"></i>
        </div>

       

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-4">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <div class="bg-light rounded-circle p-1 border me-2">
                            <i class="bi bi-person text-secondary fs-5 px-1"></i>
                        </div>
                        <span class="d-none d-md-block dropdown-toggle ps-1">{{ Auth::user()->name }}</span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header text-start">
                            <h6 class="fw-bold mb-0">{{ Auth::user()->name }}</h6>
                            <small class="text-muted">{{ Auth::user()->email }}</small>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('profile.edit') }}">
                                <i class="bi bi-person text-primary me-2"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right text-danger me-2"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </li>
            </ul>
        </nav>
    </header>

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? '' : 'collapsed' }}" href="{{ route('dashboard') }}">
                    <i class="bi bi-grid-1x2"></i>
                    <span>Overview</span>
                </a>
            </li>

            @can('role-list')
            <li class="nav-heading mt-4 mb-2 ps-3 text-uppercase small fw-bold text-muted" style="font-size: 0.65rem; letter-spacing: 1px;">Access Management</li>
            

            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('roles.*') ? '' : 'collapsed' }}" href="{{ route('roles.index') }}">
                    <i class="bi bi-shield-lock"></i>
                    <span>Roles</span>
                </a>
            </li>
            @endcan

            @can('user-list')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('users.*') ? '' : 'collapsed' }}" href="{{ route('users.index') }}">
                    <i class="bi bi-people"></i>
                    <span>Users</span>
                </a>
            </li>
            @endcan

            @can('permission-list')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('permissions.*') ? '' : 'collapsed' }}" href="{{ route('permissions.index') }}">
                    <i class="bi bi-key"></i>
                    <span>Permissions</span>
                </a>
            </li>
            @endcan

            @can('property-list')
            <li class="nav-heading mt-4 mb-2 ps-3 text-uppercase small fw-bold text-muted" style="font-size: 0.65rem; letter-spacing: 1px;">Real Estate</li>

            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('properties.*') ? '' : 'collapsed' }}" href="{{ route('properties.index') }}">
                    <i class="bi bi-house-door"></i>
                    <span>Properties</span>
                </a>
            </li>
            @endcan

            @can('visit-list')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('visits.*') ? '' : 'collapsed' }}" href="{{ route('visits.index') }}">
                    <i class="bi bi-calendar-event"></i>
                    <span>Visits</span>
                </a>
            </li>
            @endcan

            @can('offer-list')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('offers.*') ? '' : 'collapsed' }}" href="{{ route('offers.index') }}">
                    <i class="bi bi-tag"></i>
                    <span>Offers</span>
                </a>
            </li>
            @endcan

            @can('deposit-list')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('deposits.*') ? '' : 'collapsed' }}" href="{{ route('deposits.index') }}">
                    <i class="bi bi-cash-stack"></i>
                    <span>Deposits</span>
                </a>
            </li>
            @endcan

            @can('sale-approval-list')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('sale-approvals.*') ? '' : 'collapsed' }}" href="{{ route('sale-approvals.index') }}">
                    <i class="bi bi-check-all"></i>
                    <span>Approvals</span>
                </a>
            </li>
            @endcan
        </ul>
    </aside>

    <main id="main" class="main pb-5">
        @yield('main')
    </main>

    <footer id="footer" class="footer text-center">
        <div class="copyright">
            &copy; {{ date('Y') }} <strong><span>Sakn</span></strong>. Managed Real Estate Solutions.
        </div>
    </footer>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center border-0 shadow"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const preloader = document.getElementById('preloader');
            
            // Set to 2 seconds for a perfect balance
            setTimeout(() => {
                if (preloader) {
                    preloader.classList.add('preloader-hidden');
                    setTimeout(() => {
                        preloader.style.display = 'none';
                    }, 500);
                }
            }, 2000);

            // Global SweetAlert for Delete Forms
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                const methodInput = form.querySelector('input[name="_method"][value="DELETE"]');
                if (methodInput || form.classList.contains('delete-form')) {
                    form.removeAttribute('onsubmit');
                    const buttons = form.querySelectorAll('button[type="submit"], input[type="submit"]');
                    buttons.forEach(btn => btn.removeAttribute('onclick'));
                    
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this action!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#2F4F3E', // Sakn Green
                            cancelButtonColor: '#dc3545', // Danger Red
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'Cancel',
                            customClass: {
                                confirmButton: 'btn rounded-pill px-4 shadow-sm',
                                cancelButton: 'btn rounded-pill px-4 ms-2 shadow-sm'
                            },
                            buttonsStyling: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                }
            });
        });
    </script>
</body>
</html>
