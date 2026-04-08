@if ($paginator->hasPages())
<nav class="flex items-center justify-between gap-3 mt-4" role="navigation" dir="rtl" aria-label="التنقل بين الصفحات">
    <div class="flex items-center gap-1">
        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span class="admin-page-btn admin-page-btn--disabled" aria-disabled="true">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="mr-1 text-xs">السابق</span>
            </span>
        @else
            <button wire:click="previousPage" wire:loading.attr="disabled" class="admin-page-btn" aria-label="الصفحة السابقة">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="mr-1 text-xs">السابق</span>
            </button>
        @endif

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <button wire:click="nextPage" wire:loading.attr="disabled" class="admin-page-btn" aria-label="الصفحة التالية">
                <span class="ml-1 text-xs">التالي</span>
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
        @else
            <span class="admin-page-btn admin-page-btn--disabled" aria-disabled="true">
                <span class="ml-1 text-xs">التالي</span>
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </span>
        @endif
    </div>

    @if ($paginator->firstItem())
        <p class="text-sm text-gray-500 dark:text-gray-400">
            عرض {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }}
        </p>
    @endif
</nav>
@endif
