@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-end mt-4">
        <div class="flex items-center space-x-2 text-sm">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="text-gray-400">&larr;</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="text-black hover:underline">&larr;</a>
            @endif

            {{-- Current and Last Page Number --}}
            <span class="text-black">
                {{ $paginator->currentPage() }} - {{ $paginator->lastPage() }}
            </span>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="text-black hover:underline">&rarr;</a>
            @else
                <span class="text-gray-400">&rarr;</span>
            @endif
        </div>
    </nav>
@endif