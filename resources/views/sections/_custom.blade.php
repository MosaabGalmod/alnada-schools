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

$introTitle = trim((string) ($c["intro_card_title"] ?? ""));
$introBody  = trim((string) ($c["intro_card_body"] ?? ""));
$hasCard    = $introTitle !== "" || $introBody !== "";

// $sectionVars: pass admin-chosen colors; dark sections handle their own look via CSS
$sectionVars = "--custom-heading-color: {$section->headingColor()}; --custom-body-color: {$section->textColor()};";
@endphp

<section id="{{ $section->key }}"
	class="section custom-section"
	data-dark="{{ $isDark ? '1' : '0' }}"
	data-testid="custom-section"
	aria-labelledby="{{ $headingId }}"
	lang="ar" dir="rtl"
	style="{{ $section->bgCss() ?: '' }} {{ $sectionVars }}">
<div class="mx-auto max-w-5xl">
<div class="custom-shell">

{{-- ── Header ── --}}
<div class="custom-header">
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
<div class="custom-intro-icon">
<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
<path stroke-linecap="round" stroke-linejoin="round"
d="M12 3l2.65 5.37L20.5 9.2l-4.25 4.15 1 5.9L12 16.8l-5.25 2.45 1-5.9L3.5 9.2l5.85-.83L12 3Z" />
</svg>
</div>
@if ($introTitle !== "")
<p class="custom-intro-eyebrow">{{ $introTitle }}</p>
@endif
@if ($introBody !== "")
<p class="custom-intro-text">{{ $introBody }}</p>
@endif
</div>
@endif
</div>

{{-- ── Blocks ── --}}
@if ($blocks !== [])
<div class="custom-block-grid {{ $section->fontSizeClass() }}" data-testid="custom-blocks">
@foreach ($blocks as $block)
@php $blockType = $block["type"] ?? null; @endphp

@if ($blockType === "highlight")
<article class="custom-card custom-card-highlight" data-testid="custom-highlight">
<div class="custom-card-icon">
<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
<path stroke-linecap="round" stroke-linejoin="round"
d="m12 3 2.65 5.37L20.5 9.2l-4.25 4.15 1 5.9L12 16.8l-5.25 2.45 1-5.9L3.5 9.2l5.85-.83L12 3Z" />
</svg>
</div>
<p class="custom-highlight-text">{{ $block["text"] }}</p>
</article>

@elseif ($blockType === "bullets")
<article class="custom-card custom-card-bullets" data-testid="custom-bullets">
<div class="custom-card-bullets-header">
<div class="custom-card-icon">
<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
<path stroke-linecap="round" stroke-linejoin="round"
d="M9 6.75h10.5M9 12h10.5M9 17.25h10.5M4.75 6.75h.5v.5h-.5zM4.75 12h.5v.5h-.5zM4.75 17.25h.5v.5h-.5z" />
</svg>
</div>
<p>أبرز النقاط</p>
</div>
<ul class="custom-bullet-list" role="list">
@foreach ($block["items"] as $item)
<li>
<svg class="custom-bullet-check" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
</svg>
<span>{{ $item }}</span>
</li>
@endforeach
</ul>
</article>

@elseif ($blockType === "paragraph")
<article class="custom-card custom-card-paragraph" data-testid="custom-paragraph">
<div class="custom-card-icon">
<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 7.5h10.5M6.75 12h10.5M6.75 16.5h6.5" />
</svg>
</div>
<p>{!! nl2br(e($block["text"])) !!}</p>
</article>
@endif
@endforeach
</div>
@else
<p class="custom-empty-hint">لا يوجد محتوى بعد — أضف نصًا في حقل "المحتوى" من لوحة التحكم.</p>
@endif

</div>
</div>
</section>
