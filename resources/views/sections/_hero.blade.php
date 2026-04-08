{{-- Hero Section --}}
@php
	$c = $section->content ?? [];
	$stats = $c["stats"] ?? [
	    ["value" => "500+", "label" => "طالب وطالبة"],
	    ["value" => "50+", "label" => "معلم متخصص"],
	    ["value" => "15+", "label" => "سنة خبرة"],
	    ["value" => "8", "label" => "برامج تعليمية"],
	];
	$statIcons = [
	    "M12 6v12m6-6H6",
	    "M17 20h5V10a2 2 0 00-2-2h-3m-4 12V4a2 2 0 00-2-2H8a2 2 0 00-2 2v16m-4 0h16",
	    "M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z",
	    "M9 17v-2m3 2v-6m3 6v-4m3 6H6a2 2 0 01-2-2V7a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2z",
	];
@endphp

<section class="hero-section relative flex min-h-screen items-center overflow-hidden" id="home"
	data-testid="hero-section" data-hero-surface aria-labelledby="hero-heading" style="{{ $section->bgCss() }}" lang="ar"
	dir="rtl">
	{{-- Pattern overlay --}}
	<div class="hero-pattern absolute inset-0 opacity-40" aria-hidden="true"></div>
	<div class="hero-orb hero-orb-primary" aria-hidden="true"></div>
	<div class="hero-orb hero-orb-secondary" aria-hidden="true"></div>

	<div class="hero-content relative z-10 mx-auto max-w-7xl px-4 py-24 text-center sm:px-6 lg:px-8">
		{{-- Badge --}}
		@if (!empty($c["badge"]))
			<div class="hero-badge mb-8 inline-flex items-center gap-3 rounded-full px-5 py-2.5 text-sm font-semibold"
				data-testid="hero-badge">
				<span class="hero-icon-shell hero-badge-icon" data-hero-icon aria-hidden="true">
					<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
							d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
					</svg>
				</span>
				{{ $c["badge"] }}
			</div>
		@endif

		{{-- Title --}}
		<h1 class="hero-title mb-6 text-balance font-heading text-5xl font-bold leading-[1.15] md:text-6xl lg:text-7xl"
			id="hero-heading" data-testid="hero-title" @style([$section->headingColorStyle() => $section->headingColor()])>
			{{ $c["title"] ?? "مدارس الندى" }}
			@if (!empty($c["title_accent"]))
				<span class="hero-title-accent block" style="color: {{ $section->accentColor() }}">{{ $c["title_accent"] }}</span>
			@endif
		</h1>

		{{-- Subtitle --}}
		@if (!empty($c["subtitle"]))
			<p class="hero-subtitle mx-auto mb-10 max-w-3xl text-lg leading-8 md:text-2xl" data-testid="hero-subtitle"
				@style([$section->textColorStyle() => $section->textColor()])>
				{{ $c["subtitle"] }}
			</p>
		@endif

		{{-- CTAs --}}
		<div class="hero-actions mb-14 flex flex-wrap items-center justify-center gap-4">
			<a class="btn-gold hero-action px-8 py-4 text-base" data-testid="hero-cta-primary" href="#contact">
				<span class="hero-icon-shell" data-hero-icon aria-hidden="true">
					<svg class="h-5 w-5" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9"
							d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
					</svg>
				</span>
				{{ $c["cta_primary"] ?? "التسجيل الآن" }}
			</a>
			<a class="btn-outline hero-action px-8 py-4 text-base" data-testid="hero-cta-secondary" href="#about">
				<span class="hero-icon-shell hero-icon-shell-outline" data-hero-icon aria-hidden="true">
					<svg class="h-5 w-5" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9"
							d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
					</svg>
				</span>
				{{ $c["cta_secondary"] ?? "اكتشف المزيد" }}
			</a>
		</div>

		{{-- Stats --}}
		<div class="hero-stats mx-auto grid max-w-4xl grid-cols-2 gap-4 md:grid-cols-4" role="list"
			aria-label="إحصائيات المدرسة">
			@foreach ($stats as $i => $stat)
				<div class="hero-stat-card stagger-{{ $i + 1 }} rounded-3xl p-4 backdrop-blur" data-testid="hero-stat"
					role="listitem">
					<div class="hero-stat-topline mb-3 flex items-center justify-between gap-3">
						<span class="hero-icon-shell hero-stat-icon" data-hero-icon aria-hidden="true">
							<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
									d="{{ $statIcons[$i % count($statIcons)] }}" />
							</svg>
						</span>
						<span class="hero-stat-index">0{{ $i + 1 }}</span>
					</div>
					<div class="hero-stat-value font-heading text-3xl font-bold tabular-nums"
						style="color: {{ $section->accentColor() }}">{{ $stat["value"] ?? "" }}</div>
					<div class="hero-stat-label mt-1 text-sm font-medium" @style([$section->textColorStyle() => $section->textColor()])>
						{{ $stat["label"] ?? "" }}
					</div>
				</div>
			@endforeach
		</div>
	</div>

	{{-- Scroll hint --}}
	<a
		class="hero-scroll-hint absolute bottom-8 start-1/2 -translate-x-1/2 text-white/60 transition-colors hover:text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/70 motion-safe:animate-float"
		data-testid="hero-scroll-hint" href="#about" aria-label="انتقل للأسفل">
		<svg class="h-6 w-6" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
		</svg>
	</a>
</section>
