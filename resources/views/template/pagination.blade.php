<?php
    $start = 1;
    $end   = $paginator->lastPage();
    $page  = $paginator->currentPage();

    if ($end > 5) {
        if ($page == 2) {
            $end = $page + 3;
        } elseif ($page == 1) {
            $end = $page + 4;
        } elseif ($page == $end - 1) {
            $start = $page - 3;
        } elseif ($page == $end) {
            $start = $page - 4;
        } else {
            $start = $page - 2;
            $end = $page + 2;
        }
    }
?>
@if ($paginator->hasPages())
    <div class="text-center mt-30">
        <nav>
            <ul class="pagination">
                @if (!($paginator->onFirstPage()))
                    <li>
                        <a href="/">&laquo;</a>
                    </li>
                    <li>
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" 
                        aria-label="@lang('pagination.previous')">&lsaquo;</a>
                    </li>
                @endif
                
                @foreach ($elements as $element)
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if (!($page < $start || $page > $end))
                                @if ($page == $paginator->currentPage())
                                    <li class="active" aria-current="page"><span>
                                    {{ $page }}</span></li>
                                @else
                                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <li>
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" 
                        aria-label="@lang('pagination.next')">&rsaquo;</a>
                    </li>
                    <li>
                        <a href="{{ $paginator->url($paginator->lastPage()) }}">&raquo;</a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif