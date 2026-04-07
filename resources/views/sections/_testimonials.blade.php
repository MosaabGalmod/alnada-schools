{{-- Testimonials Section --}}
@php
	$c = $section->content ?? [];
	$items = $c["items"] ?? [];
@endphp
<section class="section" id="testimonials" style="{{ $section->bgCss() ?: "background:#ffffff;" }}">
	<div class="mx-auto max-w-7xl">
		<div class="mb-14 text-center">
			@if (!empty($c["tag"]))
				<span class="section-tag mx-auto">{{ $c["tag"] }}</span>
			@endif
			<h2 class="section-title" style="color: {{ $section->headingColor() }}">
				{{ $c["title"] ?? "ماذا يقول آباؤنا وأمهاتنا" }}</h2>
		</div>
		<div class="grid gap-6 md:grid-cols-3" role="list">
			@foreach ($items as $item)
				<div
					class="relative rounded-3xl border border-gray-100 bg-white p-7 transition-all duration-300 focus-within:ring-2 focus-within:ring-primary-300 focus-within:ring-offset-2 hover:-translate-y-1 hover:border-primary-100 hover:shadow-card-hover"
					role="listitem">
					{{-- Quote mark (decorative, RTL-aware) --}}
					<div class="inset-inline-start-6 absolute top-5 select-none font-heading text-5xl leading-none text-primary-100"
						aria-hidden="true">"</div>

					{{-- Stars (decorative) --}}
					<div class="mb-4 flex gap-0.5" aria-label="تقييم 5 نجوم">
						@for ($s = 0; $s < 5; $s++)
							<svg class="h-4 w-4 text-gold-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
								<path
									d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
							</svg>
						@endfor
					</div>

					<p class="relative z-10 mb-6 text-sm leading-loose text-gray-600">
						"{{ $item["text"] ?? "" }}"
					</p>

					<div class="flex items-center gap-3 border-t border-gray-50 pt-4">
						<div
							class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-primary-500 to-primary-700 text-sm font-bold text-white shadow-clay"
							aria-hidden="true">
							{{ mb_substr($item["avatar"] ?? ($item["name"] ?? "?"), 0, 2) }}
						</div>
						<div>
							<div class="text-sm font-semibold text-gray-900">{{ $item["name"] ?? "" }}</div>
							<div class="mt-0.5 text-xs text-gray-400">{{ $item["role"] ?? "" }}</div>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>
</section>
