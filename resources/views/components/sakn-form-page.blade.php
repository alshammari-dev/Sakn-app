@props([
    'title',
    'subtitle' => '',
    'backRoute' => null,
    'submitLabel' => 'Save Changes',
    'action',
    'method' => 'POST',
    'enctype' => null
])

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card sakn-card shadow-lg">
                {{-- Header --}}
                <div class="sakn-header d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0 fw-bold">{{ $title }}</h3>
                        @if($subtitle)
                            <small style="color: #C8A96A;">{{ $subtitle }}</small>
                        @endif
                    </div>
                    @if($backRoute)
                        <a href="{{ $backRoute }}" class="btn btn-sm btn-outline-light border-0 opacity-75 hover-opacity-100">
                            <i class="bi bi-arrow-left me-1"></i> Back to List
                        </a>
                    @endif
                </div>

                <div class="card-body p-4 p-md-5">
                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm mb-4">
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ $action }}" method="POST" @if($enctype) enctype="{{ $enctype }}" @endif>
                        @csrf
                        @if(strtoupper($method) !== 'POST')
                            @method($method)
                        @endif

                        {{-- Form Content --}}
                        <div class="row g-4">
                            {{ $slot }}
                        </div>

                        {{-- Footer Actions --}}
                        <div class="mt-5 pt-4 border-top d-flex justify-content-end gap-3">
                            @if($backRoute)
                                <a href="{{ $backRoute }}" class="btn btn-light px-4 py-2 fw-bold text-muted">Cancel</a>
                            @endif
                            <button type="submit" class="btn sakn-btn-gold px-5 py-2">
                                <i class="bi bi-check2-circle me-2"></i> {{ $submitLabel }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-opacity-100:hover { opacity: 1 !important; }
    .form-label { 
        color: var(--sakn-primary); 
        font-weight: 700; 
        font-size: 0.85rem; 
        text-transform: uppercase; 
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }
    .form-control, .form-select {
        border: 1px solid #eef0f2;
        padding: 0.75rem 1rem;
        border-radius: 10px;
        background-color: #fcfcfc;
        transition: all 0.2s;
    }
    .form-control:focus, .form-select:focus {
        background-color: #fff;
        border-color: var(--sakn-gold);
        box-shadow: 0 0 0 4px rgba(200, 169, 106, 0.1);
        outline: none;
    }
</style>
