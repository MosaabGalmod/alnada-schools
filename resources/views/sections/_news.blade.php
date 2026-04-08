{{-- News / Announcements Section --}}
@php
	$c = $section->content ?? [];
	$items = ($announcements ?? collect())->values();
	$badgeAccentMap = [
	    "green" => ["#1fa576", "rgba(31, 165, 118, 0.16)", "#0f6f52"],
	    "gold" => ["#d8a22c", "rgba(216, 162, 44, 0.18)", "#8a5c06"],
	    "blue" => ["#2e86de", "rgba(46, 134, 222, 0.16)", "#16558e"],
	    "red" => ["#d84d63", "rgba(216, 77, 99, 0.16)", "#8f2236"],
	    "purple" => ["#8759d7", "rgba(135, 89, 215, 0.16)", "#54308e"],
	];
	$iconMap = [
	    "تسجيل" => "M12 4v16m8-8H4",
	    "فعاليات" => "M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z",
	    "أخبار" => "M19 11H5m14-4H5m14 8H9m10 10H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2z",
	];
	$defaultIcon = "M19 11H5m14-4H5m14 8H9m10 10H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2z";
	$toArabicRelativeTime = static fn($date) => $date ? $date->copy()->locale("ar")->diffForHumans() : "";
	$toArabicFullTime = static fn($date) => $date ? $date->copy()->locale("ar")->translatedFormat("l d F Y - h:i a") : "";
	$newsIntro = $c["subtitle"] ?? "موجز سريع لأحدث الإعلانات المدرسية والفعاليات المهمة.";
@endphp

<section class="section news-section" id="news" aria-labelledby="news-heading" aria-describedby="news-intro"
	data-section="news"
	style="{{ $section->bgCss() ?: "background: linear-gradient(135deg, #f0f9fd 0%, #daf1fa 100%);" }}" lang="ar"
	dir="rtl">
	<div class="mx-auto max-w-5xl">
		<div class="news-shell">

			{{-- Header --}}
			<div class="news-header">
				<div class="news-copy">
					@if (!empty($c["tag"]))
						<span class="section-tag mx-auto">{{ $c["tag"] }}</span>
					@endif
					<h2 class="section-title news-title" id="news-heading" style="color: {{ $section->headingColor() }}">
						{{ $c["title"] ?? "آخر الأخبار والإعلانات" }}
					</h2>
					<p class="section-desc news-intro" id="news-intro" style="color: {{ $section->textColor() }}">
						{{ $newsIntro }}
					</p>
				</div>

				@if ($items->isNotEmpty())
					<div class="news-summary" aria-label="ملخص الأخبار">
						<div class="news-summary-item">
							<span class="news-summary-label">إعلانات منشورة</span>
							<strong class="news-summary-value">{{ $items->count() }}</strong>
						</div>
						<div class="news-summary-item">
							<span class="news-summary-label">آخر تحديث</span>
							<strong class="news-summary-value" lang="ar" dir="rtl">
								{{ $toArabicRelativeTime($items->first()?->published_at ?? $items->first()?->created_at) }}
							</strong>
						</div>
					</div>
				@endif
			</div>

			{{-- Empty state --}}
			@if ($items->isEmpty())
				<div class="news-empty">
					<div class="news-empty-visual" aria-hidden="true">
						<div class="news-empty-ring"></div>
						<div class="news-empty-icon-wrap">
							<svg class="news-empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
									d="M19 7H5m14 5H8m11 5H5M7 3h10a2 2 0 012 2v14l-3.5-2.2L12 19l-3.5-2.2L5 19V5a2 2 0 012-2z" />
							</svg>
						</div>
					</div>
					<h3 class="news-empty-title">لا توجد أخبار منشورة حالياً</h3>
					<p class="news-empty-text">ترقبوا آخر المستجدات والفعاليات القادمة، وسيظهر هنا أحدث ما يهم الأسرة التعليمية فور
						نشره.</p>
				</div>
			@else
				{{-- Alternating zigzag list --}}
				<div class="news-zigzag" role="feed" aria-label="آخر الأخبار والإعلانات">
					@foreach ($items as $ann)
						@php
							$publishedAt = $ann->published_at ?? $ann->created_at;
							[$accent, $surface, $iconColor] = $badgeAccentMap[$ann->badge_color] ?? $badgeAccentMap["green"];
							$icon = $iconMap[$ann->category] ?? $defaultIcon;
							$isEven = $loop->even; // 0-indexed: first item = even(false)
						@endphp
						<article
							class="news-zitem clay-card {{ $loop->first ? "news-zitem--featured" : "" }} {{ $isEven ? "news-zitem--flip" : "" }}"
							role="article" aria-posinset="{{ $loop->iteration }}" aria-setsize="{{ $items->count() }}"
							aria-label="{{ $ann->title }}"
							style="--news-accent: {{ $accent }}; --news-icon-surface: {{ $surface }}; --news-icon-color: {{ $iconColor }};">

							{{-- Icon side --}}
							<div class="news-zitem-icon" aria-hidden="true">
								<div class="news-zitem-icon-ring">
									<svg class="news-icon-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="{{ $icon }}" />
									</svg>
								</div>
								@if ($loop->first)
									<span class="news-featured-badge">الأبرز</span>
								@endif
							</div>

							{{-- Content side --}}
							<div class="news-zitem-body">
								<div class="news-card-topline">
									<div class="flex flex-wrap items-center gap-2">
										<span class="badge {{ $ann->badge_label ?? "" }}">{{ $ann->category }}</span>
										@if ($loop->first)
											<span class="news-kicker">الخبر الأبرز</span>
										@endif
									</div>
									<time class="news-time" title="{{ $toArabicFullTime($publishedAt) }}"
										datetime="{{ $publishedAt->toIso8601String() }}" lang="ar" dir="rtl">
										{{ $toArabicRelativeTime($publishedAt) }}
									</time>
								</div>
								<h3 class="news-card-title {{ $loop->first ? "news-featured-title" : "" }}">{{ $ann->title }}</h3>
								<p class="news-card-text {{ $loop->first ? "news-featured-text" : "" }}">{{ $ann->body }}</p>
								<div class="news-card-footer">
									<span class="news-footer-note">إشعار مدرسي رسمي</span>
									<span class="news-footer-chip">{{ $ann->category }}</span>
								</div>
							</div>

							{{-- Accent bar --}}
							<span class="news-zitem-bar" aria-hidden="true"></span>
						</article>
					@endforeach
				</div>
			@endif

		</div>
	</div>
</section>
