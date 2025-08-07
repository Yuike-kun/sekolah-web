<a href="{{ route($route) }}" class="btn {{ isset($color) ? $color : 'btn-primary' }} d-none d-sm-inline-block">
    @isset($icon)
        <i class="fa-solid fa-{{ $icon }} me-1"></i>
    @endisset
    {{ $name ?? 'Tambah' }}
</a>
