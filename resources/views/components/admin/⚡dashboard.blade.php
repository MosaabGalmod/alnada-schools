<?php

use App\Models\Announcement;
use App\Models\Message;
use Livewire\Component;

new class extends Component
{
    public int $totalMessages = 0;
    public int $unreadMessages = 0;
    public int $totalAnnouncements = 0;
    public int $publishedAnnouncements = 0;

    public function mount(): void
    {
        $this->totalMessages          = Message::count();
        $this->unreadMessages         = Message::where('is_read', false)->count();
        $this->totalAnnouncements     = Announcement::count();
        $this->publishedAnnouncements = Announcement::where('is_published', true)->count();
    }
};
?>

<div class="space-y-6">
  {{-- Stats --}}
  <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
    @foreach([
      ['إجمالي الرسائل', $totalMessages, 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'from-blue-500 to-blue-700'],
      ['رسائل غير مقروءة', $unreadMessages, 'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9', 'from-red-500 to-red-700'],
      ['الإعلانات الكلية', $totalAnnouncements, 'M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z', 'from-primary-500 to-primary-700'],
      ['إعلانات منشورة', $publishedAnnouncements, 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'from-gold-500 to-gold-700'],
    ] as [$label, $value, $icon, $gradient])
    <div class="stat-card">
      <div class="w-12 h-12 rounded-2xl bg-gradient-to-br {{ $gradient }} flex items-center justify-center shrink-0 shadow-card">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $icon }}"/>
        </svg>
      </div>
      <div>
        <div class="text-2xl font-bold font-heading text-gray-900">{{ $value }}</div>
        <div class="text-gray-500 text-sm">{{ $label }}</div>
      </div>
    </div>
    @endforeach
  </div>

  {{-- Quick Links --}}
  <div class="grid md:grid-cols-3 gap-4">
    <a href="{{ route('admin.announcements') }}" class="card flex items-center gap-4 hover:border-primary-200 group">
      <div class="w-12 h-12 bg-primary-50 group-hover:bg-primary-100 rounded-2xl flex items-center justify-center transition-colors">
        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
      </div>
      <div><div class="font-semibold text-gray-900">إضافة إعلان</div><div class="text-gray-400 text-sm">نشر خبر على الموقع</div></div>
    </a>
    <a href="{{ route('admin.messages') }}" class="card flex items-center gap-4 hover:border-blue-200 group">
      <div class="w-12 h-12 bg-blue-50 group-hover:bg-blue-100 rounded-2xl flex items-center justify-center transition-colors">
        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
      </div>
      <div><div class="font-semibold text-gray-900">مراجعة الرسائل</div><div class="text-gray-400 text-sm">{{ $unreadMessages }} رسالة تنتظر</div></div>
    </a>
    <a href="{{ route('admin.settings') }}" class="card flex items-center gap-4 hover:border-gold-200 group">
      <div class="w-12 h-12 bg-gold-50 group-hover:bg-gold-100 rounded-2xl flex items-center justify-center transition-colors">
        <svg class="w-6 h-6 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
      </div>
      <div><div class="font-semibold text-gray-900">الإعدادات</div><div class="text-gray-400 text-sm">تعديل بيانات الموقع</div></div>
    </a>
  </div>

  {{-- Recent messages --}}
  @php $recentMessages = \App\Models\Message::latest()->take(5)->get(); @endphp
  @if($recentMessages->isNotEmpty())
  <div class="bg-white rounded-3xl shadow-card p-6">
    <div class="flex items-center justify-between mb-4">
      <h3 class="font-heading font-bold text-gray-900">آخر الرسائل</h3>
      <a href="{{ route('admin.messages') }}" class="text-primary-600 hover:text-primary-800 text-sm font-medium">عرض الكل</a>
    </div>
    <div class="space-y-3">
      @foreach($recentMessages as $msg)
      <div class="flex items-start gap-3 p-3 rounded-2xl {{ $msg->is_read ? 'bg-gray-50' : 'bg-primary-50/50 border border-primary-100' }}">
        <div class="w-9 h-9 rounded-xl bg-primary-100 flex items-center justify-center text-primary-700 font-bold text-sm shrink-0">{{ mb_substr($msg->name,0,1) }}</div>
        <div class="flex-1 min-w-0">
          <div class="flex items-center gap-2">
            <span class="font-semibold text-gray-900 text-sm">{{ $msg->name }}</span>
            @if(!$msg->is_read)<span class="w-2 h-2 bg-primary-500 rounded-full inline-block"></span>@endif
          </div>
          <p class="text-gray-500 text-xs truncate">{{ $msg->message }}</p>
        </div>
        <span class="text-xs text-gray-400 shrink-0">{{ $msg->created_at->diffForHumans() }}</span>
      </div>
      @endforeach
    </div>
  </div>
  @endif
</div>
