<button wire:loading.attr='disabled' id="btn-step-submit" type="submit" wire:click='save' class="btn btn-step-submit">
    <span wire:loading.remove wire:target="{{ $target }}">{{ $name ?? 'Simpan' }}</span>

    <span wire:loading wire:target="{{ $target }}">Memuat</span>

    <span class="animated-dots" wire:loading wire:target="{{ $target }}"></span>
</button>
