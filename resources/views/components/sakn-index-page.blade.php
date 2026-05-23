@props([
    'title',
    'subtitle' => '',
    'createRoute' => null,
    'createLabel' => 'Add New',
    'hasFilters' => false,
    'backRoute' => null,
    'backLabel' => 'Back'
])

<div class="container my-5">
    <div class="card sakn-card shadow-lg">
        {{-- Header Section --}}
        <div class="sakn-header d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="d-flex align-items-center">
                @if($backRoute)
                    <a href="{{ $backRoute }}" class="btn btn-outline-light me-3 px-3 py-2 border-2" style="border-radius: 8px;">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                @endif
                <div>
                    <h3 class="mb-0 fw-bold">{{ $title }}</h3>
                    @if($subtitle)
                        <small style="color: #C8A96A;">{{ $subtitle }}</small>
                    @endif
                </div>
            </div>
            
            @if($createRoute)
                <a href="{{ $createRoute }}" class="btn sakn-btn-gold shadow-sm px-4">
                    <i class="bi bi-plus-lg me-2"></i> {{ $createLabel }}
                </a>
            @endif
        </div>

        <div class="card-body p-0">
            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="alert alert-success border-0 m-3 shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger border-0 m-3 shadow-sm" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                </div>
            @endif

            {{-- Optional Filters Slot --}}
            @if($hasFilters)
                <div class="p-3 border-bottom bg-light">
                    {{ $filters }}
                </div>
            @endif

            {{-- Table Content Slot --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    {{ $slot }}
                </table>
            </div>

            {{-- Pagination Slot --}}
            @if(isset($pagination))
                <div class="p-4 bg-light border-top">
                    {{ $pagination }}
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .sakn-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        background: #fff;
    }
    .sakn-header {
        padding: 1.5rem 2rem;
        background: linear-gradient(135deg, #2F4F3E 0%, #1a2e24 100%);
        color: #fff;
    }
    .sakn-header h3 {
        color: #fff;
        letter-spacing: 0.5px;
    }
    .sakn-btn-gold {
        background-color: #C8A96A;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .sakn-btn-gold:hover {
        background-color: #b4975e;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(200, 169, 106, 0.4);
    }
    .sakn-btn-outline {
        border: 1px solid #e0d8c3;
        color: #2F4F3E;
        background: #fff;
        transition: all 0.2s;
    }
    .sakn-btn-outline:hover {
        background: #F5F2EC;
        color: #C8A96A;
        border-color: #C8A96A;
    }
    .table thead th {
        background-color: #F5F2EC;
        color: #2F4F3E;
        text-transform: uppercase;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 1px;
        padding: 1rem;
        border-bottom: 2px solid #e0d8c3;
    }
    /* Brand Utility Classes */
    .text-sakn { color: #2F4F3E !important; }
    .text-sakn-dark { color: #1a2e24 !important; }
    .text-gold { color: #C8A96A !important; }
    .border-sakn { border-color: #2F4F3E !important; }
    .border-sakn-dark { border-color: #1a2e24 !important; }
    .border-gold { border-color: #C8A96A !important; }
    .bg-sakn-light { background-color: #F5F2EC !important; }
</style>
