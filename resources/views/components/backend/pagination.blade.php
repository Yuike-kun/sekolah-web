<nav aria-label="Page navigation">
    <ul class="pagination {{ $pagination ?? '' }} round-pagination">
        <li class="page-item"><a class="page-link" href="javascript:;">Previous</a></li>
        @foreach ($pages as $page)
            <li class="page-item {{ $page['isActive'] }}"><a class="page-link"
                    href="{{ $page['url'] }}">{{ $page['label'] }}</a></li>
        @endforeach
        <li class="page-item"><a class="page-link" href="javascript:;">Next</a></li>
    </ul>
</nav>
