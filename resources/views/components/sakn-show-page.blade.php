@props([
    'title',
    'subtitle' => '',
    'backRoute' => null,
    'backLabel' => 'Back',
])

<div class="container my-5">
    <div class="card sakn-card shadow-lg border-0" style="border-radius: 15px; overflow: hidden;">
        {{-- Header Section --}}
        <div class="sakn-header p-4 d-flex justify-content-between align-items-center flex-wrap gap-3" style="background: linear-gradient(135deg, #2F4F3E 0%, #1a2e24 100%); color: white;">
            <div>
                <h3 class="mb-0 fw-bold text-white">{{ $title }}</h3>
                @if($subtitle)
                    <small style="color: #C8A96A;" class="fw-medium text-uppercase ls-1">{{ $subtitle }}</small>
                @endif
            </div>
            
            @if($backRoute)
                <a href="{{ $backRoute }}" class="btn btn-outline-light px-4 border-2 fw-semibold" style="border-radius: 8px; transition: all 0.3s ease;">
                    <i class="bi bi-arrow-left me-2"></i> {{ $backLabel }}
                </a>
            @endif
        </div>

        <div class="card-body p-4 bg-white">
            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm d-flex align-items-center" role="alert" style="background-color: #d1e7dd; color: #0f5132;">
                    <i class="bi bi-check-circle-fill me-3 fs-5"></i> 
                    <div>{{ session('success') }}</div>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger border-0 shadow-sm d-flex align-items-center" role="alert" style="background-color: #f8d7da; color: #842029;">
                    <i class="bi bi-exclamation-triangle-fill me-3 fs-5"></i> 
                    <div>{{ session('error') }}</div>
                </div>
            @endif

            {{-- Main Content --}}
            <div class="sakn-content mt-2">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>

<style>
    .ls-1 { letter-spacing: 1px; }
    .sakn-card {
        transition: transform 0.3s ease;
    }
    .sakn-info-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        font-weight: 700;
        color: #C8A96A;
        margin-bottom: 0.25rem;
        display: block;
        letter-spacing: 0.5px;
    }
    .sakn-info-value {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2F4F3E;
        display: block;
    }
    .sakn-section-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #2F4F3E;
        border-bottom: 2px solid #F5F2EC;
        padding-bottom: 10px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }
    .sakn-section-title i {
        color: #C8A96A;
        margin-right: 12px;
    }
    .property-gallery-img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .property-thumb {
        width: 100%;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    .property-thumb:hover, .property-thumb.active {
        border-color: #C8A96A;
        transform: translateY(-3px);
    }
</style>
