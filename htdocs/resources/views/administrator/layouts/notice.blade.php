@if(session()->has('success'))
    <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-1"></i>
        <div>
        {{ session('success') }}
        </div>
    </div>
@endif

@if (session()->has('info'))
    <div class="alert alert-primary d-flex align-items-center alert-dismissible fade show" role="alert">
        <i class="bi bi-info-circle-fill me-1"></i>
        <div>
            {{ session('info') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif