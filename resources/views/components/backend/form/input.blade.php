<div class="{{ $formGroup ?? 'mb-3' }}">
    @isset($label)
        <label class="form-label {{ isset($required) ? 'required' : '' }}"
            for="{{ $name }}">{{ $label }}</label>
    @endisset


    <div class="input-group relative">

        @isset($icon)
            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-{{ $icon }}"></i></span>
        @endisset

        @isset($brand)
            <span class="input-group-text" id="basic-addon1"><i class="fa-brands fa-{{ $brand }}"></i></span>
        @endisset

        <input class="form-control @error($name)is-invalid @enderror" id={{ $name }} name="{{ $name }}"
            type="{{ $type ?? 'text' }}" placeholder="{{ $placeholder ?? '' }}" {{ $attributes }}>

        @error($name)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    @isset($confirm)
        <div class="d-inline absolute my-0 py-0">
            <small class=" small">{{ $confirm }}</small>
        </div>
    @endisset
</div>
