{{-- Stats Section --}}
@php
  $c     = $section->content ?? [];
  $items = $c['items'] ?? [];
  $icons = [
    'M12 14l9-5-9-5-9 5 9 5z',
    'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z',
    'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
    'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
    'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
  ];
  $cols = min(count($items) ?: 5, 5);
  $gridClass = match($cols) {
    2       => 'grid-cols-2',
    3       => 'grid-cols-2 lg:grid-cols-3',
    4       => 'grid-cols-2 lg:grid-cols-4',
    default => 'grid-cols-2 lg:grid-cols-5',
  };
@endphp
<section id="stats" class="section relative overflow-hidden" style="{{ $section->bgCss() }}">
  <div class="blob w-96 h-96 bg-primary-600 -top-20 -right-20 opacity-15"></div>
  <div class="blob w-64 h-64 bg-gold-500 bottom-0 left-0 animation-delay-400 opacity-10"></div>

  <div class="relative z-10 max-w-7xl mx-auto">
    <div class="text-center mb-14">
      @if(!empty($c['tag']))
      <span class="inline-flex items-center gap-2 px-5 py-2 bg-white/10 border border-white/25
                   rounded-full text-sm font-semibold mb-4 tracking-wide"
            style="color: {{ $section->textColor() }}">{{ $c['tag'] }}</span>
      @endif
      <h2 class="font-heading text-4xl md:text-5xl font-bold"
          style="color: {{ $section->headingColor() }}">{{ $c['title'] ?? 'أرقام تتحدث عن نجاحنا' }}</h2>
    </div>

    <div x-data="statsCounter" class="grid {{ $gridClass }} gap-5">
      @foreach($items as $i => $item)
      <div class="group relative bg-white/8 backdrop-blur border border-white/20
                  rounded-4xl p-6 text-center
                  hover:bg-white/15 hover:border-white/35 hover:-translate-y-1
                  transition-all duration-300">
        {{-- Icon --}}
        <div class="w-13 h-13 bg-white/15 rounded-2xl flex items-center justify-center
                    mx-auto mb-4 group-hover:scale-110 group-hover:bg-white/25
                    transition-all duration-300">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
               style="color: {{ $section->accentColor() }}">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="{{ $icons[$i % count($icons)] }}"/>
          </svg>
        </div>

        {{-- Number --}}
        <div class="font-heading text-5xl font-black mb-1 leading-none"
             style="color: {{ $section->headingColor() }}">
          <span class="counter" data-target="{{ $item['target'] ?? 0 }}">0</span>{{ $item['suffix'] ?? '' }}
        </div>

        {{-- Label --}}
        <div class="text-sm font-semibold mt-2 tracking-wide"
             style="color: {{ $section->textColor() }}">{{ $item['label'] ?? '' }}</div>
      </div>
      @endforeach
    </div>
  </div>
</section>
