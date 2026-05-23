<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sakn | Exclusive Real Estate Developer</title>

    <!-- Fonts: Outfit for body, Playfair Display for headings -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --sakn-green: #1A3626;
            --sakn-gold: #C5A059;
            --sakn-gold-hover: #D4AF68;
            --sakn-bg: #FDFCF8;
            --sakn-text: #222222;
            --sakn-muted: #666666;
            --sakn-light: #F4F1EA;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--sakn-bg);
            color: var(--sakn-text);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4, h5, h6, .playfair {
            font-family: 'Playfair Display', serif;
        }

        /* Navbar */
        .sakn-navbar {
            padding: 20px 0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: transparent;
        }
        
        .sakn-navbar.scrolled {
            background: rgba(26, 54, 38, 0.95);
            backdrop-filter: blur(10px);
            padding: 12px 0;
            box-shadow: 0 4px 30px rgba(0,0,0,0.1);
        }

        .sakn-navbar .nav-link {
            color: #ffffff;
            font-weight: 500;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin: 0 15px;
            position: relative;
        }

        .sakn-navbar .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 1px;
            bottom: -5px;
            left: 0;
            background-color: var(--sakn-gold);
            transition: width 0.3s ease;
        }

        .sakn-navbar .nav-link:hover::after {
            width: 100%;
        }
        
        .sakn-navbar .nav-link:hover {
            color: var(--sakn-gold);
        }

        .btn-portal {
            border: 1px solid rgba(255,255,255,0.3);
            color: #fff;
            padding: 10px 25px;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 0;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-portal:hover {
            border-color: var(--sakn-gold);
            background: var(--sakn-gold);
            color: #fff;
        }

        /* Hero Section */
        .hero-section {
            height: 100vh;
            width: 100%;
            position: relative;
        }

        .swiper-slide {
            position: relative;
            overflow: hidden;
        }

        .slide-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            transform: scale(1.1);
            transition: transform 10s linear;
        }

        .swiper-slide-active .slide-bg {
            transform: scale(1);
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to right, rgba(26, 54, 38, 0.85) 0%, rgba(26, 54, 38, 0.4) 100%);
        }

        .hero-content {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 10%;
            z-index: 10;
            max-width: 800px;
        }

        .hero-subtitle {
            color: var(--sakn-gold);
            font-family: 'Outfit', sans-serif;
            text-transform: uppercase;
            letter-spacing: 4px;
            font-size: 0.9rem;
            margin-bottom: 20px;
            display: block;
            opacity: 0;
            transform: translateY(20px);
            transition: all 1s ease 0.3s;
        }

        .hero-title {
            color: #fff;
            font-size: 5rem;
            line-height: 1.1;
            margin-bottom: 30px;
            opacity: 0;
            transform: translateY(20px);
            transition: all 1s ease 0.5s;
        }

        .hero-desc {
            color: #F4F1EA;
            font-size: 1.2rem;
            font-weight: 300;
            margin-bottom: 40px;
            max-width: 600px;
            opacity: 0;
            transform: translateY(20px);
            transition: all 1s ease 0.7s;
        }

        .swiper-slide-active .hero-subtitle,
        .swiper-slide-active .hero-title,
        .swiper-slide-active .hero-desc,
        .swiper-slide-active .hero-btn {
            opacity: 1;
            transform: translateY(0);
        }

        .hero-btn {
            display: inline-block;
            background: var(--sakn-gold);
            color: #fff;
            padding: 15px 40px;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.9rem;
            font-family: 'Outfit', sans-serif;
            text-decoration: none;
            border: 1px solid var(--sakn-gold);
            transition: all 0.4s ease;
            opacity: 0;
            transform: translateY(20px);
            transition: all 1s ease 0.9s;
        }

        .hero-btn:hover {
            background: transparent;
            color: var(--sakn-gold);
        }

        /* Sections General */
        .section-padding {
            padding: 100px 0;
        }

        .section-header {
            margin-bottom: 60px;
        }

        .sub-heading {
            color: var(--sakn-gold);
            text-transform: uppercase;
            letter-spacing: 3px;
            font-size: 0.85rem;
            font-weight: 600;
            display: block;
            margin-bottom: 15px;
            font-family: 'Outfit', sans-serif;
        }

        .main-heading {
            color: var(--sakn-green);
            font-size: 3rem;
            font-weight: 700;
        }

        /* About Section */
        .about-image-wrapper {
            position: relative;
            padding-right: 30px;
            padding-bottom: 30px;
        }
        .about-image-wrapper::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 80%;
            height: 80%;
            border: 2px solid var(--sakn-gold);
            z-index: -1;
        }
        .about-image {
            width: 100%;
            height: auto;
            z-index: 1;
            position: relative;
        }

        /* Portfolio */
        .property-card {
            background: #fff;
            box-shadow: 0 15px 40px rgba(0,0,0,0.03);
            transition: all 0.4s ease;
            height: 100%;
            border: 1px solid rgba(0,0,0,0.05);
        }
        
        .property-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(26, 54, 38, 0.1);
        }

        .img-container {
            position: relative;
            height: 350px;
            overflow: hidden;
        }

        .img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s ease;
        }

        .property-card:hover .img-container img {
            transform: scale(1.08);
        }

        .status-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: var(--sakn-green);
            color: var(--sakn-gold);
            padding: 6px 15px;
            font-size: 0.75rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            z-index: 2;
        }

        .card-content {
            padding: 30px;
        }

        .prop-price {
            color: var(--sakn-gold);
            font-size: 1.5rem;
            font-family: 'Playfair Display', serif;
            margin-bottom: 10px;
            display: block;
        }

        .prop-title {
            color: var(--sakn-green);
            font-size: 1.4rem;
            margin-bottom: 10px;
        }

        .prop-location {
            color: var(--sakn-muted);
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        .prop-features {
            display: flex;
            gap: 20px;
            border-top: 1px solid #eee;
            padding-top: 20px;
            margin-top: 20px;
        }
        
        .feature {
            font-size: 0.9rem;
            color: var(--sakn-muted);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .feature i {
            color: var(--sakn-gold);
        }

        /* Services */
        .bg-light-green {
            background-color: var(--sakn-light);
        }

        .service-box {
            padding: 40px;
            background: #fff;
            transition: all 0.3s ease;
            border-bottom: 3px solid transparent;
            height: 100%;
        }

        .service-box:hover {
            border-color: var(--sakn-gold);
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        .service-icon {
            font-size: 2.5rem;
            color: var(--sakn-gold);
            margin-bottom: 20px;
        }

        /* Stats */
        .stat-item h2 {
            font-size: 3.5rem;
            color: var(--sakn-green);
            margin-bottom: 5px;
        }
        .stat-item p {
            color: var(--sakn-gold);
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        /* Footer */
        footer {
            background-color: var(--sakn-green);
            color: #fff;
            padding: 80px 0 30px;
        }
        .footer-logo {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: #fff;
            margin-bottom: 30px;
            display: inline-block;
        }
        .footer-text {
            color: rgba(255,255,255,0.7);
            font-weight: 300;
            line-height: 1.8;
        }
        .footer-title {
            color: var(--sakn-gold);
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            margin-bottom: 25px;
        }
        .footer-links {
            list-style: none;
            padding: 0;
        }
        .footer-links li {
            margin-bottom: 12px;
        }
        .footer-links a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .footer-links a:hover {
            color: var(--sakn-gold);
        }
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            margin-top: 60px;
            padding-top: 30px;
            text-align: center;
            color: rgba(255,255,255,0.5);
            font-size: 0.9rem;
        }

        /* Custom Cursors or other small details */
        .btn-outline-gold {
            border: 1px solid var(--sakn-gold);
            color: var(--sakn-green);
            padding: 12px 35px;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }
        .btn-outline-gold:hover {
            background: var(--sakn-gold);
            color: #fff;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sakn-navbar fixed-top" id="navbar">
        <div class="container">
            <a class="navbar-brand text-white text-decoration-none" href="/">
                <h3 class="mb-0" style="font-family: 'Playfair Display'; letter-spacing: 2px; font-weight: 700;">SAKN.</h3>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list text-white fs-2"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Expertise</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
                <div class="d-flex align-items-center mt-3 mt-lg-0">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-portal">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-portal">Agent Portal</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Swiper -->
    <section class="hero-section">
        <div class="swiper heroSwiper h-100">
            <div class="swiper-wrapper">
                
                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <div class="slide-bg" style="background-image: url('https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&q=80&w=2000');"></div>
                    <div class="hero-overlay"></div>
                    <div class="hero-content">
                        <span class="hero-subtitle">Sakn Development</span>
                        <h1 class="hero-title">Redefining<br>Luxury Living.</h1>
                        <p class="hero-desc">Experience architectural brilliance and unparalleled elegance in the heart of the city's most exclusive neighborhoods.</p>
                        <a href="#portfolio" class="hero-btn">Discover Portfolio</a>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <div class="slide-bg" style="background-image: url('https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&q=80&w=2000');"></div>
                    <div class="hero-overlay"></div>
                    <div class="hero-content">
                        <span class="hero-subtitle">New Collection</span>
                        <h1 class="hero-title">The Palm<br>Residences.</h1>
                        <p class="hero-desc">Our signature villas offer breathtaking panoramic views, crafted meticulously for those who demand perfection.</p>
                        <a href="#contact" class="hero-btn">Schedule Viewing</a>
                    </div>
                </div>
                
                <!-- Slide 3 -->
                <div class="swiper-slide">
                    <div class="slide-bg" style="background-image: url('https://images.unsplash.com/photo-1613977257363-707ba9348227?auto=format&fit=crop&q=80&w=2000');"></div>
                    <div class="hero-overlay"></div>
                    <div class="hero-content">
                        <span class="hero-subtitle">Commercial Excellence</span>
                        <h1 class="hero-title">Elevating<br>Business.</h1>
                        <p class="hero-desc">Strategic locations paired with state-of-the-art facilities. Secure your premium commercial space today.</p>
                        <a href="#portfolio" class="hero-btn">View Spaces</a>
                    </div>
                </div>

            </div>
            
            <!-- Swiper Controls -->
            <div class="swiper-button-next" style="color: #fff;"></div>
            <div class="swiper-button-prev" style="color: #fff;"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section-padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                    <div class="about-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&q=80&w=1000" alt="Sakn Architecture" class="about-image shadow-lg">
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1" data-aos="fade-left">
                    <span class="sub-heading">About Sakn</span>
                    <h2 class="main-heading mb-4 playfair">Crafting Legacies<br>in Real Estate.</h2>
                    <p class="text-muted mb-4" style="line-height: 1.8;">
                        At Sakn, we go beyond mere construction. As a premier private real estate developer, we specialize in curating ultra-luxury residential and high-end commercial properties.
                    </p>
                    <p class="text-muted mb-5" style="line-height: 1.8;">
                        Our philosophy is rooted in architectural perfection, sustainable innovation, and an unwavering commitment to quality. Every project we undertake is a testament to our dedication to creating spaces that inspire and endure.
                    </p>
                    <a href="#contact" class="btn-outline-gold">Know More</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5 bg-light-green border-top border-bottom border-light">
        <div class="container">
            <div class="row text-center" data-aos="fade-up">
                <div class="col-md-3 col-6 mb-4 mb-md-0 stat-item">
                    <h2 class="playfair">15+</h2>
                    <p>Years Experience</p>
                </div>
                <div class="col-md-3 col-6 mb-4 mb-md-0 stat-item">
                    <h2 class="playfair">40+</h2>
                    <p>Completed Projects</p>
                </div>
                <div class="col-md-3 col-6 stat-item">
                    <h2 class="playfair">12B</h2>
                    <p>Portfolio Value (SAR)</p>
                </div>
                <div class="col-md-3 col-6 stat-item">
                    <h2 class="playfair">100%</h2>
                    <p>Client Satisfaction</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="section-padding">
        <div class="container">
            <div class="section-header text-center" data-aos="fade-up">
                <span class="sub-heading">Featured Collection</span>
                <h2 class="main-heading playfair">Exclusive Properties</h2>
            </div>

            <div class="row g-4">
                @if(isset($properties) && $properties->count() > 0)
                    @foreach($properties->take(6) as $property)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                            <div class="property-card">
                                <div class="img-container">
                                    <span class="status-badge">{{ $property->status ?? 'Available' }}</span>
                                    @if($property->images && $property->images->where('is_main', true)->first())
                                        <img src="{{ asset('storage/' . $property->images->where('is_main', true)->first()->url) }}" alt="{{ $property->title }}">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1613977257363-707ba9348227?auto=format&fit=crop&q=80&w=800" alt="Sakn Property">
                                    @endif
                                </div>
                                <div class="card-content">
                                    <span class="prop-price">${{ number_format($property->price ?? 0) }}</span>
                                    <h3 class="prop-title playfair">{{ $property->title ?? 'Luxury Property' }}</h3>
                                    <div class="prop-location">
                                        <i class="bi bi-geo-alt-fill me-1" style="color: var(--sakn-gold);"></i> 
                                        {{ $property->city ?? 'Riyadh' }}, {{ $property->district ?? 'Al Olaya' }}
                                    </div>
                                    <div class="prop-features">
                                        <div class="feature"><i class="bi bi-arrows-fullscreen"></i> 450 m²</div>
                                        <div class="feature"><i class="bi bi-door-open"></i> 5 Beds</div>
                                        <div class="feature"><i class="bi bi-droplet"></i> 6 Baths</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Fallback Data if DB is empty -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="property-card">
                            <div class="img-container">
                                <span class="status-badge">Available</span>
                                <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&q=80&w=800" alt="Villa">
                            </div>
                            <div class="card-content">
                                <span class="prop-price">$2,500,000</span>
                                <h3 class="prop-title playfair">The Royal Villa</h3>
                                <div class="prop-location"><i class="bi bi-geo-alt-fill me-1" style="color: var(--sakn-gold);"></i> Riyadh, Al Khuzama</div>
                                <div class="prop-features">
                                    <div class="feature"><i class="bi bi-arrows-fullscreen"></i> 600 m²</div>
                                    <div class="feature"><i class="bi bi-door-open"></i> 6 Beds</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="property-card">
                            <div class="img-container">
                                <span class="status-badge">Reserved</span>
                                <img src="https://images.unsplash.com/photo-1613977257363-707ba9348227?auto=format&fit=crop&q=80&w=800" alt="Penthouse">
                            </div>
                            <div class="card-content">
                                <span class="prop-price">$1,850,000</span>
                                <h3 class="prop-title playfair">Sky Penthouse</h3>
                                <div class="prop-location"><i class="bi bi-geo-alt-fill me-1" style="color: var(--sakn-gold);"></i> Jeddah, Al Shati</div>
                                <div class="prop-features">
                                    <div class="feature"><i class="bi bi-arrows-fullscreen"></i> 350 m²</div>
                                    <div class="feature"><i class="bi bi-door-open"></i> 4 Beds</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="property-card">
                            <div class="img-container">
                                <span class="status-badge">Available</span>
                                <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&q=80&w=800" alt="Mansion">
                            </div>
                            <div class="card-content">
                                <span class="prop-price">$4,200,000</span>
                                <h3 class="prop-title playfair">Oasis Mansion</h3>
                                <div class="prop-location"><i class="bi bi-geo-alt-fill me-1" style="color: var(--sakn-gold);"></i> Riyadh, Hittin</div>
                                <div class="prop-features">
                                    <div class="feature"><i class="bi bi-arrows-fullscreen"></i> 1200 m²</div>
                                    <div class="feature"><i class="bi bi-door-open"></i> 8 Beds</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            
            <div class="text-center mt-5" data-aos="fade-up">
                <a href="#" class="btn-outline-gold">View Full Portfolio</a>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="section-padding bg-light-green">
        <div class="container">
            <div class="section-header text-center" data-aos="fade-up">
                <span class="sub-heading">Our Expertise</span>
                <h2 class="main-heading playfair">What We Do</h2>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-box text-center">
                        <i class="bi bi-buildings service-icon"></i>
                        <h4 class="playfair mb-3">Property Development</h4>
                        <p class="text-muted">From concept to reality, we develop high-end residential and commercial landmarks.</p>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-box text-center">
                        <i class="bi bi-house-check service-icon"></i>
                        <h4 class="playfair mb-3">Asset Management</h4>
                        <p class="text-muted">Comprehensive management services ensuring your investment yields maximum returns.</p>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-box text-center">
                        <i class="bi bi-graph-up-arrow service-icon"></i>
                        <h4 class="playfair mb-3">Investment Advisory</h4>
                        <p class="text-muted">Expert consultation for high-net-worth individuals seeking prime real estate opportunities.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact CTA -->
    <section id="contact" class="section-padding" style="background: url('https://images.unsplash.com/photo-1600607686527-6fb886090705?auto=format&fit=crop&q=80&w=2000') center/cover fixed;">
        <div style="background: rgba(26, 54, 38, 0.9); padding: 100px 0;">
            <div class="container text-center" data-aos="zoom-in">
                <h2 class="playfair text-white mb-4" style="font-size: 3rem;">Ready to elevate your lifestyle?</h2>
                <p class="text-white mb-5 opacity-75" style="max-width: 600px; margin: 0 auto; font-size: 1.1rem;">
                    Schedule a private viewing or consultation with our expert advisory team today.
                </p>
                <a href="mailto:contact@sakn.app" class="hero-btn" style="opacity:1; transform:none;">Contact Us Now</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h3 class="mb-4 text-white playfair" style="font-size: 2rem; letter-spacing: 2px;">SAKN.</h3>
                    <p class="footer-text pe-lg-4">
                        Sakn is synonymous with luxury. We are dedicated to creating exclusive environments that redefine the standards of upscale living and premium business spaces.
                    </p>
                </div>
                <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                    <h4 class="footer-title">Company</h4>
                    <ul class="footer-links">
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#portfolio">Portfolio</a></li>
                        <li><a href="#services">Expertise</a></li>
                        <li><a href="#">Careers</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4 mb-4 mb-md-0">
                    <h4 class="footer-title">Contact</h4>
                    <ul class="footer-links">
                        <li><i class="bi bi-geo-alt me-2 text-gold" style="color: var(--sakn-gold);"></i> King Fahd Road, Riyadh</li>
                        <li><i class="bi bi-envelope me-2 text-gold" style="color: var(--sakn-gold);"></i> info@sakn.com</li>
                        <li><i class="bi bi-telephone me-2 text-gold" style="color: var(--sakn-gold);"></i> +966 9200 12345</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h4 class="footer-title">Newsletter</h4>
                    <p class="footer-text mb-3">Subscribe for exclusive updates on our latest developments.</p>
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Email Address" style="border-radius: 0; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: #fff;">
                        <button class="btn" type="button" style="background: var(--sakn-gold); color: #fff; border-radius: 0;">Send</button>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="mb-0">&copy; {{ date('Y') }} Sakn Development Company. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // Initialize AOS Animation
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100,
        });

        // Initialize Swiper
        const heroSwiper = new Swiper('.heroSwiper', {
            loop: true,
            effect: 'fade',
            speed: 1500,
            autoplay: {
                delay: 6000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });

        // Navbar Scroll Effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>
