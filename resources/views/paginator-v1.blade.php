@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <button class="button px-2 mr-1 mb-2 bg-theme-1 text-white" aria-hidden="true"> 
                        <span class="w-5 h-5 flex items-center justify-center"> 
                            <i data-feather="skip-back" class="w-4 h-4"></i> 
                        </span> 
                    </button>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"> 
                        <button class="button px-2 mr-1 mb-2 bg-theme-1 text-white" aria-hidden="true"> 
                            <span class="w-5 h-5 flex items-center justify-center"> 
                                <i data-feather="skip-back" class="w-4 h-4"></i> 
                            </span> 
                        </button>
                     </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true">
                        <button class="button px-2 mr-1 mb-2 bg-theme-1 text-white" aria-hidden="true"> 
                            <span class="w-5 h-5 flex items-center justify-center"> 
                                {{ $element }} 
                            </span> 
                        </button>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page">
                                <button class="button px-2 mr-1 mb-2 bg-theme-1 text-white"> 
                                    <span class="w-5 h-5 flex items-center justify-center"> 
                                        {{ $page }} 
                                    </span> 
                                </button>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}">
                                    <button class="button px-2 mr-1 mb-2 bg-theme-1 text-white"> 
                                        <span class="w-5 h-5 flex items-center justify-center"> 
                                            {{ $page }} 
                                        </span> 
                                    </button>
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">  
                        <button class="button px-2 mr-1 mb-2 bg-theme-1 text-white" aria-hidden="true"> 
                            <span class="w-5 h-5 flex items-center justify-center"> 
                                <i data-feather="skip-forward" class="w-4 h-4"></i> 
                            </span> 
                        </button>
                    </a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <button class="button px-2 mr-1 mb-2 bg-theme-1 text-white" aria-hidden="true"> 
                        <span class="w-5 h-5 flex items-center justify-center"> 
                            <i data-feather="skip-forward" class="w-4 h-4"></i> 
                        </span> 
                    </button>
                </li>
            @endif
        </ul>
    </nav>
@endif
