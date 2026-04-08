@if ($paginator->hasPages())
<nav class="flex flex-wrap items-center justify-between gap-3 pt-2" role="navigation" dir="rtl" aria-label="التنقل بين الصفحات">

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

{{-- Previous (RTL: arrow pointing right → go right = previous) --}}
@if ($paginator->onFirstPage())
<span class="admin-page-btn admin-page-btn--disabled" aria-disabled="true">
<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
</svg>
</span>
@else
<a class="admin-page-btn" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="الصفحة السابقة">
<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
</svg>
</a>
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
<a class="admin-page-btn" href="{{ $url }}" aria-label="الصفحة {{ $page }}">{{ $page }}</a>
@endif
@endforeach
@endif
@endforeach

{{-- Next (RTL: arrow pointing left → go left = next) --}}
@if ($paginator->hasMorePages())
<a class="admin-page-btn" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="الصفحة التالية">
<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
</svg>
</a>
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
