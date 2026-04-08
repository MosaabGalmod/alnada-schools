{{-- Programs Section --}}
@php
	use App\View\Support\IconLibrary;

	$c = $section->content ?? [];
	$programs = $c["programs"] ?? [];
	$colorMap = [
	    "green" => ["bg-primary-100", "text-primary-700", "bg-primary-500", "badge-green"],
	    "blue" => ["bg-blue-100", "text-blue-700", "bg-blue-500", "badge-blue"],
	    "purple" => ["bg-purple-100", "text-purple-700", "bg-purple-500", "badge-purple"],
	    "gold" => ["bg-gold-100", "text-gold-700", "bg-gold-500", "badge-gold"],
	    "red" => ["bg-rose-100", "text-rose-700", "bg-rose-500", "badge-red"],
	    "teal" => ["bg-teal-100", "text-teal-700", "bg-teal-500", "badge-green"],
	];
	$programCount = count($programs);
	$allTags = [];
	$interactivePrograms = array_map(
	    static function (array $prog, int $k) use ($colorMap, &$allTags): array {
	        $color = $prog["color"] ?? "green";
	        [, , , $badgeCls] = $colorMap[$color] ?? $colorMap["green"];
	        $tags = array_map("trim", explode("،", $prog["tags"] ?? ""));
	        if (count($tags) === 1) {
	            $tags = array_map("trim", explode(",", $prog["tags"] ?? ""));
	        }
	        $tags = array_values(array_filter($tags));
	        $allTags = [...$allTags, ...$tags];

	        return [
	            "index" => str_pad((string) ($k + 1), 2, "0", STR_PAD_LEFT),
	            "title" => $prog["title"] ?? "",
	            "description" => $prog["description"] ?? "",
	            "tags" => $tags,
	            "badgeClass" => $badgeCls,
	            "icon" => IconLibrary::path($prog["icon"] ?? ""),
	        ];
	    },
	    $programs,
	    array_keys($programs),
	);
	$uniqueTagCount = count(array_unique($allTags));
	$programStats = [
	    ["label" => "مسارات متاحة", "value" => (string) $programCount],
	    ["label" => "مجالات دعم", "value" => (string) $uniqueTagCount],
	    ["label" => "متابعة فردية", "value" => "مستمرة"],
	];
@endphp

<section class="section" id="programs" aria-labelledby="programs-heading"
	style="{{ $section->bgCss() ?: "background: linear-gradient(160deg,#edf6fb 0%,#dceef8 100%);" }}"
	x-data="programsShowcase(@js($interactivePrograms))">
	<div class="mx-auto max-w-7xl">
		<div class="programs-shell">
			<div class="programs-header">
				<div class="programs-copy transition-all duration-700" x-data="reveal"
					:class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'">
					<span class="section-tag mx-auto lg:mx-0">
						<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
						</svg>
						{{ $c["tag"] ?? "برامجنا" }}
					</span>
					<h2 class="section-title programs-title" id="programs-heading" style="color: {{ $section->headingColor() }}">
						{{ $c["title"] ?? "برامج تعليمية متكاملة" }}
					</h2>
					<p class="section-desc programs-desc" style="color: {{ $section->textColor() }}">
						{{ $c["subtitle"] ?? "نرتب البرامج على شكل مسارات واضحة تساعد ولي الأمر على فهم نوع الدعم والنتائج المتوقعة بسرعة، مع تفاصيل قابلة للمقارنة في نفس المساحة." }}
					</p>
					<dl class="programs-stats" aria-label="ملخص البرامج">
						@foreach ($programStats as $stat)
							<div class="programs-stat">
								<dt class="programs-stat-label">{{ $stat["label"] }}</dt>
								<dd class="programs-stat-value">{{ $stat["value"] }}</dd>
							</div>
						@endforeach
					</dl>
				</div>

				@if ($programCount > 0)
					<aside class="programs-showcase" data-testid="programs-showcase" aria-live="polite">
						<div class="programs-showcase-top">
							<div class="programs-showcase-badge-wrap">
								<span class="programs-showcase-index" x-text="activeProgram.index"></span>
								<span class="programs-showcase-kicker">المسار النشط</span>
							</div>
							<div class="programs-showcase-icon" aria-hidden="true">
								<svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" x-bind:d="activeProgram.icon"></path>
								</svg>
							</div>
						</div>
						<h3 class="programs-showcase-title" data-testid="programs-showcase-title" x-text="activeProgram.title"></h3>
						<p class="programs-showcase-description" data-testid="programs-showcase-description"
							x-text="activeProgram.description"></p>
						<div class="programs-showcase-tags" aria-label="نطاق البرنامج">
							<template x-for="tag in activeProgram.tags" :key="`${activeProgram.title}-${tag}`">
								<span class="badge" :class="activeProgram.badgeClass" x-text="tag"></span>
							</template>
						</div>
					</aside>
				@endif
			</div>

			<ul class="programs-grid" aria-label="البرامج التعليمية">
				@foreach ($programs as $k => $prog)
					@php
						$color = $prog["color"] ?? "green";
						[$iconBg, $iconText, $accentBg, $badgeCls] = $colorMap[$color] ?? $colorMap["green"];
						$icon = IconLibrary::path($prog["icon"] ?? "");
						$tags = array_map("trim", explode("،", $prog["tags"] ?? ""));
						if (count($tags) === 1) {
						    $tags = array_map("trim", explode(",", $prog["tags"] ?? ""));
						}
						$stagger = "stagger-" . (($k % 6) + 1);
					@endphp
					<li class="programs-card-item {{ $stagger }}" role="listitem">
						<button class="feature-card programs-card group relative overflow-hidden transition-all duration-300"
							data-program-card type="button" aria-describedby="program-card-desc-{{ $k }}"
							x-on:mouseenter="setActive({{ $k }})" x-on:focus="setActive({{ $k }})"
							x-on:click="setActive({{ $k }})"
							:class="isActive({{ $k }}) ? 'programs-card-active' : ''"
							:aria-pressed="isActive({{ $k }}) ? 'true' : 'false'">
							<div class="{{ $accentBg }} absolute inset-x-0 top-0 h-1 rounded-t-[1.75rem]" aria-hidden="true"></div>

							<div class="programs-card-topline">
								<span class="programs-card-index">{{ str_pad((string) ($k + 1), 2, "0", STR_PAD_LEFT) }}</span>
								<span class="programs-card-hint">اختر لعرض التفاصيل</span>
							</div>

							<div class="{{ $iconBg }} programs-card-icon">
								<svg class="{{ $iconText }} h-7 w-7" aria-hidden="true" fill="none" stroke="currentColor"
									viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $icon }}" />
								</svg>
							</div>

							<h3 class="programs-card-title" data-program-title>{{ $prog["title"] ?? "" }}</h3>
							<p class="programs-card-text" id="program-card-desc-{{ $k }}" data-program-description>
								{{ $prog["description"] ?? "" }}
							</p>
							<div class="programs-card-tags" data-program-tags aria-label="التخصصات">
								@foreach ($tags as $tag)
									@if ($tag)
										<span class="badge {{ $badgeCls }}">{{ $tag }}</span>
									@endif
								@endforeach
							</div>
						</button>
					</li>
				@endforeach
			</ul>
		</div>
	</div>
</section>
