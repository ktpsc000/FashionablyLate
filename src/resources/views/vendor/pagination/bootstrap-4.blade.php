{{-- resources/views/vendor/pagination/bootstrap-5.blade.php --}}
@if ($paginator->hasPages())
    <nav class="pagination">
        <ul class="pagination__list">

            {{-- 前へ --}}
            @if ($paginator->onFirstPage())
                <li class="pagination__item disabled">&lt;</li>
            @else
                <li class="pagination__item">
                    <a href="{{ $paginator->previousPageUrl() }}">&lt;</a>
                </li>
            @endif

            {{-- ページ番号 --}}
            @foreach ($elements as $element)
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pagination__item active">{{ $page }}</li>
                        @else
                            <li class="pagination__item">
                                <a href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- 次へ --}}
            @if ($paginator->hasMorePages())
                <li class="pagination__item">
                    <a href="{{ $paginator->nextPageUrl() }}">&gt;</a>
                </li>
            @else
                <li class="pagination__item disabled">&gt;</li>
            @endif

        </ul>
    </nav>
@endif
