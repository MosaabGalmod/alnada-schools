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
	@php
		$sectionLabels = config("navigation.section_labels", []);

		// Build nav from sections in DB order — only show_in_nav sections, skip hero (it's #home)
		$mainNavigation = $sections
		    ->filter(fn($s) => $s->show_in_nav && $s->type !== "hero")
		    ->sortBy("sort_order")
		    ->map(
		        fn($s) => [
		            "href" => "#" . $s->key,
		            "label" =>
		                $s->type === "custom" ? $s->content["title"] ?? $s->label : $sectionLabels[$s->type] ?? $s->label,
		        ],
		    )
		    ->values()
		    ->toArray();

		// Prepend static home link
		array_unshift($mainNavigation, ["href" => "#home", "label" => "الرئيسية"]);
	@endphp

	<main class="home-shell" id="main-content" role="main">
		<div class="pointer-events-none absolute inset-x-0 top-0 -z-10 overflow-hidden" aria-hidden="true">
			<div class="home-orb home-orb-primary"></div>
			<div class="home-orb home-orb-secondary"></div>
			<div class="home-grid-mask"></div>
		</div>

		{{-- ===== NAVBAR ===== --}}
		<header class="fixed inset-x-0 top-0 z-50 px-4 transition-all duration-300" x-data="navbar"
			@keydown.escape.window="mobileOpen = false" :class="scrolled ? 'glass shadow-lg py-3' : 'py-5 bg-transparent'">
			<div class="mx-auto flex max-w-7xl items-center justify-between">

				{{-- Logo --}}
				<a class="group flex items-center gap-3" href="#">
					<div
						class="logo-bg flex h-11 w-11 items-center justify-center overflow-hidden rounded-2xl bg-white shadow-clay transition-all group-hover:shadow-clay-lg">
						<img class="h-auto w-9 object-contain" src="{{ \App\Models\SiteSetting::logoUrl() }}" alt="شعار مدارس الندى">
					</div>
					<div class="leading-tight">
						<div class="font-heading text-base font-bold transition-colors"
							:class="scrolled ? (document.documentElement.classList.contains('dark') ? 'text-primary-100' : 'text-primary-800') :
							    'text-white'">
							{{ \App\Models\SiteSetting::get("nav_brand_line1", "مدارس الندى") }}</div>
						<div class="text-xs transition-colors"
							:class="scrolled ? (document.documentElement.classList.contains('dark') ? 'text-primary-300' : 'text-gray-500') :
							    'text-primary-100'">
							{{ \App\Models\SiteSetting::get("nav_brand_line2", "النموذجية الأهلية") }}
						</div>
					</div>
				</a>

				<nav class="hidden lg:block" aria-label="القائمة الرئيسية">
					<ul class="flex items-center gap-1">
						@foreach ($mainNavigation as $item)
							<li>
								<a
									class="cursor-pointer rounded-xl px-3 py-2 text-sm font-medium transition-all duration-150 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/70 focus-visible:ring-offset-1"
									href="{{ $item["href"] }}"
									:class="scrolled ? 'text-gray-600 hover:text-primary-700 hover:bg-primary-50 focus-visible:ring-primary-400' :
									    'text-white/90 hover:text-white hover:bg-white/10'">{{ $item["label"] }}</a>
							</li>
						@endforeach
					</ul>
				</nav>

				{{-- CTA --}}
				<div class="flex items-center gap-3">
					<a class="btn-primary hidden px-5 py-2.5 text-sm md:inline-flex" href="#contact">
						<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
						</svg>
						{{ \App\Models\SiteSetting::get("nav_cta_text", "سجّل الآن") }}
					</a>

					{{-- Dark Mode Toggle (3-state: auto → dark → light → auto) --}}
					<button class="dark-toggle" type="button" aria-label="تبديل الوضع الداكن" x-data="{
	    mode: localStorage.getItem('theme') ?? 'auto',
	    cycle() {
	        const html = document.documentElement;
	        const sysDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
	        if (this.mode === 'auto') {
	            if (sysDark) {
	                html.classList.remove('dark');
	                localStorage.setItem('theme', 'light');
	                this.mode = 'light';
	            } else {
	                html.classList.add('dark');
	                localStorage.setItem('theme', 'dark');
	                this.mode = 'dark';
	            }
	        } else if (this.mode === 'dark') {
	            html.classList.remove('dark');
	            localStorage.setItem('theme', 'light');
	            this.mode = 'light';
	        } else {
	            localStorage.removeItem('theme');
	            sysDark ? html.classList.add('dark') : html.classList.remove('dark');
	            this.mode = 'auto';
	        }
	    }
	}"
						x-on:click="cycle()"
						:aria-label="mode === 'auto' ? 'الوضع التلقائي' : mode === 'dark' ? 'الوضع الداكن' : 'الوضع الفاتح'"
						:class="scrolled ? 'text-gray-600 dark:text-gray-300' : 'text-white/80 hover:text-white'">
						{{-- أيقونة الشاشة (وضع auto) --}}
						<svg class="h-5 w-5" x-show="mode === 'auto'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
							stroke-width="1.8" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round"
								d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25A2.25 2.25 0 0 1 5.25 3h13.5A2.25 2.25 0 0 1 21 5.25Z" />
						</svg>
						{{-- أيقونة الشمس (وضع dark → اضغط للفاتح) --}}
						<svg class="h-5 w-5" x-show="mode === 'dark'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
							stroke-width="1.8" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round"
								d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
						</svg>
						{{-- أيقونة القمر (وضع light → اضغط للعودة auto) --}}
						<svg class="h-5 w-5" x-show="mode === 'light'" xmlns="http://www.w3.org/2000/svg" fill="none"
							viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round"
								d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
						</svg>
					</button>

					<button class="rounded-xl p-2 transition-colors lg:hidden" type="button" aria-controls="mobile-main-menu"
						aria-label="القائمة" :aria-expanded="mobileOpen.toString()" @click="mobileOpen = !mobileOpen"
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
			<nav class="glass mt-3 rounded-3xl p-4 shadow-xl lg:hidden" id="mobile-main-menu" aria-label="القائمة المحمولة"
				x-cloak x-show="mobileOpen" x-transition:enter="transition ease-out duration-200"
				x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
				x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
				x-transition:leave-end="opacity-0 -translate-y-2">
				@foreach ($mainNavigation as $item)
					<a
						class="mobile-nav-link rounded-2xl px-4 py-3 font-medium text-gray-700 transition-all hover:bg-primary-50 hover:text-primary-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary-400 dark:text-gray-200 dark:hover:bg-primary-900/30 dark:hover:text-primary-300"
						href="{{ $item["href"] }}" @click="mobileOpen=false">{{ $item["label"] }}</a>
				@endforeach
				<div class="border-t border-gray-100 pt-2 dark:border-gray-700/50">
					<a class="btn-primary mt-2 w-full justify-center"
						href="#contact">{{ \App\Models\SiteSetting::get("nav_cta_text", "سجّل الآن") }}</a>
				</div>
			</nav>
		</header>

		{{-- ===== DYNAMIC SECTIONS ===== --}}
		@foreach ($sections as $section)
			@include("sections._" . $section->type, [
				"section" => $section,
				"announcements" => $announcements ?? collect(),
			])
		@endforeach

	</main>{{-- #main-content --}}

	{{-- Back to top --}}
	<div class="fixed bottom-4 end-4 z-40" x-data="backToTop" x-cloak x-show="show"
		x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-3 scale-95"
		x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="transition ease-in duration-150"
		x-transition:leave-start="opacity-100 translate-y-0 scale-100"
		x-transition:leave-end="opacity-0 translate-y-3 scale-95">
		<button class="floating-action" type="button" aria-label="العودة إلى أعلى الصفحة" @click="scrollTop()">
			<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 15l7-7 7 7" />
			</svg>
		</button>
	</div>

	<x-footer />
@endsection
