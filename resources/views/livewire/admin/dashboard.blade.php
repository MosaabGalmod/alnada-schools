<div class="space-y-8">

	{{-- ── Stats Row ─────────────────────────────────────── --}}
	<div class="grid grid-cols-2 gap-4 lg:grid-cols-4">

		{{-- Announcements --}}
		<div class="stat-card group transition-all duration-200 hover:-translate-y-1 hover:shadow-card-hover">
			<div
				class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-primary-100 transition-colors duration-200 group-hover:bg-primary-700">
				<svg class="h-6 w-6 text-primary-700 transition-colors duration-200 group-hover:text-white" fill="none"
					stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
						d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
				</svg>
			</div>
			<div class="min-w-0">
				<div class="font-heading text-2xl font-bold leading-none text-gray-900">{{ $totalAnnouncements }}</div>
				<div class="mt-1 text-xs text-gray-500">إجمالي الإعلانات</div>
				<div class="mt-0.5 text-xs font-semibold text-primary-600">{{ $publishedAnnouncements }} منشور</div>
			</div>
		</div>

		{{-- Messages --}}
		<div class="stat-card group transition-all duration-200 hover:-translate-y-1 hover:shadow-card-hover">
			<div
				class="relative flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-gold-100 transition-colors duration-200 group-hover:bg-gold-600">
				<svg class="h-6 w-6 text-gold-700 transition-colors duration-200 group-hover:text-white" fill="none"
					stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
						d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
				</svg>
				@if ($unreadMessages > 0)
					<span
						class="absolute -left-1.5 -top-1.5 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-[10px] font-bold text-white">{{ $unreadMessages }}</span>
				@endif
			</div>
			<div class="min-w-0">
				<div class="font-heading text-2xl font-bold leading-none text-gray-900">{{ $totalMessages }}</div>
				<div class="mt-1 text-xs text-gray-500">إجمالي الرسائل</div>
				@if ($unreadMessages > 0)
					<div class="mt-0.5 text-xs font-semibold text-red-600">{{ $unreadMessages }} غير مقروء</div>
				@else
					<div class="mt-0.5 text-xs font-semibold text-green-600">جميعها مقروءة</div>
				@endif
			</div>
		</div>

		{{-- Sections --}}
		<div class="stat-card group transition-all duration-200 hover:-translate-y-1 hover:shadow-card-hover">
			<div
				class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-purple-100 transition-colors duration-200 group-hover:bg-purple-600">
				<svg class="h-6 w-6 text-purple-700 transition-colors duration-200 group-hover:text-white" fill="none"
					stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
				</svg>
			</div>
			<div class="min-w-0">
				<div class="font-heading text-2xl font-bold leading-none text-gray-900">{{ $visibleSections }}</div>
				<div class="mt-1 text-xs text-gray-500">أقسام مرئية</div>
				<div class="mt-0.5 text-xs font-semibold text-purple-600">من 8 أقسام</div>
			</div>
		</div>

		{{-- Quick Action --}}
		<a
			class="stat-card group cursor-pointer no-underline transition-all duration-200 hover:-translate-y-1 hover:shadow-card-hover"
			href="{{ route("home") }}" target="_blank">
			<div
				class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-green-100 transition-colors duration-200 group-hover:bg-green-600">
				<svg class="h-6 w-6 text-green-700 transition-colors duration-200 group-hover:text-white" fill="none"
					stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
						d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
				</svg>
			</div>
			<div class="min-w-0">
				<div class="text-sm font-bold leading-tight text-gray-900">عرض الموقع</div>
				<div class="mt-1 text-xs text-gray-500">فتح في نافذة جديدة</div>
				<div class="mt-0.5 text-xs font-semibold text-green-600">alnada-schools</div>
			</div>
		</a>
	</div>

	{{-- ── Quick Links ─────────────────────────────────────── --}}
	<div class="grid gap-4 md:grid-cols-3">
		<a
			class="group flex items-center gap-4 rounded-2xl border border-gray-50 bg-white p-5 shadow-card transition-all duration-200 hover:-translate-y-1 hover:shadow-card-hover"
			href="{{ route("admin.announcements") }}">
			<div
				class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary-100 transition-colors duration-200 group-hover:bg-primary-700">
				<svg class="h-5 w-5 text-primary-700 transition-colors group-hover:text-white" fill="none" stroke="currentColor"
					viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4" />
				</svg>
			</div>
			<div>
				<div class="text-sm font-semibold text-gray-900">إضافة إعلان جديد</div>
				<div class="text-xs text-gray-500">نشر خبر أو إعلان</div>
			</div>
			<svg class="mr-auto h-4 w-4 text-gray-300 transition-colors group-hover:text-primary-500" fill="none"
				stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
			</svg>
		</a>

		<a
			class="group flex items-center gap-4 rounded-2xl border border-gray-50 bg-white p-5 shadow-card transition-all duration-200 hover:-translate-y-1 hover:shadow-card-hover"
			href="{{ route("admin.sections") }}">
			<div
				class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-100 transition-colors duration-200 group-hover:bg-purple-600">
				<svg class="h-5 w-5 text-purple-700 transition-colors group-hover:text-white" fill="none" stroke="currentColor"
					viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
				</svg>
			</div>
			<div>
				<div class="text-sm font-semibold text-gray-900">تعديل أقسام الموقع</div>
				<div class="text-xs text-gray-500">المحتوى والمظهر</div>
			</div>
			<svg class="mr-auto h-4 w-4 text-gray-300 transition-colors group-hover:text-purple-500" fill="none"
				stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
			</svg>
		</a>

		<a
			class="group flex items-center gap-4 rounded-2xl border border-gray-50 bg-white p-5 shadow-card transition-all duration-200 hover:-translate-y-1 hover:shadow-card-hover"
			href="{{ route("admin.settings") }}">
			<div
				class="flex h-10 w-10 items-center justify-center rounded-xl bg-gray-100 transition-colors duration-200 group-hover:bg-gray-700">
				<svg class="h-5 w-5 text-gray-700 transition-colors group-hover:text-white" fill="none" stroke="currentColor"
					viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
						d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
				</svg>
			</div>
			<div>
				<div class="text-sm font-semibold text-gray-900">إعدادات الموقع</div>
				<div class="text-xs text-gray-500">معلومات التواصل والسوشيال</div>
			</div>
			<svg class="mr-auto h-4 w-4 text-gray-300 transition-colors group-hover:text-gray-500" fill="none"
				stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
			</svg>
		</a>
	</div>

	{{-- ── Recent Activity ─────────────────────────────────── --}}
	<div class="grid gap-6 lg:grid-cols-2">

		{{-- Recent Messages --}}
		<div class="overflow-hidden rounded-3xl border border-gray-50 bg-white shadow-card">
			<div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
				<h3 class="font-heading text-sm font-bold text-gray-900">آخر الرسائل</h3>
				<a class="text-xs font-semibold text-primary-600 transition-colors hover:text-primary-800"
					href="{{ route("admin.messages") }}">
					عرض الكل
				</a>
			</div>
			<div class="divide-y divide-gray-50">
				@forelse($recent as $msg)
					<div class="{{ $msg->is_read ? "" : "bg-primary-50/40" }} flex items-start gap-3 px-6 py-4">
						<div
							class="{{ $msg->is_read ? "bg-gray-100" : "bg-primary-100" }} {{ $msg->is_read ? "text-gray-500" : "text-primary-700" }} flex h-8 w-8 shrink-0 items-center justify-center rounded-xl text-xs font-bold">
							{{ mb_substr($msg->name, 0, 1) }}
						</div>
						<div class="min-w-0 flex-1">
							<div class="flex items-center justify-between gap-2">
								<span class="truncate text-sm font-semibold text-gray-900">{{ $msg->name }}</span>
								@if (!$msg->is_read)
									<span class="h-2 w-2 shrink-0 rounded-full bg-primary-500"></span>
								@endif
							</div>
							<p class="mt-0.5 truncate text-xs text-gray-500">{{ $msg->subject ?: $msg->message }}</p>
							<p class="mt-1 text-[10px] text-gray-400">{{ $msg->created_at->diffForHumans() }}</p>
						</div>
					</div>
				@empty
					<div class="px-6 py-10 text-center text-sm text-gray-400">لا توجد رسائل بعد</div>
				@endforelse
			</div>
		</div>

		{{-- Latest Announcements --}}
		<div class="overflow-hidden rounded-3xl border border-gray-50 bg-white shadow-card">
			<div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
				<h3 class="font-heading text-sm font-bold text-gray-900">آخر الإعلانات</h3>
				<a class="text-xs font-semibold text-primary-600 transition-colors hover:text-primary-800"
					href="{{ route("admin.announcements") }}">
					إدارة
				</a>
			</div>
			<div class="divide-y divide-gray-50">
				@forelse($latestAnnouncements as $ann)
					<div class="flex items-center gap-3 px-6 py-4">
						<span class="badge {{ $ann->badgeLabel }}">{{ $ann->category }}</span>
						<div class="min-w-0 flex-1">
							<p class="truncate text-sm font-medium text-gray-800">{{ $ann->title }}</p>
							<p class="mt-0.5 text-[10px] text-gray-400">{{ $ann->published_at?->diffForHumans() ?? "غير منشور" }}</p>
						</div>
						<div class="shrink-0">
							@if ($ann->is_published)
								<span class="rounded-full bg-green-100 px-2 py-0.5 text-[10px] font-semibold text-green-700">منشور</span>
							@else
								<span class="rounded-full bg-gray-100 px-2 py-0.5 text-[10px] font-semibold text-gray-500">مسودة</span>
							@endif
						</div>
					</div>
				@empty
					<div class="px-6 py-10 text-center text-sm text-gray-400">لا توجد إعلانات بعد</div>
				@endforelse
			</div>
		</div>
	</div>

</div>
