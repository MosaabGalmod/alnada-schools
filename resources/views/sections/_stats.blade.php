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
<section class="section relative overflow-hidden" id="stats" style="{{ $section->bgCss() }}">
	<div class="relative z-10 mx-auto max-w-7xl">
		<div class="mb-14 text-center">
			@if (!empty($c["tag"]))
				<span
					class="mb-4 inline-flex items-center gap-2 rounded-full border border-white/25 bg-white/10 px-5 py-2 text-sm font-semibold tracking-wide"
					style="color: {{ $section->textColor() }}">{{ $c["tag"] }}</span>
			@endif
			<h2 class="font-heading text-4xl font-bold md:text-5xl" style="color: {{ $section->headingColor() }}">
				{{ $c["title"] ?? "أرقام تتحدث عن نجاحنا" }}</h2>
		</div>

		<div class="{{ $gridClass }} grid gap-5" x-data="statsCounter">
			@foreach ($items as $i => $item)
				<div
					class="bg-white/8 group relative rounded-4xl border border-white/20 p-6 text-center backdrop-blur transition-all duration-300 hover:-translate-y-1 hover:border-white/35 hover:bg-white/15">
					{{-- Icon --}}
					<div
						class="w-13 h-13 mx-auto mb-4 flex items-center justify-center rounded-2xl bg-white/15 transition-all duration-300 group-hover:scale-110 group-hover:bg-white/25">
						<svg class="h-6 w-6" style="color: {{ $section->accentColor() }}" fill="none" stroke="currentColor"
							viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $icons[$i % count($icons)] }}" />
						</svg>
					</div>

					{{-- Number --}}
					<div class="mb-1 font-heading text-5xl font-black leading-none" style="color: {{ $section->headingColor() }}">
						<span class="counter" data-target="{{ $item["target"] ?? 0 }}">0</span>{{ $item["suffix"] ?? "" }}
					</div>

					{{-- Label --}}
					<div class="mt-2 text-sm font-semibold tracking-wide" style="color: {{ $section->textColor() }}">
						{{ $item["label"] ?? "" }}</div>
				</div>
			@endforeach
		</div>
	</div>
</section>
