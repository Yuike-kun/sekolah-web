<div class="row justify-content-center mt-3" wire:loading.class.delay="card-loading" wire:offline.class="card-loading">
    <div class="col-lg-10 col-12">
        <div class="card mb-5">
            {{ $slot }}
        </div>
    </div>
</div>
