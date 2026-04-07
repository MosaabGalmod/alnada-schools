{{-- Programs Section --}}
@php
	$c = $section->content ?? [];
	$programs = $c["programs"] ?? [];
	$colorMap = [
	    "green" => ["bg-primary-100", "text-primary-700", "bg-primary-500", "badge-green"],
	    "blue" => ["bg-blue-100", "text-blue-700", "bg-blue-500", "badge-blue"],
	    "purple" => ["bg-purple-100", "text-purple-700", "bg-purple-500", "badge-green"],
	    "gold" => ["bg-gold-100", "text-gold-700", "bg-gold-500", "badge-gold"],
	    "red" => ["bg-rose-100", "text-rose-700", "bg-rose-500", "badge-red"],
	    "teal" => ["bg-teal-100", "text-teal-700", "bg-teal-500", "badge-green"],
	];
	$icons = [
	    "التعليم العام" =>
	        "M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253",
	    "التربية الخاصة" =>
	        "M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z",
	    "برامج الدمج" =>
	        "M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z",
	    "رياض الأطفال" => "M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z",
	    "العلاج الوظيفي" =>
	        "M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z",
	    "علاج النطق" =>
	        "M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z",
	];
	$defaultIcon =
	    "M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2";
@endphp
<section class="section" id="programs"
	style="{{ $section->bgCss() ?: "background: linear-gradient(160deg,#edf6fb 0%,#dceef8 100%);" }}">
	<div class="mx-auto max-w-7xl">
		<div class="mb-14 text-center transition-all duration-700" x-data="reveal"
			:class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'">
			<span class="section-tag mx-auto">
				<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
				</svg>
				{{ $c["tag"] ?? "برامجنا" }}
			</span>
			<h2 class="section-title" style="color: {{ $section->headingColor() }}">{{ $c["title"] ?? "برامج تعليمية متكاملة" }}
			</h2>
			@if (!empty($c["subtitle"]))
				<p class="section-desc mx-auto" style="color: {{ $section->textColor() }}">{{ $c["subtitle"] }}</p>
			@endif
		</div>

		<div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3" role="list">
			@foreach ($programs as $k => $prog)
				@php
					$color = $prog["color"] ?? "green";
					[$iconBg, $iconText, $accentBg, $badgeCls] = $colorMap[$color] ?? $colorMap["green"];
					$icon = $icons[$prog["title"] ?? ""] ?? $defaultIcon;
					$tags = array_map("trim", explode("،", $prog["tags"] ?? ""));
					if (count($tags) === 1) {
					    $tags = array_map("trim", explode(",", $prog["tags"] ?? ""));
					}
					$stagger = "stagger-" . (($k % 6) + 1);
				@endphp
				<div class="feature-card group relative overflow-hidden cursor-default {{ $stagger }} transition-all duration-700" x-data="reveal"
					:class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'" role="listitem">
					{{-- Colored accent bar at top --}}
					<div class="{{ $accentBg }} absolute inset-x-0 top-0 h-1 rounded-t-[1.75rem]" aria-hidden="true"></div>

					{{-- Icon --}}
					<div
						class="{{ $iconBg }} mb-5 mt-2 flex h-14 w-14 items-center justify-center rounded-2xl shadow-sm transition-transform duration-300 group-hover:scale-110">
						<svg class="{{ $iconText }} h-7 w-7" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $icon }}" />
						</svg>
					</div>

					<h3 class="mb-2 font-heading text-xl font-bold text-gray-900 dark:text-white">{{ $prog["title"] ?? "" }}</h3>
					<p class="mb-4 text-sm leading-relaxed text-gray-500">{{ $prog["description"] ?? "" }}</p>
					<div class="flex flex-wrap gap-2" aria-label="التخصصات">
						@foreach ($tags as $tag)
							@if ($tag)
								<span class="badge {{ $badgeCls }}">{{ $tag }}</span>
							@endif
						@endforeach
					</div>
				</div>
			@endforeach
		</div>
	</div>
</section>
