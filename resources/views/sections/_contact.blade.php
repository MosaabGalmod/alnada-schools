{{-- Contact Section --}}
@php
	$c = $section->content ?? [];
	$settings = \App\Models\SiteSetting::all_settings();
	$presenter = new \App\View\Presenters\ContactSectionPresenter($settings);
	$cards = $presenter->infoCards();
	$socialLinks = $presenter->socialLinks();
	$title = trim((string) ($c["title"] ?? "نحن هنا لمساعدتك"));
	$subtitle = trim((string) ($c["subtitle"] ?? ""));
	$tag = trim((string) ($c["tag"] ?? ""));
@endphp

<section class="section contact-section" id="contact" data-testid="contact-section" aria-labelledby="contact-heading"
	style="{{ $section->bgCss() ?: "background: linear-gradient(135deg,#f0f9fd 0%,#daf1fa 100%);" }} {{ $section->isDark() || $section->headingColor() ? "--contact-heading-color: {$section->headingColor()}; --contact-body-color: {$section->textColor()};" : "" }}"
	lang="ar" dir="rtl">
	<div class="mx-auto max-w-7xl">
		<div class="contact-shell">
			<div class="contact-header text-center">
				@if ($tag !== "")
					<span class="section-tag contact-tag mx-auto">{{ $tag }}</span>
				@endif
				<h2 class="section-title contact-title" id="contact-heading" data-testid="contact-title">{{ $title }}</h2>
				@if ($subtitle !== "")
					<p class="section-desc contact-subtitle mx-auto" data-testid="contact-subtitle">{{ $subtitle }}</p>
				@endif
			</div>

			<div class="contact-layout">
				<div class="contact-info-column space-y-4" data-testid="contact-info-column">
					<div class="contact-intro-panel">
						<div class="contact-intro-copy">
							<p class="contact-kicker">{{ \App\Models\SiteSetting::get("contact_kicker", "جاهزون للاستماع") }}</p>
							<p class="contact-intro-title">
								{{ \App\Models\SiteSetting::get("contact_intro_title", "قنوات واضحة للتواصل مع الإدارة وفريق القبول.") }}</p>
							<p class="contact-intro-text">
								{{ \App\Models\SiteSetting::get("contact_intro_text", "اختر الوسيلة الأسرع لك، أو أرسل رسالتك مباشرة عبر النموذج وسنعود إليك في أقرب وقت.") }}
							</p>
						</div>
						<span class="contact-icon-shell contact-icon-shell-lg" data-contact-icon aria-hidden="true">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
								<path stroke-linecap="round" stroke-linejoin="round"
									d="M4.75 7.75h14.5M7.75 4.75v6M16.25 13.25H7.75m8.5 0a3.5 3.5 0 0 1 0 7H9.5a3.75 3.75 0 0 1 0-7h6.75Z" />
							</svg>
						</span>
					</div>

					<div class="contact-card-grid">
						@foreach ($cards as $card)
							@php($tagName = $card["href"] ? "a" : "article")
							<{{ $tagName }} class="contact-card {{ $card["surfaceClass"] }}" data-testid="{{ $card["testId"] }}"
								@if ($card["href"]) href="{{ $card["href"] }}" @endif>
								<span class="contact-icon-shell" data-contact-icon aria-hidden="true">
									<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
										<path stroke-linecap="round" stroke-linejoin="round" d="{{ $card["icon"] }}" />
									</svg>
								</span>
								<div class="contact-card-copy">
									<p class="contact-card-label">{{ $card["label"] }}</p>
									<p class="contact-card-value" @if (($card["meta"]["dir"] ?? "") !== "") dir="{{ $card["meta"]["dir"] }}" @endif>
										{{ $card["value"] }}</p>
								</div>
								</{{ $tagName }}>
						@endforeach
					</div>

					<div class="contact-map-card" data-testid="contact-map">
						<iframe class="block"
							src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3647.11!2d39.5657885!3d24.5084508!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15bdb9d2a3eee2d1%3A0x1cf494e6a0e0773a!2z2YXYr9Cw2LHYsyDYp9mE2YbYr9mdINin2YTZhtmH2YjYtNal2YrYqSDYp9mE2KPZh9mE2YrYqQ!5e0!3m2!1sar!2ssa!4v1712000000000!5m2!1sar!2ssa"
							title="موقع مدارس الندى" style="border:0;" width="100%" height="220" allowfullscreen="" loading="lazy"
							referrerpolicy="no-referrer-when-downgrade"></iframe>
					</div>

					<div class="contact-social-row" aria-label="وسائل التواصل الاجتماعي">
						@foreach ($socialLinks as $social)
							<a class="contact-social-link" data-testid="{{ $social["testId"] }}" href="{{ $social["href"] }}"
								aria-label="{{ $social["label"] }}" target="_blank" rel="noopener noreferrer">
								<span class="contact-social-shell {{ $social["gradient"] }} bg-gradient-to-br" data-contact-icon
									aria-hidden="true">
									<svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24">
										<path d="{{ $social["path"] }}" />
									</svg>
								</span>
							</a>
						@endforeach
					</div>
				</div>

				<div class="contact-form-column" data-testid="contact-form-column">
					<div class="contact-form-shell" data-testid="contact-form-shell">
						<div class="contact-form-header">
							<p class="contact-form-kicker">{{ \App\Models\SiteSetting::get("contact_form_kicker", "راسلنا مباشرة") }}</p>
							<h3 class="contact-form-title">{{ \App\Models\SiteSetting::get("contact_form_title", "أرسل لنا رسالة") }}</h3>
							<p class="contact-form-text">
								{{ \App\Models\SiteSetting::get("contact_form_text", "املأ النموذج وسيتابع فريق المدرسة طلبك أو استفسارك سريعًا.") }}
							</p>
						</div>
						@livewire("contact-form")
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
