<div class="{{ $formGroup ?? 'mb-3' }}">

    @isset($label)
        <label class="form-label  {{ isset($required) ? 'required' : '' }}"
            for="{{ $name }}">{{ $label }}</label>
    @endisset

    <div class="input-group mb-3">
        @isset($icon)
            <span class="input-group-text" id="basic-addon1">{{ $icon }}</span>
        @endisset

        <select
            class="form-select {{ $fromControl ?? '' }} @error($name) is-invalid @enderror"
            name="{{ $name }}"
            id="{{ $name }}"
            {{ $attributes }}
            >
            {{ $slot }}
        </select>

        @error($name)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

</div>
