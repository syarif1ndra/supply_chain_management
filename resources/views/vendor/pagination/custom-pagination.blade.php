<!-- resources/views/vendor/pagination/bootstrap-5.blade.php -->
<div class="d-flex justify-content-center my-4">
    <ul class="pagination shadow-sm rounded-lg">
        <!-- Previous Page Link -->
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link bg-light text-muted border-0 px-3 py-2 rounded-start" aria-hidden="true">‹</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link bg-white text-primary border-0 px-3 py-2 rounded-start shadow-sm hover:bg-light" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous">‹</a>
            </li>
        @endif

        <!-- Pagination Elements -->
        @foreach ($elements as $element)
            <!-- "Three Dots" Separator -->
            @if (is_string($element))
                <li class="page-item disabled">
                    <span class="page-link bg-light text-muted border-0">{{ $element }}</span>
                </li>
            @endif

            <!-- Array Of Links -->
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <span class="page-link bg-primary text-white border-0 px-3 py-2 shadow-sm">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link bg-white text-primary border-0 px-3 py-2 shadow-sm hover:bg-light" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        <!-- Next Page Link -->
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link bg-white text-primary border-0 px-3 py-2 rounded-end shadow-sm hover:bg-light" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next">›</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link bg-light text-muted border-0 px-3 py-2 rounded-end" aria-hidden="true">›</span>
            </li>
        @endif
    </ul>
</div>
