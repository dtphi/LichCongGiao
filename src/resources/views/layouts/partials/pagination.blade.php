@if ($paginator->hasPages())
    <ul class="pagination d-fex justify-content-center">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link">
                    <span aria-hidden="true">&laquo;</span></a>
            </li>
            <li class="page-item disabled">
                <a class="page-link">
                    <span aria-hidden="true">&lt;</span></a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url(1) }}">
                    <span aria-hidden="true">&laquo;</span></a>
            </li>
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}">
                    <span aria-hidden="true">&lt;</span></a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                    <span aria-hidden="true">&gt;</span></a>
            </li>
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">
                    <span aria-hidden="true">&raquo;</span></a>
            </li>
        @else
            <li class="page-item disabled">
                <a class="page-link">
                    <span aria-hidden="true">&gt;</span></a>
            </li>
            <li class="page-item disabled">
                <a class="page-link">
                    <span aria-hidden="true">&raquo;</span></a>
            </li>
        @endif
    </ul>
@endif
