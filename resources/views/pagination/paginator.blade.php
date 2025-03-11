@if ($paginator->hasPages())
    <div aria-label="Page navigation" class="flex items-center justify-between mt-4">
        <span class="text-md text-light-text-secondary dark:text-dark-text-tertiary transition-all ease-in-out">
            Showing
            <span
                class="font-semibold text-light-text-primary dark:text-dark-text-primary">{{ $paginator->firstItem() }}</span>
            -
            <span
                class="font-semibold text-light-text-primary dark:text-dark-text-primary">{{ $paginator->lastItem() }}</span>
            of
            <span
                class="font-semibold text-light-text-primary dark:text-dark-text-primary">{{ $paginator->total() }}</span>
            Entries
        </span>
        <ul class="inline-flex -space-x-px text-sm">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span
                        class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-light-text-tertiary bg-light-bg-secondary border border-e-0 border-light-primary-variant rounded-s-lg dark:bg-dark-bg-secondary dark:border-dark-primary-variant dark:text-dark-text-tertiary cursor-not-allowed transition-all ease-in-out">
                        Previous
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                        class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-light-text-primary bg-light-btn-secondary border border-e-0 border-light-primary-variant rounded-s-lg hover:bg-light-primary hover:text-white dark:bg-dark-bg-tertiary dark:border-dark-primary-variant dark:text-dark-text-secondary dark:hover:bg-dark-primary dark:hover:text-dark-text-primary transition-all ease-in-out">
                        Previous
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li>
                        <span
                            class="flex items-center justify-center px-3 h-8 leading-tight text-light-text-tertiary bg-light-bg-secondary border border-light-primary-variant dark:bg-dark-bg-secondary dark:border-dark-primary-variant dark:text-dark-text-tertiary transition-all ease-in-out">
                            {{ $element }}
                        </span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span aria-current="page"
                                    class="flex items-center justify-center px-3 h-8 text-white border border-light-primary bg-light-primary hover:bg-light-primary-variant dark:border-dark-primary dark:bg-dark-primary dark:text-dark-text-primary dark:hover:bg-dark-primary-variant transition-all ease-in-out">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                    class="flex items-center justify-center px-3 h-8 leading-tight text-light-text-primary bg-light-btn-secondary border border-light-primary-variant hover:bg-light-bg-tertiary hover:text-light-text-primary dark:bg-dark-bg-tertiary dark:border-dark-primary-variant dark:text-dark-text-secondary dark:hover:bg-dark-bg-secondary dark:hover:text-dark-text-primary transition-all ease-in-out">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                        class="flex items-center justify-center px-3 h-8 leading-tight text-light-text-primary bg-light-btn-secondary border border-light-primary-variant rounded-e-lg hover:bg-light-primary hover:text-white dark:bg-dark-bg-tertiary dark:border-dark-primary-variant dark:text-dark-text-secondary dark:hover:bg-dark-primary dark:hover:text-dark-text-primary transition-all ease-in-out">
                        Next
                    </a>
                </li>
            @else
                <li>
                    <span
                        class="flex items-center justify-center px-3 h-8 leading-tight text-light-text-tertiary bg-light-bg-secondary border border-light-primary-variant rounded-e-lg dark:bg-dark-bg-secondary dark:border-dark-primary-variant dark:text-dark-text-tertiary cursor-not-allowed transition-all ease-in-out">
                        Next
                    </span>
                </li>
            @endif
        </ul>
    </div>
@endif
