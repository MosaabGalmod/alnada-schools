@extends("layouts.app")
@section("title", "مدارس الندى النموذجية الأهلية | التربية الخاصة والدمج - المدينة المنورة")
@section("meta_description",
	"مدارس الندى النموذجية الأهلية بالمدينة المنورة – رائدة في التربية الخاصة والدمج منذ
	1429هـ. نقدم برامج التوحد، صعوبات التعلم، العلاج الوظيفي، علاج النطق، رياض الأطفال. تواصل: +966 14 848 2306")

@section("schema")
	@verbatim
		<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "School",
  "name": "مدارس الندى النموذجية الأهلية",
  "alternateName": "Al-Nada Model Schools",
  "description": "مؤسسة تعليمية رائدة في التربية الخاصة والدمج بالمدينة المنورة منذ عام 1429هـ",
  "url": "https://alnada.com.sa",
  "telephone": "+966148482306",
  "email": "alnadaiec@gmail.com",
  "foundingDate": "2008",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "(2957) شارع الحسين بن علي بن الأسود",
    "addressLocality": "المدينة المنورة",
    "addressRegion": "منطقة المدينة المنورة",
    "postalCode": "42332",
    "addressCountry": "SA"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": 24.5084508,
    "longitude": 39.5657885
  },
  "openingHoursSpecification": [{
    "@type": "OpeningHoursSpecification",
    "dayOfWeek": ["Sunday","Monday","Tuesday","Wednesday","Thursday"],
    "opens": "07:00",
    "closes": "13:00"
  }],
  "sameAs": [
    "https://www.instagram.com/alnada_school/",
    "https://x.com/AIEC_",
    "https://www.facebook.com/Alnada2021/"
  ]
}
</script>
	@endverbatim
@endsection

@section("content")
	<div id="main-content">

		{{-- ===== NAVBAR ===== --}}
		<nav class="fixed inset-x-0 top-0 z-50 px-4 transition-all duration-300" x-data="navbar"
			:class="scrolled ? 'glass shadow-lg py-3' : 'py-5 bg-transparent'">
			<div class="mx-auto flex max-w-7xl items-center justify-between">

				{{-- Logo --}}
				<a class="group flex items-center gap-3" href="#">
					<div
						class="flex h-11 w-11 items-center justify-center overflow-hidden rounded-2xl bg-white shadow-clay transition-all group-hover:shadow-clay-lg">
						<img class="h-auto w-9 object-contain" src="{{ asset("logo.svg") }}" alt="شعار مدارس الندى">
					</div>
					<div class="leading-tight">
						<div class="font-heading text-base font-bold transition-colors"
							:class="scrolled ? 'text-primary-800' : 'text-white'">مدارس الندى</div>
						<div class="text-xs transition-colors" :class="scrolled ? 'text-gray-500' : 'text-primary-100'">النموذجية الأهلية
						</div>
					</div>
				</a>

				{{-- Desktop Links --}}
				<ul class="hidden items-center gap-1 lg:flex">
					@foreach ([["#home", "الرئيسية"], ["#about", "من نحن"], ["#programs", "برامجنا"], ["#stats", "إنجازاتنا"], ["#news", "الأخبار"], ["#contact", "تواصل"]] as [$href, $label])
						<li>
							<a class="rounded-xl px-3 py-2 text-sm font-medium transition-all duration-150" href="{{ $href }}"
								:class="scrolled ? 'text-gray-600 hover:text-primary-700 hover:bg-primary-50' :
								    'text-white/90 hover:text-white hover:bg-white/10'">{{ $label }}</a>
						</li>
					@endforeach
				</ul>

				{{-- CTA --}}
				<div class="flex items-center gap-3">
					<a class="btn-primary hidden px-5 py-2.5 text-sm md:inline-flex" href="#contact">
						<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
						</svg>
						سجّل الآن
					</a>

					{{-- Dark Mode Toggle (3-state: auto → dark → light → auto) --}}
					<button class="dark-toggle" aria-label="تبديل الوضع الداكن" x-data="{
	    get mode() {
	        const s = localStorage.getItem('theme');
	        return s === 'dark' ? 'dark' : s === 'light' ? 'light' : 'auto';
	    },
	    cycle() {
	        const current = this.mode;
	        const html = document.documentElement;
	        const sysDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
	        if (current === 'auto') {
	            // auto → dark
	            html.classList.add('dark');
	            localStorage.setItem('theme', 'dark');
	        } else if (current === 'dark') {
	            // dark → light
	            html.classList.remove('dark');
	            localStorage.setItem('theme', 'light');
	        } else {
	            // light → auto (remove preference, follow system)
	            localStorage.removeItem('theme');
	            sysDark ? html.classList.add('dark') : html.classList.remove('dark');
	        }
	    }
	}" x-on:click="cycle()"
						:aria-label="mode === 'auto' ? 'الوضع التلقائي' : mode === 'dark' ? 'الوضع الداكن' : 'الوضع الفاتح'"
						:class="scrolled ? 'text-gray-600 dark:text-gray-300' : 'text-white/80 hover:text-white'">
						{{-- Auto icon (shown when mode=auto and system is light) --}}
						<svg class="h-5 w-5" x-show="mode === 'auto'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
							stroke-width="1.8" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round"
								d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25A2.25 2.25 0 0 1 5.25 3h13.5A2.25 2.25 0 0 1 21 5.25Z" />
						</svg>
						{{-- Sun icon (shown in dark mode) --}}
						<svg class="h-5 w-5" x-show="mode === 'dark'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
							stroke-width="1.8" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round"
								d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
						</svg>
						{{-- Moon icon (shown in light mode) --}}
						<svg class="h-5 w-5" x-show="mode === 'light'" xmlns="http://www.w3.org/2000/svg" fill="none"
							viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round"
								d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
						</svg>
					</button>

					<button class="rounded-xl p-2 transition-colors lg:hidden" aria-label="القائمة" @click="mobileOpen = !mobileOpen"
						:class="scrolled ? 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-primary-900/40' :
						    'text-white hover:bg-white/10'">
						<svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M4 6h16M4 12h16M4 18h16" />
							<path x-show="mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M6 18L18 6M6 6l12 12" />
						</svg>
					</button>
				</div>
			</div>

			{{-- Mobile Menu --}}
			<div class="glass mt-3 rounded-3xl p-4 shadow-xl lg:hidden" style="display:none" x-show="mobileOpen"
				x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2"
				x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150"
				x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2">
				@foreach ([["#home", "الرئيسية"], ["#about", "من نحن"], ["#programs", "برامجنا"], ["#stats", "إنجازاتنا"], ["#news", "الأخبار"], ["#contact", "تواصل"]] as [$href, $label])
					<a
						class="flex items-center rounded-2xl px-4 py-3 font-medium text-gray-700 transition-all hover:bg-primary-50 hover:text-primary-700"
						href="{{ $href }}" @click="mobileOpen=false">{{ $label }}</a>
				@endforeach
				<div class="border-t border-gray-100 pt-2">
					<a class="btn-primary mt-2 w-full justify-center" href="#contact">سجّل الآن</a>
				</div>
			</div>
		</nav>

		{{-- ===== DYNAMIC SECTIONS ===== --}}
		@foreach ($sections as $section)
			@include("sections._" . $section->type, [
				"section" => $section,
				"announcements" => $announcements ?? collect(),
			])
		@endforeach

		{{-- ===== FOOTER ===== --}}
		@php
			$ft = \App\Models\SiteSetting::all_settings();
			$ftPhone = $ft["phone"] ?? "+966 14 848 2306";
			$ftEmail = $ft["email"] ?? "alnadaiec@gmail.com";
			$ftAddress = $ft["address"] ?? "شارع الحسين بن علي، حي البركة، المدينة المنورة 42332";
			$ftHours = $ft["working_hours"] ?? "الأحد – الخميس: 7:00ص – 1:00م";
			$ftTel = "tel:" . preg_replace("/[\s\-()]/", "", $ftPhone);
			$ftSocials = [
			    [
			        "href" => "https://www.instagram.com/" . ($ft["instagram"] ?? "alnada_school") . "/",
			        "label" => "إنستغرام",
			        "bg" => "bg-gradient-to-br from-primary-500 to-primary-700",
			        "path" =>
			            "M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z",
			    ],
			    [
			        "href" => "https://x.com/" . ($ft["twitter"] ?? "AIEC_"),
			        "label" => "تويتر / إكس",
			        "bg" => "bg-gray-800 hover:bg-black",
			        "path" =>
			            "M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.742l7.74-8.855L1.254 2.25H8.08l4.26 5.632L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77z",
			    ],
			    [
			        "href" => "https://www.facebook.com/" . ($ft["facebook"] ?? "Alnada2021") . "/",
			        "label" => "فيسبوك",
			        "bg" => "bg-blue-600 hover:bg-blue-700",
			        "path" =>
			            "M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z",
			    ],
			    [
			        "href" => "https://wa.me/" . ($ft["whatsapp"] ?? "966559281924"),
			        "label" => "واتساب",
			        "bg" => "bg-green-600 hover:bg-green-700",
			        "path" =>
			            "M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z",
			    ],
			];
		@endphp
		<footer class="relative overflow-hidden bg-primary-950 text-white" aria-label="تذييل الموقع">

			{{-- Decorative blobs (subtle, reduced-motion respected) --}}
			<div class="pointer-events-none absolute inset-0" aria-hidden="true">
				<div class="blob -right-32 -top-32 h-96 w-96 bg-primary-800 opacity-30 motion-reduce:animate-none"></div>
				<div class="blob animation-delay-400 bottom-0 left-0 h-64 w-64 bg-gold-800 opacity-20 motion-reduce:animate-none">
				</div>
			</div>

			{{-- Wave separator --}}
			<div class="relative w-full overflow-hidden leading-none" aria-hidden="true">
				<svg class="block h-14 w-full" viewBox="0 0 1440 56" fill="none" xmlns="http://www.w3.org/2000/svg"
					preserveAspectRatio="none">
					<path
						d="M0 56L60 46.7C120 37 240 19 360 14C480 9 600 18.7 720 28C840 37 960 46.7 1080 46.7C1200 46.7 1320 37 1380 32.7L1440 28V0H1380C1320 0 1200 0 1080 0C960 0 840 0 720 0C600 0 480 0 360 0C240 0 120 0 60 0H0V56Z"
						fill="white" fill-opacity="0.04" />
				</svg>
			</div>

			<div class="relative z-10 mx-auto max-w-7xl px-4 pb-10 pt-8">

				{{-- Main grid: Brand | Quick Links | Programs | Contact --}}
				<div class="mb-12 grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-12">

					{{-- ── Brand ────────────────────────────────── --}}
					<div class="lg:col-span-4">
						{{-- Logo + name --}}
						<a class="group mb-5 inline-flex items-center gap-3" href="#home" aria-label="مدارس الندى - الصفحة الرئيسية">
							<div
								class="flex h-12 w-12 shrink-0 items-center justify-center overflow-hidden rounded-2xl bg-white shadow-clay transition-all duration-200 group-hover:shadow-clay-lg">
								<img class="h-auto w-10 object-contain" src="{{ asset("logo.svg") }}" alt="" aria-hidden="true">
							</div>
							<div class="leading-tight">
								<div class="font-heading text-lg font-bold text-white">مدارس الندى</div>
								<div class="text-xs text-primary-300">النموذجية الأهلية</div>
							</div>
						</a>

						{{-- Tagline --}}
						<p class="mb-6 max-w-xs text-sm leading-relaxed text-primary-300">
							رائدة في التربية الخاصة والدمج بالمدينة المنورة منذ عام 1429هـ —
							نُشكّل مستقبل أبنائنا بأيدٍ متخصصة وقلوب مخلصة.
						</p>

						{{-- Accreditation badge --}}
						<div
							class="bg-white/8 mb-6 inline-flex items-center gap-2 rounded-xl border border-white/15 px-3 py-1.5 text-xs text-primary-200">
							<svg class="h-3.5 w-3.5 text-gold-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
								<path
									d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
							</svg>
							معتمدة لدى وزارة التعليم
						</div>

						{{-- Social links --}}
						<div class="flex flex-wrap gap-2" role="list" aria-label="وسائل التواصل الاجتماعي">
							@foreach ($ftSocials as ["href" => $href, "label" => $label, "bg" => $bg, "path" => $path])
								<a
									class="{{ $bg }} flex h-9 w-9 items-center justify-center rounded-xl transition-all duration-200 hover:scale-110 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-gold-400 focus-visible:ring-offset-2 focus-visible:ring-offset-primary-950 active:scale-95 motion-reduce:transition-none"
									href="{{ $href }}" role="listitem" aria-label="{{ $label }} — مدارس الندى" target="_blank"
									rel="noopener noreferrer">
									<svg class="h-4 w-4 text-white" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
										<path d="{{ $path }}" />
									</svg>
								</a>
							@endforeach
						</div>
					</div>

					{{-- ── Quick Links ──────────────────────────── --}}
					<nav class="lg:col-span-2" aria-label="روابط سريعة">
						<h4 class="mb-5 font-heading text-sm font-bold uppercase tracking-widest text-white">
							روابط سريعة
						</h4>
						<ul class="space-y-2.5">
							@foreach ([["#home", "الرئيسية"], ["#about", "من نحن"], ["#programs", "برامجنا"], ["#stats", "إنجازاتنا"], ["#news", "الأخبار"], ["#contact", "تواصل معنا"]] as [$href, $label])
								<li>
									<a
										class="group inline-flex items-center gap-2 text-sm text-primary-300 transition-colors duration-150 hover:text-gold-400 focus-visible:text-gold-400 focus-visible:outline-none motion-reduce:transition-none"
										href="{{ $href }}">
										<svg
											class="rtl-flip h-3 w-3 shrink-0 text-primary-600 transition-colors duration-150 group-hover:text-gold-400 motion-reduce:transition-none"
											aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
										</svg>
										{{ $label }}
									</a>
								</li>
							@endforeach
						</ul>
					</nav>

					{{-- ── Programs ─────────────────────────────── --}}
					<nav class="lg:col-span-3" aria-label="برامجنا التعليمية">
						<h4 class="mb-5 font-heading text-sm font-bold uppercase tracking-widest text-white">
							برامجنا
						</h4>
						<ul class="space-y-2.5">
							@foreach (["التعليم العام", "التربية الخاصة", "برامج الدمج", "رياض الأطفال", "علاج النطق", "العلاج الوظيفي"] as $program)
								<li>
									<a
										class="group inline-flex items-center gap-2 text-sm text-primary-300 transition-colors duration-150 hover:text-gold-400 focus-visible:text-gold-400 focus-visible:outline-none motion-reduce:transition-none"
										href="#programs">
										<svg
											class="rtl-flip h-3 w-3 shrink-0 text-primary-600 transition-colors duration-150 group-hover:text-gold-400 motion-reduce:transition-none"
											aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
										</svg>
										{{ $program }}
									</a>
								</li>
							@endforeach
						</ul>
					</nav>

					{{-- ── Contact Info ─────────────────────────── --}}
					<address class="not-italic lg:col-span-3" aria-label="معلومات التواصل">
						<h4 class="mb-5 font-heading text-sm font-bold uppercase tracking-widest text-white">
							تواصل معنا
						</h4>
						<div class="space-y-4">

							{{-- Phone --}}
							<a class="group flex items-start gap-3 focus-visible:outline-none" href="{{ $ftTel }}" dir="ltr">
								<span
									class="bg-white/8 mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg border border-white/10 transition-colors duration-200 group-hover:border-primary-600 group-hover:bg-primary-700 motion-reduce:transition-none">
									<svg
										class="h-4 w-4 text-primary-300 transition-colors duration-200 group-hover:text-white motion-reduce:transition-none"
										aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
											d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
									</svg>
								</span>
								<span>
									<span class="mb-0.5 block text-xs text-primary-500" dir="rtl">الهاتف</span>
									<span
										class="text-sm font-medium text-primary-200 transition-colors duration-150 group-hover:text-white motion-reduce:transition-none">
										{{ $ftPhone }}
									</span>
								</span>
							</a>

							{{-- Email --}}
							<a class="group flex items-start gap-3 focus-visible:outline-none" href="mailto:{{ $ftEmail }}">
								<span
									class="bg-white/8 mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg border border-white/10 transition-colors duration-200 group-hover:border-primary-600 group-hover:bg-primary-700 motion-reduce:transition-none">
									<svg
										class="h-4 w-4 text-primary-300 transition-colors duration-200 group-hover:text-white motion-reduce:transition-none"
										aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
											d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
									</svg>
								</span>
								<span>
									<span class="mb-0.5 block text-xs text-primary-500">البريد الإلكتروني</span>
									<span
										class="break-all text-sm font-medium text-primary-200 transition-colors duration-150 group-hover:text-white motion-reduce:transition-none">
										{{ $ftEmail }}
									</span>
								</span>
							</a>

							{{-- Address --}}
							<div class="flex items-start gap-3">
								<span
									class="bg-white/8 mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg border border-white/10">
									<svg class="h-4 w-4 text-primary-300" aria-hidden="true" fill="none" stroke="currentColor"
										viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
											d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
											d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
									</svg>
								</span>
								<span>
									<span class="mb-0.5 block text-xs text-primary-500">العنوان</span>
									<span class="text-sm leading-relaxed text-primary-300">
										{{ $ftAddress }}
									</span>
								</span>
							</div>

							{{-- Hours --}}
							<div class="flex items-start gap-3">
								<span
									class="bg-white/8 mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg border border-white/10">
									<svg class="h-4 w-4 text-primary-300" aria-hidden="true" fill="none" stroke="currentColor"
										viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
											d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
									</svg>
								</span>
								<span>
									<span class="mb-0.5 block text-xs text-primary-500">ساعات العمل</span>
									<span class="text-sm text-primary-200">{{ $ftHours }}</span>
								</span>
							</div>

						</div>
					</address>
				</div>

				{{-- ── Divider ─────────────────────────────────── --}}
				<div class="border-white/8 border-t pt-7">
					<div class="flex flex-col items-center justify-between gap-4 text-xs text-primary-500 sm:flex-row">

						{{-- Copyright --}}
						<p>
							<span aria-label="حقوق الملكية">©</span>
							{{ date("Y") }} مدارس الندى النموذجية الأهلية. جميع الحقوق محفوظة.
						</p>

						{{-- Bottom links --}}
						<nav class="flex items-center gap-4" aria-label="روابط التذييل السفلي">
							<a
								class="transition-colors duration-150 hover:text-primary-300 focus-visible:text-gold-400 focus-visible:outline-none motion-reduce:transition-none"
								href="#">
								سياسة الخصوصية
							</a>
							<span class="text-primary-700" aria-hidden="true">|</span>
							<a
								class="transition-colors duration-150 hover:text-primary-300 focus-visible:text-gold-400 focus-visible:outline-none motion-reduce:transition-none"
								href="#">
								شروط الاستخدام
							</a>
							<span class="text-primary-700" aria-hidden="true">|</span>
							<a
								class="transition-colors duration-150 hover:text-primary-300 focus-visible:text-gold-400 focus-visible:outline-none motion-reduce:transition-none"
								href="{{ route("admin.login") }}">
								لوحة التحكم
							</a>
						</nav>

						{{-- Scroll top on mobile (bottom bar) - desktop uses floating btn --}}
						<button
							class="flex items-center gap-1.5 transition-colors duration-150 hover:text-primary-300 focus-visible:text-gold-400 focus-visible:outline-none motion-reduce:transition-none sm:hidden"
							aria-label="العودة لأعلى الصفحة" onclick="window.scrollTo({top:0,behavior:'smooth'})">
							<svg class="h-3.5 w-3.5" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
							</svg>
							أعلى الصفحة
						</button>

					</div>
				</div>

			</div>
		</footer>

		{{-- Floating utilities: back-to-top + admin shortcut --}}
		<div class="fixed bottom-6 left-6 z-40 flex flex-col-reverse items-center gap-3" x-data="backToTop">
			{{-- Back to top --}}
			<button
				class="flex h-12 w-12 items-center justify-center rounded-2xl bg-primary-500 text-white shadow-clay transition-all duration-200 hover:-translate-y-1 hover:bg-primary-600"
				aria-label="العودة لأعلى الصفحة" x-show="show" x-transition @click="scrollTop()">
				<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
				</svg>
			</button>

			{{-- Admin shortcut --}}
			<a
				class="flex h-12 w-12 items-center justify-center rounded-2xl border border-gray-200 bg-white/90 text-gray-600 shadow-card transition-all duration-200 hover:-translate-y-1 hover:border-primary-300 hover:bg-primary-50 hover:text-primary-700"
				href="{{ route("admin.login") }}" title="لوحة التحكم" aria-label="لوحة التحكم" x-show="show" x-transition>
				<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
						d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
				</svg>
			</a>
		</div>

	</div>{{-- #main-content --}}
@endsection
