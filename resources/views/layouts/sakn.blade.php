<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SAKN COMPANY</title>
    <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
    <link href="{{ asset('assets/img/logo.png') }}" rel="apple-touch-icon">
    
    <!-- Google Fonts: Tajawal -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Main Style -->
    <link rel="stylesheet" href="{{ asset('css/sakn.css') }}">
    
    @yield('styles')
</head>
<body>

    <!-- Header -->
    <header class="header">
        <div class="container nav-container">
            <a href="{{ route('home') }}" class="logo">
                <span>SAKN</span>
                <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
    <link href="{{ asset('assets/img/logo.png') }}" rel="apple-touch-icon">
            </a>
            
            <nav class="nav-links">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('explore') }}">مشاريعنا</a>
                <a href="{{ route('explore') }}">الوحدات المتاحة</a>
                <a href="{{ route('about') }}">عن الشركة</a>
            </nav>
            
            <div class="nav-actions">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">لوحة التحكم</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline">بوابة الوكلاء</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <h2 class="logo" style="color: #fff; margin-bottom: 20px;">سَـ<span>كَن</span></h2>
                    <p>شركة سكن للتطوير العقاري هي رائدة في بناء وتطوير المشاريع السكنية والتجارية الفاخرة. نحن نصنع أسلوب حياة استثنائي يجمع بين الفخامة والابتكار.</p>
                </div>
                <div>
                    <h4>روابط سريعة</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">الرئيسية</a></li>
                        <li><a href="{{ route('explore') }}">مشاريعنا الحالية</a></li>
                        <li><a href="{{ route('explore') }}">مشاريع مستقبلية</a></li>
                        <li><a href="{{ route('faqs') }}">الأسئلة الشائعة</a></li>
                    </ul>
                </div>
                <div>
                    <h4>وحداتنا</h4>
                    <ul class="footer-links">
                        <li><a href="#">فلل النخبة</a></li>
                        <li><a href="#">شقق بانورامية</a></li>
                        <li><a href="#">مكاتب تجارية</a></li>
                        <li><a href="#">مجمعات سكنية</a></li>
                    </ul>
                </div>
                <div>
                    <h4>تواصل معنا</h4>
                    <ul class="footer-links">
                        <li><i class="bi bi-geo-alt-fill me-2"></i> الرياض، المملكة العربية السعودية</li>
                        <li><i class="bi bi-envelope-fill me-2"></i> management@sakn.app</li>
                        <li><i class="bi bi-telephone-fill me-2"></i> +966 500 000 000</li>
                    </ul>
                </div>
            </div>
            
            <div class="bottom-footer">
                &copy; {{ date('Y') }} جميع الحقوق محفوظة لشركة سكن للتطوير العقاري.
            </div>
        </div>
    </footer>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
