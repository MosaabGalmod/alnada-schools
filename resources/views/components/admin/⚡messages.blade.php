<?php

use App\Models\Message;
use App\Services\MessageService;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    public string $search = '';
    public string $filter = 'all'; // all | unread | read

    public function updatedSearch(): void { $this->resetPage(); }
    public function updatedFilter(): void { $this->resetPage(); }

    public function markRead(int $id): void
    {
        Message::findOrFail($id)->markAsRead();
    }

    public function markAllRead(): void
    {
        app(MessageService::class)->markAllRead();
        session()->flash('success', 'تم تعيين جميع الرسائل كمقروءة.');
    }

    public function delete(int $id): void
    {
        Message::findOrFail($id)->delete();
        session()->flash('success', 'تم حذف الرسالة.');
    }

    public function getMessagesProperty()
    {
        return Message::query()
            ->when($this->search, fn($q) => $q->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('phone', 'like', "%{$this->search}%")
                  ->orWhere('message', 'like', "%{$this->search}%");
            }))
            ->when($this->filter === 'unread', fn($q) => $q->unread())
            ->when($this->filter === 'read', fn($q) => $q->where('is_read', true))
            ->latestFirst()
            ->paginate(12);
    }
};
?>

<div class="space-y-5">
  @if(session('success'))
  <div class="bg-primary-50 border border-primary-200 text-primary-800 rounded-2xl px-4 py-3 text-sm flex items-center gap-2">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    {{ session('success') }}
  </div>
  @endif

  {{-- Header + Filters --}}
  <div class="flex flex-col md:flex-row md:items-center gap-4">
    <div class="flex-1">
      <h2 class="font-heading font-bold text-gray-900">رسائل التواصل</h2>
      <p class="text-gray-400 text-sm">الرسائل المرسلة عبر نموذج التواصل في الموقع</p>
    </div>
    <div class="flex gap-3">
      <div class="relative">
        <input wire:model.live.debounce.300ms="search" type="text"
               placeholder="بحث..." class="form-input pr-9 py-2 text-sm" />
        <svg class="w-4 h-4 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
      </div>
      <select wire:model.live="filter" class="form-input py-2 text-sm">
        <option value="all">الكل</option>
        <option value="unread">غير مقروءة</option>
        <option value="read">مقروءة</option>
      </select>
      <button wire:click="markAllRead" class="btn-sm bg-primary-50 text-primary-700 hover:bg-primary-100 whitespace-nowrap">
        تعيين الكل كمقروء
      </button>
    </div>
  </div>

  {{-- Messages Grid --}}
  <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse($this->messages as $msg)
    <div wire:key="msg-{{ $msg->id }}"
         class="bg-white rounded-3xl shadow-card p-5 border {{ $msg->is_read ? 'border-gray-100' : 'border-primary-200' }} hover:shadow-card-hover transition-all">
      <div class="flex items-start justify-between mb-3">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-600 to-primary-800 flex items-center justify-center text-white font-bold text-sm">
            {{ mb_substr($msg->name, 0, 1) }}
          </div>
          <div>
            <div class="font-semibold text-gray-900 text-sm flex items-center gap-1.5">
              {{ $msg->name }}
              @if(!$msg->is_read)<span class="w-2 h-2 bg-primary-500 rounded-full inline-block"></span>@endif
            </div>
            <div class="text-gray-400 text-xs">{{ $msg->created_at->format('Y/m/d - h:i A') }}</div>
          </div>
        </div>
        <div class="flex gap-1.5">
          @if(!$msg->is_read)
          <button wire:click="markRead({{ $msg->id }})" title="تعيين كمقروء"
                  class="p-1.5 rounded-lg text-primary-600 hover:bg-primary-50 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          </button>
          @endif
          <button wire:click="delete({{ $msg->id }})" wire:confirm="حذف هذه الرسالة؟" title="حذف"
                  class="p-1.5 rounded-lg text-red-500 hover:bg-red-50 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
          </button>
        </div>
      </div>

      @if($msg->subject)
      <div class="mb-2"><span class="badge badge-green text-xs">{{ $msg->subject }}</span></div>
      @endif

      <p class="text-gray-600 text-sm leading-relaxed mb-3">{{ $msg->message }}</p>

      <div class="pt-3 border-t border-gray-50 space-y-1">
        @if($msg->phone)
        <a href="tel:{{ $msg->phone }}" class="flex items-center gap-2 text-xs text-gray-500 hover:text-primary-700 transition-colors">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
          {{ $msg->phone }}
        </a>
        @endif
        @if($msg->email)
        <a href="mailto:{{ $msg->email }}" class="flex items-center gap-2 text-xs text-gray-500 hover:text-primary-700 transition-colors">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
          {{ $msg->email }}
        </a>
        @endif
      </div>
    </div>
    @empty
    <div class="col-span-3 text-center py-16 text-gray-400">
      <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
      لا توجد رسائل بعد
    </div>
    @endforelse
  </div>

  {{-- Pagination --}}
  @if($this->messages->hasPages())
  <div class="flex justify-center">{{ $this->messages->links() }}</div>
  @endif
</div>
