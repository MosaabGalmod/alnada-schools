<!DOCTYPE html>
<html class="scroll-smooth" lang="ar" dir="rtl">

	<head>
		{{-- ===== Dark Mode: Immediate script to prevent FOUC ===== --}}
		<script>
			(function() {
				var s = localStorage.getItem('theme');
				var d = window.matchMedia('(prefers-color-scheme: dark)').matches;
				if (s === 'dark' || (s === null && d)) {
					document.documentElement.classList.add('dark');
				}
			})();
		</script>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		{{-- ===== SEO Meta ===== --}}
		<title>@yield("title", "مدارس الندى النموذجية الأهلية | التربية الخاصة والدمج - المدينة المنورة")</title>
		<meta name="description" content="@yield("meta_description", "مدارس الندى النموذجية الأهلية – مؤسسة تعليمية رائدة في التربية الخاصة والدمج بالمدينة المنورة منذ 1429هـ. نقدم برامج التوحد، صعوبات التعلم، العلاج الوظيفي، علاج النطق، ورياض الأطفال.")" />
		<meta name="keywords"
			content="مدارس الندى، التربية الخاصة، الدمج، المدينة المنورة، التوحد، صعوبات التعلم، علاج النطق، العلاج الوظيفي، مدارس أهلية" />
		<meta name="author" content="مدارس الندى النموذجية الأهلية" />
		<meta name="robots" content="index, follow" />
		<link href="{{ url()->current() }}" rel="canonical" />

		{{-- ===== Open Graph ===== --}}
		<meta property="og:type" content="website" />
		<meta property="og:locale" content="ar_SA" />
		<meta property="og:site_name" content="مدارس الندى النموذجية الأهلية" />
		<meta property="og:title" content="@yield("title", "مدارس الندى النموذجية الأهلية | التربية الخاصة والدمج")" />
		<meta property="og:description" content="@yield("meta_description", "مؤسسة تعليمية رائدة في التربية الخاصة والدمج بالمدينة المنورة منذ 1429هـ.")" />
		<meta property="og:url" content="{{ url()->current() }}" />
		<meta property="og:image" content="{{ asset("logo.png") }}" />
		<meta property="og:image:alt" content="شعار مدارس الندى النموذجية الأهلية" />

		{{-- ===== Twitter / X Card ===== --}}
		<meta name="twitter:card" content="summary" />
		<meta name="twitter:site" content="@AIEC_" />
		<meta name="twitter:title" content="@yield("title", "مدارس الندى النموذجية الأهلية")" />
		<meta name="twitter:description" content="@yield("meta_description", "مؤسسة تعليمية رائدة في التربية الخاصة والدمج بالمدينة المنورة.")" />
		<meta name="twitter:image" content="{{ asset("logo.png") }}" />

		{{-- ===== Favicon ===== --}}
		<link type="image/png" href="{{ asset("logo-sm.png") }}" rel="icon" />

		{{-- ===== Fonts (preconnect first for speed) ===== --}}
		<link href="https://fonts.googleapis.com" rel="preconnect" />
		<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />

		{{-- color-scheme meta for browser chrome --}}
		<meta name="color-scheme" content="light dark" />

		{{-- ===== Assets ===== --}}
		@vite(["resources/css/app.css", "resources/js/app.js"])
		@livewireStyles

		{{-- ===== JSON-LD Structured Data ===== --}}
		@yield("schema")
	</head>

	<body class="font-body antialiased transition-colors duration-300">

		{{-- Skip to main content (accessibility) --}}
		<a class="skip-link" href="#main-content">تخطى إلى المحتوى الرئيسي</a>

		@yield("content")

		@livewireScripts
	</body>

</html>
