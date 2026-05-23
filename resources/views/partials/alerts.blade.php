@if(session('success'))
    <div class="alert m-3 alert-dismissible fade show" style="background-color: #f0f4f2; border-left: 5px solid #2F4F3E; color: #2F4F3E;" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> 
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert m-3 alert-dismissible fade show" style="background-color: #fdf2f2; border-left: 5px solid #b91c1c; color: #b91c1c;" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i> 
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


@if ($errors->any())
    <div class="alert m-3 alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
