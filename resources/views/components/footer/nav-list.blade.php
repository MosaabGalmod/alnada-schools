@php
	/** @var string $title */
	/** @var array<int, array{href:string,label:string}> $items */
@endphp

<nav class="space-y-3" aria-label="{{ $title }}">
	<h3 class="font-heading text-xs font-bold uppercase tracking-[0.24em] text-primary-100">
		{{ $title }}
	</h3>
	<ul class="grid grid-cols-2 gap-x-3 gap-y-2">
		@foreach ($items as $item)
			<li>
				<a class="footer-list-link group" href="{{ $item["href"] }}">
					<span class="flex-1 text-right leading-6">{{ $item["label"] }}</span>
					<svg class="rtl-flip h-3 w-3 shrink-0 text-primary-500 transition-colors duration-150 group-hover:text-gold-400"
						aria-hidden="true" focusable="false" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
					</svg>
				</a>
			</li>
		@endforeach
	</ul>
</nav>
