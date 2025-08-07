<div wire:ignore id="{{ $target ?? 'filter' }}" class="accordion-collapse collapse filter-advence"
    data-bs-parent="#accordionExample">
    <div class="accordion-body">
        {{ $slot }}
    </div>
    <div class="d-flex">
        <button type="button" wire:click='resetFilter' wire:loading.attr='disabled'
            class="btn btn-sm btn-reset-filter btn-white ms-auto">Reset
            Filter</button>
    </div>
</div>
