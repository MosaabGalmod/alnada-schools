{{-- About Section --}}
@php
	$c = $section->content ?? [];
	$sectionBg = $section->bgCss() ?: "background:#ffffff;";
@endphp
<section class="section" id="about" style="{{ $sectionBg }}">
	<div class="mx-auto max-w-7xl">
		<div class="grid items-center gap-16 lg:grid-cols-2">

			{{-- Visual --}}
			<div class="relative transition-all duration-700" x-data="reveal"
				:class="visible ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-8'">
				<div
					class="relative overflow-hidden rounded-4xl bg-gradient-to-br from-primary-700 to-primary-900 p-10 text-center shadow-clay-lg">
					<div class="blob -right-10 -top-10 h-48 w-48 bg-primary-400"></div>
					<div class="blob animation-delay-400 bottom-0 left-0 h-32 w-32 bg-gold-200 opacity-60"></div>
					<div class="relative z-10">
						<div class="mx-auto mb-4 flex h-24 w-24 items-center justify-center rounded-3xl bg-white/20">
							<svg class="h-12 w-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5z" />
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
									d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
							</svg>
						</div>
						<div class="font-heading text-6xl font-bold text-white">{{ $c["founding_year"] ?? "1429" }}</div>
						<div class="text-lg text-primary-200">هـ - سنة التأسيس</div>
						<div class="mt-6 text-sm leading-relaxed text-white/80">أكثر من 15 عامًا من التميز والعطاء<br />في مجال التعليم
							المتخصص</div>
					</div>
				</div>
				{{-- Floating badges --}}
				<div
					class="floating-badge absolute -left-4 -top-4 flex items-center gap-2 rounded-2xl bg-white px-4 py-3 shadow-card">
					<div class="flex h-8 w-8 items-center justify-center rounded-xl bg-gold-100">
						<svg class="h-4 w-4 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
						</svg>
					</div>
					<div>
						<div class="text-xs font-bold text-gray-800">جودة معتمدة</div>
						<div class="text-xs text-gray-400">وزارة التعليم</div>
					</div>
				</div>
				<div
					class="floating-badge absolute -bottom-4 -right-4 flex items-center gap-2 rounded-2xl bg-white px-4 py-3 shadow-card">
					<div class="flex h-8 w-8 items-center justify-center rounded-xl bg-primary-100">
						<svg class="h-4 w-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
						</svg>
					</div>
					<div>
						<div class="text-xs font-bold text-gray-800">بيئة آمنة</div>
						<div class="text-xs text-gray-400">ومحفّزة للإبداع</div>
					</div>
				</div>
			</div>

			{{-- Text --}}
			<div class="transition-all delay-200 duration-700" x-data="reveal"
				:class="visible ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-8'">
				<span class="section-tag">
					<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
					</svg>
					{{ $c["tag"] ?? "من نحن" }}
				</span>
				<h2 class="section-title" style="color: {{ $section->headingColor() }}">
					{{ $c["title"] ?? "رواد التعليم المتخصص في المدينة المنورة" }}</h2>

				@if (!empty($c["body1"]))
					<p class="{{ $section->fontSizeClass() }} mb-4 leading-relaxed" style="color: {{ $section->textColor() }}">
						{{ $c["body1"] }}
					</p>
				@endif
				@if (!empty($c["body2"]))
					<p class="{{ $section->fontSizeClass() }} mb-8 leading-relaxed" style="color: {{ $section->textColor() }}">
						{{ $c["body2"] }}
					</p>
				@endif

				<div class="mb-8 space-y-4">
					@foreach ([[$c["vision_title"] ?? "رؤيتنا", "bg-primary-100 text-primary-700", $c["vision_body"] ?? ""], [$c["mission_title"] ?? "رسالتنا", "bg-gold-100 text-gold-700", $c["mission_body"] ?? ""], [$c["values_title"] ?? "قيمنا", "bg-blue-100 text-blue-700", $c["values_body"] ?? ""]] as [$title, $badgeCls, $desc])
						@if ($desc)
							<div class="flex gap-4 rounded-2xl bg-gray-50 p-4 transition-colors hover:bg-primary-50/50">
								<span class="badge {{ $badgeCls }} mt-0.5 shrink-0">{{ $title }}</span>
								<p class="text-sm leading-relaxed text-gray-600">{{ $desc }}</p>
							</div>
						@endif
					@endforeach
				</div>

				@if (!empty($c["accessibility_note"]))
					<div class="mb-8 flex items-center gap-3 rounded-2xl border border-primary-100 bg-primary-50 p-4">
						<div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-primary-100">
							<svg class="h-5 w-5 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
							</svg>
						</div>
						<p class="text-sm font-medium text-primary-800">{{ $c["accessibility_note"] }}</p>
					</div>
				@endif

				<a class="btn-primary" href="#contact">
					تواصل معنا
					<svg class="rtl-flip h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
					</svg>
				</a>
			</div>
		</div>
	</div>
</section>
