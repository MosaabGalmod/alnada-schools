{{-- Testimonials Section --}}
@php
	$c = $section->content ?? [];
	$items = $c["items"] ?? [];
@endphp
<section class="section testimonials-section" id="testimonials" aria-labelledby="testimonials-heading"
	style="{{ $section->bgCss() }}" x-data="reveal">

	<div class="mx-auto max-w-7xl">

		{{-- Header --}}
		<div class="testi-header">
			@if (!empty($c["tag"]))
				<span class="section-tag mx-auto">{{ $c["tag"] }}</span>
			@endif
			<h2 class="section-title" id="testimonials-heading" @style([$section->headingColorStyle() => $section->headingColor()])>
				{{ $c["title"] ?? "ماذا يقول آباؤنا وأمهاتنا" }}
			</h2>
			<p class="testi-intro">
				{{ \App\Models\SiteSetting::get("testimonials_intro", "تجارب حقيقية من أولياء أمور وثقوا في مدارس الندى — بأصواتهم وبكلماتهم.") }}
			</p>
		</div>

		{{-- Cards --}}
		<ul class="testi-grid" role="list" aria-label="شهادات أولياء الأمور">
			@foreach ($items as $idx => $item)
				<li class="testi-item" role="listitem" style="--delay: {{ $idx * 120 }}ms">
					<article class="testi-card {{ $idx === 1 ? "testi-card-featured" : "" }}" tabindex="0">

						{{-- Decorative large quote --}}
						<span class="testi-quote-deco" aria-hidden="true">"</span>

						{{-- Stars --}}
						<div class="testi-stars" aria-label="تقييم 5 نجوم">
							@for ($s = 0; $s < 5; $s++)
								<svg class="testi-star" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
									<path
										d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
								</svg>
							@endfor
						</div>

						{{-- Quote text --}}
						<blockquote class="testi-text">
							{{ $item["text"] ?? "" }}
						</blockquote>

						{{-- Author --}}
						<footer class="testi-author">
							<div class="testi-avatar {{ $idx === 1 ? "testi-avatar-featured" : "" }}" aria-hidden="true">
								{{ mb_substr($item["avatar"] ?? ($item["name"] ?? "?"), 0, 2) }}
							</div>
							<cite class="testi-cite not-italic">
								<span class="testi-name">{{ $item["name"] ?? "" }}</span>
								<span class="testi-role">{{ $item["role"] ?? "" }}</span>
							</cite>
						</footer>

					</article>
				</li>
			@endforeach
		</ul>

	</div>
</section>
