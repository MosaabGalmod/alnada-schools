{{-- Custom Section --}}
@php $c = $section->content ?? []; @endphp
<section class="section" style="{{ $section->bgCss() ?: 'background:#ffffff;' }}">
  <div class="max-w-7xl mx-auto">
    @if(!empty($c['tag']) || !empty($c['title']))
    <div class="text-center mb-14">
      @if(!empty($c['tag']))
      <span class="section-tag mx-auto">{{ $c['tag'] }}</span>
      @endif
      @if(!empty($c['title']))
      <h2 class="section-title" style="color: {{ $section->headingColor() }}">{{ $c['title'] }}</h2>
      @endif
      @if(!empty($c['subtitle']))
      <p class="section-desc mx-auto" style="color: {{ $section->textColor() }}">{{ $c['subtitle'] }}</p>
      @endif
    </div>
    @endif

    @if(!empty($c['body']))
    <div class="{{ $section->fontSizeClass() }} leading-relaxed text-center max-w-3xl mx-auto"
         style="color: {{ $section->textColor() }}">
      {!! nl2br(e($c['body'])) !!}
    </div>
    @endif
  </div>
</section>
