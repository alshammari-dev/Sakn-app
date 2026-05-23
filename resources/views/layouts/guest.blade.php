<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sakn') }} - Authentication</title>

    <!-- Google Fonts: Outfit -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --sakn-green: #2F4F3E;
            --sakn-green-dark: #14261C;
            --sakn-gold: #BC9355;
            --sakn-gold-light: #e0d8c3;
        }

        body {
            font-family: 'Outfit', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }

        /* Split Screen Layout */
        .auth-wrapper {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        /* Left Side: Form Area */
        .auth-form-side {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
            background-color: #ffffff;
            position: relative;
        }

        .auth-container {
            width: 100%;
            max-width: 420px;
        }

        /* Right Side: Image Area */
        .auth-image-side {
            flex: 1.2;
            background: url("{{ asset('assets/img/hero.png') }}") no-repeat center center;
            background-size: cover;
            position: relative;
            display: none;
        }

        @media (min-width: 992px) {
            .auth-image-side {
                display: block;
            }
        }

        .auth-image-overlay {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(135deg, rgba(47, 79, 62, 0.85) 0%, rgba(20, 38, 28, 0.95) 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 50px;
            color: #ffffff;
        }

        .overlay-content h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 20px;
            letter-spacing: -1px;
            text-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .overlay-content p {
            font-size: 1.2rem;
            font-weight: 300;
            color: var(--sakn-gold-light);
            max-width: 500px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* Form Styling Elements */
        .auth-logo {
            height: 60px;
            margin-bottom: 40px;
            transition: transform 0.3s ease;
        }

        .auth-logo:hover {
            transform: scale(1.05);
        }

        .form-label {
            font-weight: 600;
            color: var(--sakn-green);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }

        .form-label i {
            color: var(--sakn-gold);
            margin-right: 8px;
            font-size: 1rem;
        }

        .form-control {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 14px 16px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            color: #1e293b;
            background-color: #f8fafc;
        }

        .form-control:focus {
            border-color: var(--sakn-gold);
            box-shadow: 0 0 0 4px rgba(188, 147, 85, 0.15);
            background-color: #ffffff;
        }

        .btn-sakn-identity {
            background: linear-gradient(135deg, var(--sakn-green) 0%, var(--sakn-green-dark) 100%);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 15px;
            font-weight: 700;
            width: 100%;
            margin-top: 20px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 10px 20px rgba(47, 79, 62, 0.15);
        }

        .btn-sakn-identity:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 25px rgba(47, 79, 62, 0.25);
            color: var(--sakn-gold);
        }

        .auth-footer-links {
            margin-top: 40px;
            text-align: center;
            font-size: 0.85rem;
        }

        .auth-footer-links a {
            color: var(--sakn-gold);
            text-decoration: none;
            font-weight: 700;
            transition: color 0.3s ease;
        }

        .auth-footer-links a:hover {
            color: var(--sakn-green);
        }

        .alert-error {
            background-color: #fff1f2;
            border: 1px solid #fee2e2;
            color: #991b1b;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        .alert-error ul {
            margin-bottom: 0;
            padding-left: 20px;
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
            0% { transform: scale(0.95); opacity: 0.8; }
            50% { transform: scale(1); opacity: 1; }
            100% { transform: scale(0.95); opacity: 0.8; }
        }
        .preloader-hidden {
            opacity: 0 !important;
            visibility: hidden !important;
        }
    </style>

    <div class="auth-wrapper">
        <!-- Left Side: Form Area -->
        <div class="auth-form-side">
            <div class="auth-container">
                <div class="text-center">
                    <a href="/">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Sakn Logo" class="auth-logo">
                    </a>
                </div>
                
                <div class="auth-card-content">
                    {{ $slot }}
                </div>

                <div class="auth-footer-links text-muted">
                    <a href="/"><i class="bi bi-arrow-left"></i> Back to Home</a>
                    <div class="mt-3" style="font-size: 0.75rem;">
                        &copy; {{ date('Y') }} <span style="color: var(--sakn-green); font-weight: 800;">SAKN</span>. All rights reserved.
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Luxury Image & Branding -->
        <div class="auth-image-side">
            <div class="auth-image-overlay">
                <div class="overlay-content">
                    <h1>Elevate Your Living</h1>
                    <p>Join the most exclusive real estate community. Discover premium properties, manage investments, and experience luxury living tailored just for you.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const preloader = document.getElementById('preloader');
            
            setTimeout(() => {
                if (preloader) {
                    preloader.classList.add('preloader-hidden');
                    setTimeout(() => {
                        preloader.style.display = 'none';
                    }, 500);
                }
            }, 1500); // Slightly faster preloader for auth pages
        });
    </script>
</body>
</html>
