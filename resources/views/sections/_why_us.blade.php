{{-- Why Us Section --}}
@php
	$c = $section->content ?? [];
	$features = $c["features"] ?? [];
	$featureEyebrows = ["كوادر", "منهجية", "تهيئة", "شراكة", "متابعة", "اعتماد"];
	$proofStats = [
	    ["label" => "محاور التميز", "value" => (string) count($features)],
	    ["label" => "الاعتماد", "value" => "رسمي"],
	    ["label" => "الشراكة", "value" => "أسرة + مدرسة"],
	];
	$interactiveFeatures = array_map(
	    static fn(array $feat, int $i): array => [
	        "title" => $feat["title"] ?? "",
	        "body" => $feat["body"] ?? "",
	        "eyebrow" => $featureEyebrows[$i % count($featureEyebrows)],
	        "index" => str_pad((string) ($i + 1), 2, "0", STR_PAD_LEFT),
	    ],
	    $features,
	    array_keys($features),
	);
	$featureStyles = [
	    ["M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z", "text-primary-700", "bg-primary-100"],
	    [
	        "M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01",
	        "text-gold-700",
	        "bg-gold-100",
	    ],
	    [
	        "M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z",
	        "text-blue-700",
	        "bg-blue-100",
	    ],
	    [
	        "M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z",
	        "text-primary-700",
	        "bg-primary-100",
	    ],
	    [
	        "M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z",
	        "text-teal-700",
	        "bg-teal-100",
	    ],
	    [
	        "M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z",
	        "text-rose-700",
	        "bg-rose-100",
	    ],
	];
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
					<h2 class="section-title why-us-title" id="why-us-heading" style="color: {{ $section->headingColor() }}">
						{{ $c["title"] ?? "ما يميزنا عن غيرنا" }}
					</h2>
					<p class="why-us-intro" id="why-us-intro">
						نرتب تجربة ولي الأمر حول {{ count($features) }} محاور واضحة: كادر متخصص، خطة فردية، بيئة مهيأة،
						وشراكة متابعة تجعل جودة المدرسة قابلة للملاحظة منذ أول تواصل.
					</p>
				</div>

				<aside class="why-us-proof" aria-label="مؤشرات الثقة">
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
						[$icon, $iconCls, $bgCls] = $featureStyles[$i % count($featureStyles)];
						$eyebrow = $featureEyebrows[$i % count($featureEyebrows)];
					@endphp
					<li
						class="why-us-card-item">
						<article class="feature-card why-us-card {{ $i === 0 ? "why-us-card-featured" : "" }} group" tabindex="0"
							:class="{ 'why-us-card-active': isActive({{ $i }}) }"
							x-on:mouseenter="setActive({{ $i }})" x-on:focusin="setActive({{ $i }})"
							x-on:keydown.enter.prevent="setActive({{ $i }})"
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
