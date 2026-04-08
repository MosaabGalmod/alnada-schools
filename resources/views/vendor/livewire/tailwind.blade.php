@if ($paginator->hasPages())
<nav class="flex flex-wrap items-center justify-between gap-3 mt-4" role="navigation" dir="rtl" aria-label="التنقل بين الصفحات">

    {{-- Results count --}}
    @if ($paginator->firstItem())
        <p class="text-sm text-gray-500 dark:text-gray-400">
            عرض
            <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $paginator->firstItem() }}</span>
            –
            <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $paginator->lastItem() }}</span>
            من
            <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $paginator->total() }}</span>
            نتيجة
        </p>
    @else
        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $paginator->count() }} نتيجة</p>
    @endif

    {{-- Page buttons --}}
    <div class="flex items-center gap-1">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span class="admin-page-btn admin-page-btn--disabled" aria-disabled="true">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </span>
        @else
            <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev" class="admin-page-btn" aria-label="الصفحة السابقة">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        @endif

        {{-- Page numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="admin-page-btn admin-page-btn--disabled">…</span>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="admin-page-btn admin-page-btn--active" aria-current="page">{{ $page }}</span>
                    @else
                        <button wire:click="gotoPage({{ $page }})" class="admin-page-btn" aria-label="الصفحة {{ $page }}">{{ $page }}</button>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <button wire:click="nextPage" wire:loading.attr="disabled" rel="next" class="admin-page-btn" aria-label="الصفحة التالية">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
        @else
            <span class="admin-page-btn admin-page-btn--disabled" aria-disabled="true">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </span>
        @endif
    </div>
</nav>
@endif
