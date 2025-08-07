<button wire:click='{{ $click ?? null }}' wire:loading.attr='disabled' type="submit"
    class="btn ms-auto {{ $class ?? 'btn-success' }}">
    <span wire:loading.remove wire:target="{{ $target }}">{{ $name ?? 'Simpan' }}</span>

    <span wire:loading wire:target="{{ $target }}">Memuat</span>

    <span class="animated-dots" wire:loading wire:target="{{ $target }}"></span>
</button>
