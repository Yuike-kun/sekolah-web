<a wire:loading.attr='disabled' href="#top-step" id="btn-step-next" wire:click='{{ $target ?? 'increaseStep' }}'
    class="btn btn-step-next">
    <span wire:loading.remove wire:target="{{ $target }}">
        {{ $name ?? 'Berikutnya ' }} <i class="fa-solid fa-arrow-right"></i></span>

    <span wire:loading wire:target="{{ $target }}">Memuat Data</span>

    <span class="animated-dots" wire:loading wire:target="{{ $target }}"></span>
</a>
