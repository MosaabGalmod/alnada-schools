{{-- News / Announcements Section --}}
@php $c = $section->content ?? []; @endphp
<section class="section" id="news"
	style="{{ $section->bgCss() ?: "background: linear-gradient(135deg,#f0f9fd 0%,#daf1fa 100%);" }}">
	<div class="mx-auto max-w-7xl">
		<div class="mb-14 text-center">
			@if (!empty($c["tag"]))
				<span class="section-tag mx-auto">{{ $c["tag"] }}</span>
			@endif
			<h2 class="section-title" style="color: {{ $section->headingColor() }}">{{ $c["title"] ?? "آخر الأخبار والإعلانات" }}
			</h2>
		</div>

		@if (($announcements ?? collect())->isEmpty())
			<div class="py-16 text-center">
				<div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-3xl bg-gray-100">
					<svg class="h-8 w-8 text-gray-400" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
							d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
					</svg>
				</div>
				<p class="font-medium text-gray-500">لا توجد أخبار أو إعلانات حالياً</p>
			</div>
		@else
			<div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
				@foreach ($announcements as $ann)
					<article class="clay-card group cursor-pointer">
						<div class="mb-3 flex items-center justify-between">
							<span class="badge badge-{{ $ann->badge_color }}">{{ $ann->category }}</span>
							<time class="text-xs text-gray-400"
								datetime="{{ $ann->created_at->toIso8601String() }}">{{ $ann->created_at->diffForHumans() }}</time>
						</div>
						<h3 class="mb-2 font-heading font-bold text-gray-900 transition-colors duration-200 group-hover:text-primary-700">
							{{ $ann->title }}</h3>
						<p class="line-clamp-3 text-sm leading-relaxed text-gray-500">{{ $ann->body }}</p>
					</article>
				@endforeach
			</div>
		@endif
	</div>
</section>
