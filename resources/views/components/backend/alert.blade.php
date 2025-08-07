<div>
    <div style="left:0;right:0" class="fixed-top top-0 d-flex justify-content-center mt-4">
        <span class="px-3 py-2 border rounded-2 bg-loading shadow" id="loading-indicator" wire:loading.delay>
            Memuat<span class="animated-dots"></span>
        </span>

        <span class="px-3 py-2 border rounded-2 bg-offline shadow" id="loading-indicator" wire:offline>
            <i class="fa fa-plane me-2"></i> Anda sedang offline.
        </span>
    </div>

    @if (session('alert'))
        <div class="alert border-0 bg-light-{{ session('alert.type') }} alert-dismissible fade show py-2">
            <div class="d-flex align-items-center">
                @if (session('alert.type') == 'danger')
                    <div class="fs-3 text-{{ session('alert.type') }}"><i class="bi bi bi-x-circle-fill"></i></div>
                @else
                    <div class="fs-3 text-{{ session('alert.type') }}"><i class="bi bi bi-check-circle-fill"></i></div>
                @endif
                <div class="ms-3">
                    <div class="text-{{ session('alert.type') }}">
                        <b>{{ session('alert.message') }} </b>{{ session('alert.detail') }}
                    </div>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>
