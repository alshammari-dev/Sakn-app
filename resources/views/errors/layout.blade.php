<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - {{ config('app.name', 'Sakn') }}</title>

    <!-- Google Fonts: Outfit -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --sakn-green: #2F4F3E;
            --sakn-gold: #BC9355;
            --sakn-gray: #64748B;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: #FFFFFF;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            color: var(--sakn-green);
        }

        .container {
            max-width: 600px;
            text-align: center;
            padding: 40px;
        }

        .error-header {
            margin-bottom: 40px;
        }

        .logo-img {
            height: 60px;
            margin-bottom: 30px;
        }

        .error-code {
            font-size: 120px;
            font-weight: 900;
            line-height: 1;
            margin: 0;
            color: var(--sakn-green);
            display: block;
        }

        .error-divider {
            width: 80px;
            height: 4px;
            background-color: var(--sakn-gold);
            margin: 20px auto;
        }

        .error-message {
            font-size: 32px;
            font-weight: 700;
            color: var(--sakn-gold);
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .error-description {
            font-size: 18px;
            color: var(--sakn-gray);
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .btn-sakn-solid {
            background-color: var(--sakn-green);
            color: #FFFFFF !important;
            padding: 16px 40px;
            border-radius: 4px;
            font-weight: 700;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: none;
        }

        .btn-sakn-solid:hover {
            background-color: #1a2e24;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .error-code {
                font-size: 80px;
            }
            .error-message {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="error-header">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Sakn Logo" class="logo-img">
        </div>

        <h1 class="error-code">@yield('code')</h1>
        
        <div class="error-divider"></div>
        
        <h2 class="error-message">@yield('message')</h2>
        
        <p class="error-description">
            @yield('description')
        </p>

        <a href="{{ url('/') }}" class="btn-sakn-solid">
            Back to Home
        </a>
    </div>
</body>
</html>
