{{-- Custom Section --}}
@php
	use App\View\Presenters\CustomSectionPresenter;

	$c = $section->content ?? [];
	$blocks = CustomSectionPresenter::fromBody((string) ($c["body"] ?? ""))->blocks();
	$headingId = "custom-heading-" . $section->id;
	$title = trim((string) ($c["title"] ?? ""));
	$subtitle = trim((string) ($c["subtitle"] ?? ""));
	$tag = trim((string) ($c["tag"] ?? ""));
	$headingText = $title !== "" ? $title : $section->label;
	$isDark = $section->isDark();

	// Inject dark-mode CSS variables directly for dark/gradient sections
	$shellVars = "";
	if ($isDark) {
	    $shellVars =
	        "--custom-shell-bg: radial-gradient(circle at top right, rgba(14,165,233,0.18), transparent 30%), linear-gradient(180deg, rgba(15,23,42,0.96), rgba(15,23,42,0.90));" .
	        "--custom-shell-border: rgba(148,163,184,0.16);" .
	        "--custom-shell-shadow: 0 30px 70px rgba(2,6,23,0.45);" .
	        "--custom-tag-bg: rgba(14,165,233,0.2);" .
	        "--custom-tag-fg: #e0f2fe;" .
	        "--custom-title-fg: var(--custom-heading-color, #ffffff);" .
	        "--custom-copy-fg: var(--custom-body-color, rgba(226,232,240,0.92));" .
	        "--custom-card-bg: rgba(15,23,42,0.72);" .
	        "--custom-card-border: rgba(148,163,184,0.14);" .
	        "--custom-highlight-bg: linear-gradient(135deg, rgba(8,145,178,0.22), rgba(15,23,42,0.82));" .
	        "--custom-icon-bg: linear-gradient(135deg,#0f766e,#0284c7);" .
	        "--custom-icon-shadow: none;";
	}
@endphp

<section id="{{ $section->key }}" class="section custom-section" data-testid="custom-section" aria-labelledby="{{ $headingId }}"
	style="{{ $section->bgCss() ?: "background:#ffffff;" }} --custom-heading-color: {{ $section->headingColor() }}; --custom-body-color: {{ $section->textColor() }};"
	lang="ar" dir="rtl">
	<div class="mx-auto max-w-5xl">
		<div class="custom-shell" style="{{ $shellVars }}">
			<span class="sr-only">{{ $section->label }}</span>

			{{-- Header --}}
			@php
				$introTitle = trim((string) ($c["intro_card_title"] ?? ""));
				$introBody  = trim((string) ($c["intro_card_body"] ?? ""));
				$hasCard    = $introTitle !== "" || $introBody !== "";
			@endphp

			<div class="custom-header {{ $hasCard ? "" : "custom-header--no-card" }}">
				<div class="custom-header-copy">
					@if ($tag !== "")
						<span class="custom-tag">{{ $tag }}</span>
					@endif

					<h2 class="custom-title" id="{{ $headingId }}" data-testid="custom-title">
						{{ $headingText }}
					</h2>

					@if ($subtitle !== "")
						<p class="custom-subtitle" data-testid="custom-subtitle">{{ $subtitle }}</p>
					@endif
				</div>

				@if ($hasCard)
					<div class="custom-intro-card">
						<span class="custom-icon-shell" aria-hidden="true">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
								<path stroke-linecap="round" stroke-linejoin="round"
									d="M4.75 7.75h14.5M7.75 4.75v6M16.25 13.25H7.75m8.5 0a3.5 3.5 0 0 1 0 7H9.5a3.75 3.75 0 0 1 0-7h6.75Z" />
							</svg>
						</span>
						@if ($introTitle !== "")
							<p class="custom-intro-eyebrow">{{ $introTitle }}</p>
						@endif
						@if ($introBody !== "")
							<p class="custom-intro-text">{{ $introBody }}</p>
						@endif
					</div>
				@endif
			</div>

			{{-- Blocks --}}
			@if ($blocks !== [])
				<div class="custom-block-grid {{ $section->fontSizeClass() }}" data-testid="custom-blocks">
					@foreach ($blocks as $block)
						@php $blockType = $block["type"] ?? null; @endphp

						@if ($blockType === "highlight")
							<article class="custom-card custom-card-highlight" data-testid="custom-highlight">
								<span class="custom-icon-shell" aria-hidden="true">
									<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
										<path stroke-linecap="round" stroke-linejoin="round"
											d="m12 3 2.65 5.37L20.5 9.2l-4.25 4.15 1 5.9L12 16.8l-5.25 2.45 1-5.9L3.5 9.2l5.85-.83L12 3Z" />
									</svg>
								</span>
								<p class="custom-highlight-text">{{ $block["text"] }}</p>
							</article>

						@elseif ($blockType === "bullets")
							<article class="custom-card custom-card-bullets" data-testid="custom-bullets">
								<div class="custom-card-heading">
									<span class="custom-icon-shell" aria-hidden="true">
										<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
											<path stroke-linecap="round" stroke-linejoin="round"
												d="M9 6.75h10.5M9 12h10.5M9 17.25h10.5M4.75 6.75h.5v.5h-.5zM4.75 12h.5v.5h-.5zM4.75 17.25h.5v.5h-.5z" />
										</svg>
									</span>
									<p>أبرز النقاط</p>
								</div>
								<ul class="custom-bullet-list" role="list">
									@foreach ($block["items"] as $item)
										<li>
											<span class="custom-bullet-dot" aria-hidden="true"></span>
											<span>{{ $item }}</span>
										</li>
									@endforeach
								</ul>
							</article>

						@elseif ($blockType === "paragraph")
							<article class="custom-card custom-card-paragraph" data-testid="custom-paragraph">
								<span class="custom-icon-shell" aria-hidden="true">
									<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
										<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 7.5h10.5M6.75 12h10.5M6.75 16.5h6.5" />
									</svg>
								</span>
								<p>{!! nl2br(e($block["text"])) !!}</p>
							</article>
						@endif
					@endforeach
				</div>
			@else
				{{-- Empty body placeholder shown only in dev/preview --}}
				<p class="custom-empty-hint">لا يوجد محتوى بعد — أضف نصًا في حقل "المحتوى" من لوحة التحكم.</p>
			@endif
		</div>
	</div>
</section>
