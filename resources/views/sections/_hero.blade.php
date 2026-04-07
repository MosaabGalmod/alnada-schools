{{-- Hero Section --}}
@php
	$c = $section->content ?? [];
	$stats = $c["stats"] ?? [
	    ["value" => "500+", "label" => "طالب وطالبة"],
	    ["value" => "50+", "label" => "معلم متخصص"],
	    ["value" => "15+", "label" => "سنة خبرة"],
	    ["value" => "8", "label" => "برامج تعليمية"],
	];
@endphp
<section class="relative flex min-h-screen items-center overflow-hidden" id="home" style="{{ $section->bgCss() }}">
	{{-- Pattern overlay --}}
	<div class="hero-pattern absolute inset-0 opacity-40"></div>

	<div class="relative z-10 mx-auto max-w-7xl px-4 py-32 text-center">
		{{-- Badge --}}
		@if (!empty($c["badge"]))
			<div
				class="mb-8 inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-sm font-medium text-white/90 backdrop-blur">
				<svg class="h-4 w-4 text-gold-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
				</svg>
				{{ $c["badge"] }}
			</div>
		@endif

		{{-- Title --}}
		<h1 class="mb-6 text-balance font-heading text-5xl font-bold leading-tight md:text-6xl lg:text-7xl"
			style="color: {{ $section->headingColor() }}">
			{{ $c["title"] ?? "مدارس الندى" }}
			@if (!empty($c["title_accent"]))
				<span class="block" style="color: {{ $section->accentColor() }}">{{ $c["title_accent"] }}</span>
			@endif
		</h1>

		{{-- Subtitle --}}
		@if (!empty($c["subtitle"]))
			<p class="mx-auto mb-10 max-w-3xl text-xl leading-relaxed md:text-2xl" style="color: {{ $section->textColor() }}">
				{{ $c["subtitle"] }}
			</p>
		@endif

		{{-- CTAs --}}
		<div class="mb-16 flex flex-wrap items-center justify-center gap-4">
			<a class="btn-gold px-8 py-4 text-base" href="#contact">
				<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
				</svg>
				{{ $c["cta_primary"] ?? "التسجيل الآن" }}
			</a>
			<a class="btn-outline px-8 py-4 text-base" href="#about">
				<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
				</svg>
				{{ $c["cta_secondary"] ?? "اكتشف المزيد" }}
			</a>
		</div>

		{{-- Stats --}}
		<div class="mx-auto grid max-w-3xl grid-cols-2 gap-4 md:grid-cols-4">
			@foreach ($stats as $stat)
				<div class="rounded-3xl border border-white/20 bg-white/10 p-4 backdrop-blur transition-all hover:bg-white/15">
					<div class="font-heading text-3xl font-bold" style="color: {{ $section->accentColor() }}">
						{{ $stat["value"] ?? "" }}</div>
					<div class="mt-1 text-sm" style="color: {{ $section->textColor() }}">{{ $stat["label"] ?? "" }}</div>
				</div>
			@endforeach
		</div>
	</div>

	{{-- Scroll hint --}}
	<a class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-float text-white/60 transition-colors hover:text-white"
		href="#about" aria-label="انتقل للأسفل">
		<svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
		</svg>
	</a>
</section>
