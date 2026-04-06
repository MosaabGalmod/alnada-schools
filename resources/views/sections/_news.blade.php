{{-- News / Announcements Section --}}
@php $c = $section->content ?? []; @endphp
<section id="news" class="section" style="{{ $section->bgCss() ?: 'background: linear-gradient(135deg,#f0f9fd 0%,#daf1fa 100%);' }}">
  <div class="max-w-7xl mx-auto">
    <div class="text-center mb-14">
      @if(!empty($c['tag']))
      <span class="section-tag mx-auto">{{ $c['tag'] }}</span>
      @endif
      <h2 class="section-title" style="color: {{ $section->headingColor() }}">{{ $c['title'] ?? 'آخر الأخبار والإعلانات' }}</h2>
    </div>

    @if(($announcements ?? collect())->isEmpty())
    <div class="text-center py-16">
      <div class="w-16 h-16 bg-gray-100 rounded-3xl flex items-center justify-center mx-auto mb-4">
        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
      </div>
      <p class="text-gray-400 font-medium">لا توجد أخبار أو إعلانات حالياً</p>
    </div>
    @else
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($announcements as $ann)
      <div class="clay-card group">
        <div class="flex items-center justify-between mb-3">
          <span class="badge badge-{{ $ann->badge_color }}">{{ $ann->category }}</span>
          <span class="text-xs text-gray-400">{{ $ann->created_at->diffForHumans() }}</span>
        </div>
        <h3 class="font-heading font-bold text-gray-900 mb-2 group-hover:text-primary-700 transition-colors">{{ $ann->title }}</h3>
        <p class="text-gray-500 text-sm leading-relaxed line-clamp-3">{{ $ann->body }}</p>
      </div>
      @endforeach
    </div>
    @endif
  </div>
</section>
