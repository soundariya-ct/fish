<nav aria-label="Page navigation example">
    @if ($paginator->hasPages())
    <ul class="pagination">

        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo; Prev</span>
                </a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo; Prev</span>
                </a>
            </li>
        @endif


        @foreach ($elements as $element)

        @if (is_string($element))
            <li class="page-item disabled">{{ $element }}</li>
        @endif

        @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><a class="page-link" href="#">{{ $page }}</a></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url  }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach


        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                    <span aria-hidden="true">Next &raquo;</span>
                </a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="#" rel="next">
                    <span aria-hidden="true">Next &raquo;</span>
                </a>
            </li>
        @endif

    </ul>
    @endif
</nav>
