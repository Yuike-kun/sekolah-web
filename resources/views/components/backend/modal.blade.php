<div class="{{ $formGroup ?? 'mb-3' }}">
    <div class="col">
        <div wire:ignore.self class="modal fade " id="example-{{ $target ?? 'primary' }}-modal" tabindex="-1"
            aria-hidden="true" style="display: none;">
            <div class="modal-dialog {{ $modeModal ?? '' }} modal-dialog-centered">
                <div class="modal-content bg-white">
                    <div class="my-3">
                        <button wire:click='closeModal' type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-dark">
                        <div class="card-body">
                            {{ $description ?? $slot }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
