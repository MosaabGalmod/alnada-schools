<!DOCTYPE html>
<html class="scroll-smooth" lang="ar" dir="rtl">

	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>@yield("title", "لوحة التحكم") - مدارس الندى</title>
		{{-- Prevent dark-mode flash: apply saved theme before any render --}}
		<script>
			(function() {
				var t = localStorage.getItem('admin-theme');
				if (t === 'dark') document.documentElement.classList.add('dark');
			}());
		</script>
		@vite(["resources/css/app.css", "resources/js/app.js"])
		@livewireStyles
	</head>

	<body class="admin-body font-body antialiased">

		<div class="flex min-h-screen" x-data="adminLayout">

			{{-- ─── Sidebar ──────────────────────────────────────── --}}
			<aside class="admin-sidebar relative z-30 flex shrink-0 flex-col overflow-hidden transition-all duration-300"
				:class="sidebarOpen ? 'w-56' : 'w-0 lg:w-16'">

				{{-- Logo --}}
				<div class="admin-sidebar-header flex items-center gap-3 p-4">
					<div class="logo-bg flex h-10 w-10 shrink-0 items-center justify-center overflow-hidden rounded-2xl shadow-clay">
						<img class="h-auto w-8 object-contain" src="{{ \App\Models\SiteSetting::logoUrl() }}" alt="شعار مدارس الندى">
					</div>
					<div class="overflow-hidden" x-show="sidebarOpen" x-transition>
						<div class="font-heading text-sm font-bold leading-tight text-primary-700 dark:text-primary-300">مدارس الندى</div>
						<div class="text-xs text-gray-400 dark:text-gray-500">لوحة التحكم</div>
					</div>
				</div>

				{{-- Nav --}}
				<nav class="flex-1 space-y-0.5 overflow-y-auto p-2" aria-label="قائمة التنقل">
					@foreach ([
								["dashboard", "M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6", "الرئيسية", false],
								["announcements", "M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9", "الإعلانات", false],
								["messages", "M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z", "الرسائل", true],
								["sections", "M4 6h16M4 10h16M4 14h16M4 18h16", "الأقسام", false],
								["settings", "M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z", "الإعدادات", false],
								["policies", "M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z", "السياسات", false],
								["profile", "M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z", "الملف الشخصي", false],
				] as [$key, $icon, $label, $hasBadge])
						<a class="admin-nav-item {{ request()->routeIs("admin." . $key) ? "active" : "" }}"
							href="{{ route("admin." . $key) }}" title="{{ $label }}"
							aria-current="{{ request()->routeIs("admin." . $key) ? "page" : "false" }}">
							<span class="relative shrink-0">
								<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $icon }}" />
								</svg>
								@if ($hasBadge && ($unreadCount ?? 0) > 0)
									<span
										class="absolute -right-1.5 -top-1.5 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-[9px] font-bold leading-none text-white">
										{{ min($unreadCount, 9) }}{{ $unreadCount > 9 ? "+" : "" }}
									</span>
								@endif
							</span>
							<span class="flex-1 truncate text-sm" x-show="sidebarOpen" x-transition>{{ $label }}</span>
							@if ($hasBadge && ($unreadCount ?? 0) > 0)
								<span
									class="ml-auto min-w-[20px] rounded-full bg-red-500 px-1.5 py-0.5 text-center text-xs font-bold leading-none text-white"
									x-show="sidebarOpen" x-cloak>
									{{ $unreadCount }}
								</span>
							@endif
						</a>
					@endforeach
				</nav>

				{{-- Footer --}}
				<div class="admin-sidebar-footer space-y-0.5 p-2">
					<a class="admin-nav-item" href="{{ route("home") }}" title="عرض الموقع" target="_blank" rel="noopener noreferrer">
						<svg class="h-5 w-5 shrink-0 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor"
							viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
								d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
						</svg>
						<span class="truncate text-sm" x-show="sidebarOpen" x-transition>عرض الموقع</span>
					</a>
					<a class="admin-nav-item admin-nav-item--danger" href="{{ route("admin.logout") }}" title="تسجيل الخروج">
						<svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
								d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
						</svg>
						<span class="truncate text-sm" x-show="sidebarOpen" x-transition>تسجيل الخروج</span>
					</a>
				</div>
			</aside>

			{{-- ─── Main ─────────────────────────────────────────── --}}
			<div class="flex min-w-0 flex-1 flex-col overflow-hidden">

				{{-- Topbar --}}
				<header class="admin-topbar sticky top-0 z-20 flex items-center justify-between gap-3 px-4 py-3 lg:px-6">

					{{-- Right: toggle + breadcrumb --}}
					<div class="flex min-w-0 items-center gap-3">
						<button class="admin-icon-btn" @click="sidebarOpen = !sidebarOpen"
							:aria-label="sidebarOpen ? 'إغلاق القائمة الجانبية' : 'فتح القائمة الجانبية'">
							<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
							</svg>
						</button>
						<div class="min-w-0">
							<h1 class="admin-page-title truncate font-heading text-sm font-bold leading-tight">
								@yield("page-title", "لوحة التحكم")
							</h1>
							<p class="admin-page-desc truncate text-xs">
								@yield("page-desc", "نظرة عامة على الموقع")
							</p>
						</div>
					</div>

					{{-- Left: dark toggle + user info --}}
					<div class="flex shrink-0 items-center gap-2">

						{{-- Dark / light toggle --}}
						<button class="admin-icon-btn" @click="toggleDark()" :title="darkMode ? 'الوضع الفاتح' : 'الوضع الداكن'"
							:aria-label="darkMode ? 'تفعيل الوضع الفاتح' : 'تفعيل الوضع الداكن'">
							{{-- Moon — shown in light mode --}}
							<svg class="h-5 w-5" x-show="!darkMode" x-cloak fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
									d="M21 12.79A9 9 0 1111.21 3a7 7 0 009.79 9.79z" />
							</svg>
							{{-- Sun — shown in dark mode --}}
							<svg class="h-5 w-5" x-show="darkMode" x-cloak fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
									d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
							</svg>
						</button>

						{{-- Admin info --}}
						<div class="hidden text-end sm:block">
							<div class="admin-user-name text-sm font-semibold">المدير العام</div>
							<div class="admin-user-date text-xs">{{ now()->locale("ar")->isoFormat("dddd، D MMMM Y") }}</div>
						</div>
						<div
							class="flex h-9 w-9 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-primary-600 to-primary-800 text-sm font-bold text-white shadow-clay">
							م
						</div>
					</div>
				</header>

				{{-- Content --}}
				<main class="admin-main flex-1 overflow-y-auto p-4 lg:p-6">
					@yield("admin-content")
				</main>
			</div>
		</div>

		@livewireScripts
	</body>

</html>
