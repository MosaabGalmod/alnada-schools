{{-- Why Us Section --}}
@php
	use App\View\Support\IconLibrary;

	$c = $section->content ?? [];
	$features = $c["features"] ?? [];
	$featureEyebrows = ["كوادر", "منهجية", "تهيئة", "شراكة", "متابعة", "اعتماد"];
	$proofStats = [
	    ["label" => "محاور التميز", "value" => (string) count($features)],
	    ["label" => "الاعتماد", "value" => "رسمي"],
	    ["label" => "الشراكة", "value" => "أسرة + مدرسة"],
	];
	// Color palette cycles for cards (independent of icon choice)
	$colorCycle = [
	    ["text-primary-700", "bg-primary-100"],
	    ["text-gold-700", "bg-gold-100"],
	    ["text-blue-700", "bg-blue-100"],
	    ["text-primary-700", "bg-primary-100"],
	    ["text-teal-700", "bg-teal-100"],
	    ["text-rose-700", "bg-rose-100"],
	];
	$interactiveFeatures = array_map(
	    static fn(array $feat, int $i): array => [
	        "title" => $feat["title"] ?? "",
	        "body" => $feat["body"] ?? "",
	        "eyebrow" => $featureEyebrows[$i % count($featureEyebrows)],
	        "index" => str_pad((string) ($i + 1), 2, "0", STR_PAD_LEFT),
	        "icon" => IconLibrary::path($feat["icon"] ?? ""),
	        "iconCls" => $colorCycle[$i % count($colorCycle)][0],
	        "bgCls" => $colorCycle[$i % count($colorCycle)][1],
	    ],
	    $features,
	    array_keys($features),
	);
@endphp

<section class="section why-us-section" id="why_us" aria-labelledby="why-us-heading" aria-describedby="why-us-intro"
	style="{{ $section->bgCss() }}" x-data="whyUsSection(@js($interactiveFeatures))">
	<div class="mx-auto max-w-7xl">
		<div class="why-us-shell">
			<div class="why-us-header">
				<div class="why-us-copy">
					@if (!empty($c["tag"]))
						<span class="section-tag why-us-tag">{{ $c["tag"] }}</span>
					@endif
					<h2 class="section-title why-us-title" id="why-us-heading" @style([$section->headingColorStyle() => $section->headingColor()])>
						{{ $c["title"] ?? "ما يميزنا عن غيرنا" }}
					</h2>
					<p class="why-us-intro" id="why-us-intro">
						{{ \App\Models\SiteSetting::get("why_us_intro", "نرتب تجربة ولي الأمر حول " . count($features) . " محاور واضحة: كادر متخصص، خطة فردية، بيئة مهيأة، وشراكة متابعة تجعل جودة المدرسة قابلة للملاحظة منذ أول تواصل.") }}
					</p>
				</div>

				<aside class="why-us-proof hidden" aria-label="مؤشرات الثقة" aria-hidden="true">
					<p class="why-us-proof-kicker">صورة سريعة</p>
					<h3 class="why-us-proof-title">وضوح أكبر في القيمة التي يحصل عليها ولي الأمر.</h3>
					<p class="why-us-proof-text">
						بدلاً من بطاقات متشابهة فقط، يجمع هذا القسم بين ملخص سريع ومحاور تفصيلية قابلة للمسح البصري.
					</p>
					<div class="why-us-proof-active" aria-live="polite">
						<div class="why-us-proof-active-meta">
							<span class="why-us-proof-active-index" x-text="activeFeature.index"></span>
							<span class="why-us-proof-active-eyebrow" x-text="activeFeature.eyebrow"></span>
						</div>
						<p class="why-us-proof-active-label">المحور النشط</p>
						<h4 class="why-us-proof-active-title" id="why-us-proof-active-title" x-text="activeFeature.title"></h4>
						<p class="why-us-proof-active-body" x-text="activeFeature.body"></p>
					</div>
					<dl class="why-us-proof-grid">
						@foreach ($proofStats as $stat)
							<div class="why-us-proof-stat">
								<dt class="why-us-proof-label">{{ $stat["label"] }}</dt>
								<dd class="why-us-proof-value">{{ $stat["value"] }}</dd>
							</div>
						@endforeach
					</dl>
				</aside>
			</div>

			<ul class="why-us-grid" aria-label="عناصر التميز">
				@foreach ($features as $i => $feat)
					@php
						$icon = IconLibrary::path($feat["icon"] ?? "");
						$iconCls = $colorCycle[$i % count($colorCycle)][0];
						$bgCls = $colorCycle[$i % count($colorCycle)][1];
						$eyebrow = $featureEyebrows[$i % count($featureEyebrows)];
					@endphp
					<li class="why-us-card-item">
						<article class="feature-card why-us-card {{ $i === 0 ? "why-us-card-featured" : "" }} group" tabindex="0"
							:class="{ 'why-us-card-active': isActive({{ $i }}) }" x-on:mouseenter="setActive({{ $i }})"
							x-on:focusin="setActive({{ $i }})" x-on:keydown.enter.prevent="setActive({{ $i }})"
							x-on:keydown.space.prevent="setActive({{ $i }})">
							<div class="why-us-card-top">
								<span class="why-us-card-index">{{ str_pad((string) ($i + 1), 2, "0", STR_PAD_LEFT) }}</span>
								<span class="why-us-card-eyebrow">{{ $eyebrow }}</span>
							</div>
							<div class="why-us-card-body">
								<div class="why-us-card-icon {{ $bgCls }}">
									<svg class="{{ $iconCls }} h-7 w-7" aria-hidden="true" fill="none" stroke="currentColor"
										viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $icon }}" />
									</svg>
								</div>
								<div class="why-us-card-copy">
									<h3 class="why-us-card-title">{{ $feat["title"] ?? "" }}</h3>
									<p class="why-us-card-text">{{ $feat["body"] ?? "" }}</p>
								</div>
							</div>
						</article>
					</li>
				@endforeach
			</ul>
		</div>
	</div>
</section>
