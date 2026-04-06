{{-- Programs Section --}}
@php
	$c = $section->content ?? [];
	$programs = $c["programs"] ?? [];
	$colorMap = [
	    "green" => ["from-primary-700 to-primary-900", "badge-green"],
	    "blue" => ["from-blue-600 to-blue-800", "badge-blue"],
	    "purple" => ["from-primary-500 to-primary-700", "badge-green"],
	    "gold" => ["from-gold-600 to-gold-800", "badge-gold"],
	    "red" => ["from-rose-600 to-rose-800", "badge-red"],
	    "teal" => ["from-teal-600 to-teal-800", "badge-green"],
	];
	$icons = [
	    "التعليم العام" =>
	        "M12 14l9-5-9-5-9 5 9 5zM12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z",
	    "التربية الخاصة" =>
	        "M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z",
	    "برامج الدمج" =>
	        "M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z",
	    "رياض الأطفال" => "M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z",
	    "العلاج الوظيفي" =>
	        "M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z",
	    "علاج النطق" =>
	        "M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z",
	];
	$defaultIcon =
	    "M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2";
@endphp
<section class="section" id="programs"
	style="{{ $section->bgCss() ?: "background: linear-gradient(135deg,#f0f9fd 0%,#daf1fa 100%);" }}">
	<div class="mx-auto max-w-7xl">
		<div class="mb-14 text-center" class="transition-all duration-700" x-data="reveal"
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

		<div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
			@foreach ($programs as $prog)
				@php
					$color = $prog["color"] ?? "green";
					[$gradient, $badgeCls] = $colorMap[$color] ?? $colorMap["green"];
					$icon = $icons[$prog["title"] ?? ""] ?? $defaultIcon;
					$tags = array_map("trim", explode("،", $prog["tags"] ?? ""));
					if (count($tags) === 1) {
					    $tags = array_map("trim", explode(",", $prog["tags"] ?? ""));
					}
				@endphp
				<div class="clay-card group transition-all duration-700" x-data="reveal"
					:class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'">
					<div
						class="{{ $gradient }} mb-4 flex h-14 w-14 items-center justify-center rounded-3xl bg-gradient-to-br shadow-clay transition-transform duration-300 group-hover:scale-110">
						<svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $icon }}" />
						</svg>
					</div>
					<h3 class="mb-2 font-heading text-xl font-bold text-gray-900">{{ $prog["title"] ?? "" }}</h3>
					<p class="mb-4 text-sm leading-relaxed text-gray-500">{{ $prog["description"] ?? "" }}</p>
					<div class="flex flex-wrap gap-2">
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
