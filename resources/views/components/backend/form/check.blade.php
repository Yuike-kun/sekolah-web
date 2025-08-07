<label class="form-check fw-normal @isset($inline) form-check-inline @endisset">
    <input
        class="form-check-input @error($name) is-invalid @enderror"
        id="{{ $name }}"
        type="{{ $type ?? 'checkbox'}}"
        name="{{ $name }}"
        value="{{ $value ?? '' }}"
        {{ $attributes }}
    >

    <span class="form-check-label">{{ $title }}</span>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</label>
