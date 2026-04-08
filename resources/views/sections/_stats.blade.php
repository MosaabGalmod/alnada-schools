{{-- Stats Section --}}
@php
	use App\View\Support\IconLibrary;

	$c = $section->content ?? [];
	$items = $c["items"] ?? [];
	$cols = min(count($items) ?: 5, 5);
	$gridClass = match ($cols) {
	    2 => "grid-cols-2",
	    3 => "grid-cols-2 lg:grid-cols-3",
	    4 => "grid-cols-2 lg:grid-cols-4",
	    default => "grid-cols-2 lg:grid-cols-5",
	};
@endphp
<section class="section stats-section" id="stats" aria-labelledby="stats-heading"
	style="{{ $section->bgCss() }} --stats-tag-color: {{ $section->textColor() }}; --stats-title-color: {{ $section->headingColor() }}; --stats-number-color: {{ $section->headingColor() }}; --stats-label-color: {{ $section->textColor() }}; --stats-accent-color: {{ $section->accentColor() }};">

	<div class="relative z-10 mx-auto max-w-7xl">

		{{-- Header --}}
		<div class="stats-header">
			@if (!empty($c["tag"]))
				<span class="stats-tag">{{ $c["tag"] }}</span>
			@endif
			<h2 class="stats-title" id="stats-heading">
				{{ $c["title"] ?? "أرقام تتحدث عن نجاحنا" }}
			</h2>
		</div>

		{{-- Grid --}}
		<ul class="{{ $gridClass }} grid gap-5" role="list" aria-label="إحصائيات الإنجازات" x-data="statsCounter">
			@foreach ($items as $i => $item)
				<li class="stats-card-item" role="listitem" style="--delay: {{ $i * 100 }}ms">
					<article class="stats-card group">

						{{-- Accent top line --}}
						<div class="stats-card-accent" aria-hidden="true"></div>

						{{-- Icon --}}
						<div class="stats-card-icon group-hover:scale-110" aria-hidden="true">
							<svg class="stats-card-icon-svg" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
									d="{{ IconLibrary::path($item['icon'] ?? '') }}" />
							</svg>
						</div>

						{{-- Number + suffix --}}
						<div class="stats-card-number">
							<span class="counter" data-target="{{ (int) ($item["target"] ?? 0) }}" aria-live="polite"
								aria-atomic="true">0</span>{{ $item["suffix"] ?? "" }}
						</div>

						{{-- Label --}}
						<p class="stats-card-label">
							{{ $item["label"] ?? "" }}
						</p>

					</article>
				</li>
			@endforeach
		</ul>
	</div>
</section>
