<div wire:ignore class="{{ $formGroup ?? 'mb-3' }}">
    @isset($label)
        <label class="form-label {{ isset($required) ? 'required' : '' }}"
            for="{{ $name }}">{{ $label }}</label>
    @endisset

    <div class="input-group mb-3">
        @isset($icon)
            <span class="input-group-text" id="basic-addon1">{{ $icon }}</span>
        @endisset

        <textarea {{ $attributes }} name="{{ $name }}" class="form-control @error($name) is-invalid @enderror"
            cols="30" placeholder="{{ isset($placeholder) ? $placeholder : '' }}">
          {{ $slot }}
        </textarea>

        @error($name)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>
</div>
