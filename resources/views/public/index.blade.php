@extends('layouts.sakn')

@section('title', 'الرئيسية')

@section('styles')
<style>
    /* Swiper Hero Slider */
    .hero-slider {
        width: 100%;
        height: 85vh;
        position: relative;
    }
    
    .swiper-slide {
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        position: relative;
    }

    .swiper-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(to left, rgba(20, 38, 28, 0.8) 0%, rgba(20, 38, 28, 0.2) 100%);
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        color: #fff;
        max-width: 800px;
        padding-right: 5%;
    }

    .hero-subtitle {
        color: var(--sakn-gold, #BC9355);
        font-weight: 700;
        font-size: 1.2rem;
        letter-spacing: 2px;
        margin-bottom: 20px;
        display: block;
    }

    .hero-title {
        font-size: 4.5rem;
        font-weight: 900;
        margin-bottom: 25px;
        line-height: 1.2;
        text-shadow: 0 4px 20px rgba(0,0,0,0.3);
    }

    .hero-desc {
        font-size: 1.3rem;
        font-weight: 300;
        margin-bottom: 40px;
        color: #f8f9fa;
        max-width: 600px;
        line-height: 1.8;
    }

    .btn-hero {
        display: inline-block;
        background-color: var(--sakn-gold, #BC9355);
        color: #fff;
        padding: 15px 40px;
        font-size: 1.1rem;
        font-weight: 700;
        text-decoration: none;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .btn-hero:hover {
        background-color: #a37c44;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(188, 147, 85, 0.3);
    }

    /* Swiper Navigation Customization */
    .swiper-button-next, .swiper-button-prev {
        color: #fff !important;
        opacity: 0.7;
        transition: opacity 0.3s;
    }
    
    .swiper-button-next:hover, .swiper-button-prev:hover {
        opacity: 1;
    }

    .swiper-pagination-bullet {
        background: #fff !important;
        opacity: 0.5;
        width: 12px;
        height: 12px;
    }
    
    .swiper-pagination-bullet-active {
        background: var(--sakn-gold, #BC9355) !important;
        opacity: 1;
        width: 30px;
        border-radius: 6px;
    }
</style>
@endsection

@section('content')
    <!-- Swiper Hero Section -->
    <div class="swiper hero-slider">
        <div class="swiper-wrapper">
            
            <!-- Slide 1 -->
            <div class="swiper-slide" style="background-image: url('https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&q=80&w=2000');">
                <div class="swiper-overlay"></div>
                <div class="container hero-content">
                    <span class="hero-subtitle">تحف معمارية للمستقبل</span>
                    <h1 class="hero-title">نصنع الفخامة،<br>ونبني أسلوب حياة</h1>
                    <p class="hero-desc">شركة سكن للتطوير العقاري تقدم أرقى المشاريع السكنية والتجارية الحصرية، مصممة بعناية فائقة لتلبي تطلعاتك وترتقي بمفهوم السكن الحديث.</p>
                    <a href="{{ route('explore') }}" class="btn-hero">استكشف مشاريعنا</a>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="swiper-slide" style="background-image: url('https://images.unsplash.com/photo-1613490493576-7fde63acd811?auto=format&fit=crop&q=80&w=2000');">
                <div class="swiper-overlay"></div>
                <div class="container hero-content">
                    <span class="hero-subtitle">إطلاق جديد</span>
                    <h1 class="hero-title">مجمع النخبة<br>السكني</h1>
                    <p class="hero-desc">اكتشف أحدث مشاريعنا المكتملة، فلل فاخرة توفر إطلالات بانورامية وتصاميم معمارية لا مثيل لها تضمن لك الخصوصية المطلقة.</p>
                    <a href="#" class="btn-hero">عرض التفاصيل</a>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="swiper-slide" style="background-image: url('https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80&w=2000');">
                <div class="swiper-overlay"></div>
                <div class="container hero-content">
                    <span class="hero-subtitle">استثمار آمن</span>
                    <h1 class="hero-title">التميز<br>التجاري</h1>
                    <p class="hero-desc">مواقع استراتيجية لنجاح أعمالك. استكشف محفظتنا من المساحات التجارية الفاخرة المصممة خصيصاً للشركات الرائدة.</p>
                    <a href="#" class="btn-hero">اكتشف المزيد</a>
                </div>
            </div>

        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        <!-- Add Navigation -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

    <!-- Latest Properties -->
    <section class="section" style="margin-top: 50px;">
        <div class="container">
            <div class="section-title">
                <p>محفظتنا الحصرية</p>
                <h2>أحدث الوحدات المتاحة</h2>
            </div>
            
            <div class="card-grid">
                @forelse($properties as $property)
                    <div class="card" style="box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: transform 0.3s;">
                        <div class="card-img" style="height: 250px;">
                            @if($property->images->where('is_main', true)->first())
                                <img src="{{ asset('storage/' . $property->images->where('is_main', true)->first()->url) }}" alt="{{ $property->title }}" style="object-fit: cover; width: 100%; height: 100%;">
                            @else
                                <img src="https://images.unsplash.com/photo-1580587771525-78b9dba3b914?auto=format&fit=crop&q=80&w=600" alt="Fallback" style="object-fit: cover; width: 100%; height: 100%;">
                            @endif
                            <div class="badge" style="background: var(--sakn-gold, #BC9355); font-weight: bold;">{{ strtoupper($property->status) }}</div>
                        </div>
                        <div class="card-body" style="padding: 25px;">
                            <div class="price-tag" style="color: var(--sakn-gold, #BC9355); font-size: 1.4rem; font-weight: 800; margin-bottom: 10px;">{{ number_format($property->price) }} ريال</div>
                            <h3 class="card-title" style="font-size: 1.25rem; font-weight: 800; margin-bottom: 10px;">{{ $property->title }}</h3>
                            <p style="color: var(--text-muted); font-size: 14px; margin-bottom: 20px;"><i class="bi bi-geo-alt-fill" style="color: var(--sakn-gold, #BC9355);"></i> {{ $property->city }}، {{ $property->district }}</p>
                            
                            <div class="card-meta" style="border-top: 1px solid #eee; padding-top: 15px; display: flex; gap: 15px;">
                                <span style="font-weight: 600;"><i class="bi bi-arrows-fullscreen" style="color: var(--sakn-gold, #BC9355);"></i> 250 م²</span>
                                <span style="font-weight: 600;"><i class="bi bi-door-open" style="color: var(--sakn-gold, #BC9355);"></i> 4 غرف</span>
                                <span style="font-weight: 600;"><i class="bi bi-droplet" style="color: var(--sakn-gold, #BC9355);"></i> 3 حمام</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <p style="grid-column: span 3; text-align: center; padding: 50px; font-size: 1.2rem; color: #666;">لا توجد وحدات متاحة في محفظتنا حالياً. يرجى زيارتنا لاحقاً.</p>
                @endforelse
            </div>
            
            <div style="text-align: center; margin-top: 50px;">
                <a href="{{ route('explore') }}" class="btn btn-outline" style="padding: 15px 50px; font-weight: bold;">عرض المحفظة الكاملة</a>
            </div>
        </div>
    </section>

    <!-- Agent Teaser -->
    <section class="section section-alt" style="background-color: #f9f9f9; padding: 80px 0;">
        <div class="container">
            <div style="display: flex; align-items: center; gap: 50px; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 300px;">
                    <p style="color: var(--sakn-gold, #BC9355); font-weight: 700; margin-bottom: 10px;">إدارة المبيعات</p>
                    <h2 style="font-size: 40px; color: var(--sakn-green, #2F4F3E); margin-bottom: 20px; font-weight: 800;">بوابة وكلاء سكن</h2>
                    <p style="margin-bottom: 30px; font-size: 1.1rem; line-height: 1.8;">نظام متكامل مخصص حصرياً لموظفي ووكلاء مبيعات شركة سكن للتطوير العقاري. قم بإدارة الوحدات، جدولة زيارات العملاء، واعتماد طلبات الشراء بكل احترافية وموثوقية عبر منصتك الداخلية.</p>
                    <a href="{{ route('login') }}" class="btn btn-primary" style="padding: 15px 40px; font-weight: bold;">تسجيل الدخول كوكيل</a>
                </div>
                <div style="flex: 1; min-width: 300px;">
                    <div style="background: var(--sakn-green, #2F4F3E); height: 400px; border: 10px solid #fff; box-shadow: 0 20px 40px rgba(0,0,0,0.1); position: relative;">
                        <!-- Placeholder for an image -->
                        <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&q=80&w=800" alt="Sakn Agents" style="width: 100%; height: 100%; object-fit: cover;">
                        <div style="position: absolute; bottom: 20px; right: -20px; background: var(--sakn-gold, #BC9355); color: #fff; padding: 15px 30px; font-weight: bold; box-shadow: 0 10px 20px rgba(0,0,0,0.2);">
                            فريق مبيعات النخبة
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    // Initialize Swiper
    document.addEventListener('DOMContentLoaded', function () {
        const swiper = new Swiper('.hero-slider', {
            loop: true,
            effect: 'fade',
            speed: 1000,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    });
</script>
@endsection
