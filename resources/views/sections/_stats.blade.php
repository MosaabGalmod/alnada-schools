{{-- Stats Section --}}
@php
	$c = $section->content ?? [];
	$items = $c["items"] ?? [];
	$icons = [
	    // heart — parent satisfaction
	    "M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z",
	    // book — educational programs
	    "M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253",
	    // award/badge — years of experience
	    "M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z",
	    // academic cap — specialized teachers
	    "M12 14l9-5-9-5-9 5 9 5zM12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z",
	    // users group — students
	    "M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z",
	];
	$cols = min(count($items) ?: 5, 5);
	$gridClass = match ($cols) {
	    2 => "grid-cols-2",
	    3 => "grid-cols-2 lg:grid-cols-3",
	    4 => "grid-cols-2 lg:grid-cols-4",
	    default => "grid-cols-2 lg:grid-cols-5",
	};
@endphp
<section class="section stats-section" id="stats" aria-labelledby="stats-heading" style="{{ $section->bgCss() }}">

	<div class="relative z-10 mx-auto max-w-7xl">

		{{-- Header --}}
		<div class="stats-header">
			@if (!empty($c["tag"]))
				<span class="stats-tag" style="color: {{ $section->textColor() }}">{{ $c["tag"] }}</span>
			@endif
			<h2 class="stats-title" id="stats-heading" style="color: {{ $section->headingColor() }}">
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
							<svg class="stats-card-icon-svg" aria-hidden="true" style="color: {{ $section->accentColor() }}" fill="none"
								stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $icons[$i % count($icons)] }}" />
							</svg>
						</div>

						{{-- Number + suffix --}}
						<div class="stats-card-number" style="color: {{ $section->headingColor() }}">
							<span class="counter" data-target="{{ $item["target"] ?? 0 }}" aria-live="polite"
								aria-atomic="true">0</span>{{ $item["suffix"] ?? "" }}
						</div>

						{{-- Label --}}
						<p class="stats-card-label" style="color: {{ $section->textColor() }}">
							{{ $item["label"] ?? "" }}
						</p>

					</article>
				</li>
			@endforeach
		</ul>
	</div>
</section>
