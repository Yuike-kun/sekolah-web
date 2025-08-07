<div class="{{ $formGroup ?? 'mb-3' }}">
    @isset($label)
        <label class="form-label {{ isset($required) ? 'required' : '' }}"
            for="{{ $name }}">{{ $label }}</label>
    @endisset

    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="{{ $name }}" checked="{{ $checked ?? '' }}">
        <span class="form-check-label" for="{{ $name }}">{{ $description ?? '' }}</span>
        @error($name)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>

</div>
