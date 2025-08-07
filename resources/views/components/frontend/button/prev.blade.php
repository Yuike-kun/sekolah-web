<a wire:loading.attr='disabled' href="#top-step" id="btn-step-prev" wire:click='{{ $target ?? 'decreaseStep' }}'
    class="btn btn-step-prev">
    <span wire:loading.remove wire:target="{{ $target }}"><i class="fa-solid fa-arrow-left"></i>
        {{ $name ?? 'Sebelumnya' }}</span>

    <span wire:loading wire:target="{{ $target }}">Memuat Data</span>

    <span class="animated-dots" wire:loading wire:target="{{ $target }}"></span>
</a>
