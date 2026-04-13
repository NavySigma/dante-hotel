@if ($paginator->hasPages())
    <div class="inline-flex items-center gap-1 border border-gray-200 px-3 py-2 rounded-full shadow-sm bg-white">

        {{-- First Page --}}
        <a href="{{ $paginator->url(1) }}" class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded text-sm">&lt;&lt;</a>

        {{-- Previous --}}
        <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded text-sm">&lt;</a>

        {{-- Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-2 text-gray-400 text-sm">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-1 bg-gray-900 text-white rounded text-sm font-medium">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded text-sm">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded text-sm">&gt;</a>

        {{-- Last --}}
        <a href="{{ $paginator->url($paginator->lastPage()) }}" class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded text-sm">&gt;&gt;</a>

    </div>
@endif
