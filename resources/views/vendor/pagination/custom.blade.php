@if ($paginator->hasPages())
    <div class="theme-pagination text-center">
        <ul>
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true">
                    <a href="javascript:void(0)"><i class="fa-solid fa-angle-left"></i></a>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fa-solid fa-angle-left"></i></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><a class="active" href="javascript:void(0)">{{ sprintf('%02d', $page) }}</a></li>
                        @else
                            <li><a href="{{ $url }}">{{ sprintf('%02d', $page) }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa-solid fa-angle-right"></i></a>
                </li>
            @else
                <li class="disabled" aria-disabled="true">
                    <a href="javascript:void(0)"><i class="fa-solid fa-angle-right"></i></a>
                </li>
            @endif
        </ul>
    </div>
@endif