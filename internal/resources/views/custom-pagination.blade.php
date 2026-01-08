@php
    if (! isset($scrollTo)) {
        $scrollTo = 'body';
    }

    $scrollIntoViewJsSnippet = ($scrollTo !== false)
        ? <<<JS
           (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView({behavior: "smooth"});
        JS
        : '';
@endphp

@if ($paginator->hasPages())
    <div class="d-flex justify-content-between align-items-center mb-2">
        <small class="text-muted">
            Menampilkan <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
            -
            <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
            dari
            <span class="fw-semibold">{{ $paginator->total() }}</span> data
        </small>
    </div>

    <nav>
        <ul class="pagination justify-content-center">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
            @else
                <li class="page-item">
                    <button type="button"
                        class="page-link"
                        wire:click="previousPage('{{ $paginator->getPageName() }}')"
                        x-on:click="{{ $scrollIntoViewJsSnippet }}"
                        wire:loading.attr="disabled">&laquo;</button>
                </li>
            @endif

            {{-- Page Numbers (max 3) --}}
            @php
                $current = $paginator->currentPage();
                $last    = $paginator->lastPage();

                $start = max(1, $current - 1);
                $end   = min($last, $current + 1);

                while (($end - $start + 1) < 3 && $start > 1) $start--;
                while (($end - $start + 1) < 3 && $end < $last) $end++;
            @endphp

            @foreach (range($start, $end) as $page)
                @if ($page == $current)
                    <li class="page-item active" aria-current="page">
                        <span class="page-link">{{ $page }}</span>
                    </li>
                @else
                    <li class="page-item">
                        <button type="button"
                            class="page-link"
                            wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                            x-on:click="{{ $scrollIntoViewJsSnippet }}">
                            {{ $page }}
                        </button>
                    </li>
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <button type="button"
                        class="page-link"
                        wire:click="nextPage('{{ $paginator->getPageName() }}')"
                        x-on:click="{{ $scrollIntoViewJsSnippet }}"
                        wire:loading.attr="disabled">&raquo;</button>
                </li>
            @else
                <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
            @endif

        </ul>
    </nav>
@endif
