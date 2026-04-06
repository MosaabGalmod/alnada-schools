{{-- Testimonials Section --}}
@php
  $c     = $section->content ?? [];
  $items = $c['items'] ?? [];
@endphp
<section id="testimonials" class="section" style="{{ $section->bgCss() ?: 'background:#ffffff;' }}">
  <div class="max-w-7xl mx-auto">
    <div class="text-center mb-14">
      @if(!empty($c['tag']))
      <span class="section-tag mx-auto">{{ $c['tag'] }}</span>
      @endif
      <h2 class="section-title" style="color: {{ $section->headingColor() }}">{{ $c['title'] ?? 'ماذا يقول آباؤنا وأمهاتنا' }}</h2>
    </div>
    <div class="grid md:grid-cols-3 gap-6">
      @foreach($items as $item)
      <div class="relative p-7 rounded-3xl border border-gray-100 bg-white
                  hover:shadow-card-hover hover:-translate-y-1 hover:border-primary-100
                  transition-all duration-300">
        {{-- Quote mark --}}
        <div class="absolute top-5 left-6 text-5xl font-heading text-primary-100 leading-none select-none">"</div>

        {{-- Stars (SVG) --}}
        <div class="flex gap-0.5 mb-4">
          @for($s = 0; $s < 5; $s++)
          <svg class="w-4 h-4 text-gold-400" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
          </svg>
          @endfor
        </div>

        <p class="text-gray-600 text-sm leading-loose mb-6 relative z-10">
          "{{ $item['text'] ?? '' }}"
        </p>

        <div class="flex items-center gap-3 pt-4 border-t border-gray-50">
          <div class="w-11 h-11 bg-gradient-to-br from-primary-500 to-primary-700
                      rounded-2xl flex items-center justify-center text-white font-bold text-sm shadow-clay">
            {{ mb_substr($item['avatar'] ?? $item['name'] ?? '?', 0, 2) }}
          </div>
          <div>
            <div class="font-semibold text-gray-900 text-sm">{{ $item['name'] ?? '' }}</div>
            <div class="text-gray-400 text-xs mt-0.5">{{ $item['role'] ?? '' }}</div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
