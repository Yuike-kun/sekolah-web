@props([
    'name' => null,
    'sortable' => null,
    'direction' => null,
    'multiColumn' => null,
])

<div class="cursor-pointer d-flex justify-content-between" {{ $attributes }} style="user-select:none">
    <div>{{ $name }}</div>

    <div id="sort-icon">
        @if ($multiColumn)
            @if ($direction === 'asc')
                <i class="icon-up fa fa-solid fa-arrow-up pb-1 sm"></i>
            @elseif ($direction === 'desc')
                <i class="icon-down fa fa-solid fa-arrow-down sm"></i>
            @else
                <i class="fa fa-solid fa-arrows-alt-v sm"></i>
            @endif
        @else
            @if ($direction === 'asc')
                <i class="icon-up fa fa-solid fa-arrow-up pb-1 sm"></i>
            @elseif ($direction === 'desc')
                <i class="icon-down fa fa-solid fa-arrow-down sm"></i>
            @else
                <i class="fa fa-solid fa-arrows-alt-v sm"></i>
            @endif
        @endif
    </div>
</div>
