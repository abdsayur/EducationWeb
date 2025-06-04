@if ($paginator->hasPages())
<div class="blog-pagi">
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="page-item disabled">
            <span class="page-link"><i class="bx bx-arrow-back"></i></span>
        </li>
        @else
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
                <span aria-hidden="true"><i class="bx bx-arrow-back"></i></span>
            </a>
        </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        {{-- "..." separator --}}
        @if (is_string($element))
        <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
        @endif

        {{-- Page Number Links --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="page-item active">
            <a class="page-link active" href="{{ $url }}">{{ $page }}</a>
        </li>
        @else
        <li class="page-item">
            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
        </li>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                <span aria-hidden="true"><i class="bx bx-arrow-back bx-rotate-180"></i></span>
            </a>
        </li>
        @else
        <li class="page-item disabled">
            <span class="page-link"><i class="bx bx-arrow-back bx-rotate-180"></i></span>
        </li>
        @endif
    </ul>
</div>
@endif
