<?php

use App\Models\Announcement;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;

new class extends Component
{
    use WithPagination;

    public bool $showForm = false;
    public ?int $editingId = null;

    #[Validate('required|string|max:200')]
    public string $title = '';

    #[Validate('required|string')]
    public string $body = '';

    #[Validate('required|string|max:50')]
    public string $category = 'عام';

    #[Validate('required|string')]
    public string $badge_color = 'green';

    public bool $is_published = true;

    public function openCreate(): void
    {
        $this->reset(['editingId','title','body','category','badge_color','is_published']);
        $this->is_published = true;
        $this->category = 'عام';
        $this->badge_color = 'green';
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $ann = Announcement::findOrFail($id);
        $this->editingId    = $id;
        $this->title        = $ann->title;
        $this->body         = $ann->body;
        $this->category     = $ann->category;
        $this->badge_color  = $ann->badge_color;
        $this->is_published = $ann->is_published;
        $this->showForm     = true;
    }

    public function save(): void
    {
        $this->validate();

        $data = [
            'title'        => $this->title,
            'body'         => $this->body,
            'category'     => $this->category,
            'badge_color'  => $this->badge_color,
            'is_published' => $this->is_published,
            'published_at' => $this->is_published ? now() : null,
        ];

        if ($this->editingId) {
            Announcement::findOrFail($this->editingId)->update($data);
        } else {
            Announcement::create($data);
        }

        $this->showForm = false;
        $this->reset(['editingId','title','body','category','badge_color']);
        $this->is_published = true;
        session()->flash('success', $this->editingId ? 'تم تحديث الإعلان.' : 'تم نشر الإعلان بنجاح.');
    }

    public function delete(int $id): void
    {
        Announcement::findOrFail($id)->delete();
        session()->flash('success', 'تم حذف الإعلان.');
    }

    public function togglePublish(int $id): void
    {
        $ann = Announcement::findOrFail($id);
        $ann->update(['is_published' => !$ann->is_published]);
    }
};
?>

<div class="space-y-5">
  @if(session('success'))
  <div class="bg-primary-50 border border-primary-200 text-primary-800 rounded-2xl px-4 py-3 flex items-center gap-3 text-sm">
    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    {{ session('success') }}
  </div>
  @endif

  {{-- Header --}}
  <div class="flex items-center justify-between">
    <div>
      <h2 class="font-heading font-bold text-gray-900">الإعلانات والأخبار</h2>
      <p class="text-gray-400 text-sm">إدارة الأخبار والإعلانات المعروضة على الموقع</p>
    </div>
    <button wire:click="openCreate" class="btn-primary text-sm py-2.5 px-5">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
      إعلان جديد
    </button>
  </div>

  {{-- Form Modal --}}
  @if($showForm)
  <div class="fixed inset-0 bg-black/40 backdrop-blur-sm z-50 flex items-center justify-center p-4" wire:click.self="$set('showForm', false)">
    <div class="bg-white rounded-4xl shadow-clay-lg w-full max-w-lg p-8 animate-fade-up">
      <div class="flex items-center justify-between mb-6">
        <h3 class="font-heading text-xl font-bold text-gray-900">{{ $editingId ? 'تعديل الإعلان' : 'إعلان جديد' }}</h3>
        <button wire:click="$set('showForm', false)" class="p-2 rounded-xl text-gray-400 hover:bg-gray-100 transition-colors">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
      </div>

      <form wire:submit="save" class="space-y-4">
        <div>
          <label class="form-label">عنوان الإعلان <span class="text-red-500">*</span></label>
          <input wire:model="title" type="text" class="form-input" placeholder="عنوان واضح ومختصر" />
          @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="grid grid-cols-2 gap-3">
          <div>
            <label class="form-label">التصنيف</label>
            <select wire:model="category" class="form-input">
              @foreach(['عام','تسجيل','فعاليات','إعلان هام','أخبار'] as $cat)
              <option value="{{ $cat }}">{{ $cat }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label class="form-label">لون الشارة</label>
            <select wire:model="badge_color" class="form-input">
              <option value="green">أخضر</option>
              <option value="gold">ذهبي</option>
              <option value="blue">أزرق</option>
              <option value="red">أحمر</option>
              <option value="purple">بنفسجي</option>
            </select>
          </div>
        </div>

        <div>
          <label class="form-label">محتوى الإعلان <span class="text-red-500">*</span></label>
          <textarea wire:model="body" rows="4" class="form-input resize-none" placeholder="اكتب تفاصيل الإعلان..."></textarea>
          @error('body')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-2xl">
          <button type="button" wire:click="$toggle('is_published')"
                  :class="{{ $is_published ? 'true' : 'false' }} ? 'bg-primary-700' : 'bg-gray-300'"
                  class="relative inline-flex w-12 h-6 rounded-full transition-colors duration-200 focus:outline-none">
            <span :class="{{ $is_published ? 'true' : 'false' }} ? 'translate-x-6' : 'translate-x-1'"
                  class="inline-block w-4 h-4 mt-1 bg-white rounded-full shadow transition-transform duration-200"></span>
          </button>
          <div>
            <div class="font-medium text-gray-900 text-sm">نشر الإعلان</div>
            <div class="text-gray-400 text-xs">{{ $is_published ? 'سيظهر على الموقع فوراً' : 'مسودة - لن يظهر على الموقع' }}</div>
          </div>
        </div>

        <div class="flex gap-3 pt-2">
          <button type="submit" class="btn-primary flex-1 justify-center" wire:loading.attr="disabled">
            <span wire:loading.remove>{{ $editingId ? 'حفظ التعديلات' : 'نشر الإعلان' }}</span>
            <span wire:loading>جارٍ الحفظ...</span>
          </button>
          <button type="button" wire:click="$set('showForm', false)"
                  class="flex-1 py-3 border-2 border-gray-200 text-gray-600 hover:bg-gray-50 font-semibold rounded-2xl transition-colors">
            إلغاء
          </button>
        </div>
      </form>
    </div>
  </div>
  @endif

  {{-- Table --}}
  <div class="bg-white rounded-3xl shadow-card overflow-hidden">
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="w-10">#</th>
            <th>العنوان</th>
            <th>التصنيف</th>
            <th>الحالة</th>
            <th>التاريخ</th>
            <th class="w-32">الإجراءات</th>
          </tr>
        </thead>
        <tbody>
          @forelse(Announcement::latest()->paginate(10) as $ann)
          <tr>
            <td class="text-gray-400 text-xs">{{ $ann->id }}</td>
            <td>
              <div class="font-semibold text-gray-900 text-sm">{{ $ann->title }}</div>
              <div class="text-gray-400 text-xs truncate max-w-xs">{{ Str::limit($ann->body, 60) }}</div>
            </td>
            <td><span class="badge badge-{{ $ann->badge_color }}">{{ $ann->category }}</span></td>
            <td>
              <button wire:click="togglePublish({{ $ann->id }})"
                      class="badge {{ $ann->is_published ? 'bg-primary-100 text-primary-700 hover:bg-primary-200' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }} cursor-pointer transition-colors">
                {{ $ann->is_published ? 'منشور' : 'مسودة' }}
              </button>
            </td>
            <td class="text-gray-400 text-xs">{{ $ann->created_at->format('Y/m/d') }}</td>
            <td>
              <div class="flex gap-2">
                <button wire:click="edit({{ $ann->id }})"
                        class="btn-sm bg-primary-50 text-primary-700 hover:bg-primary-100">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </button>
                <button wire:click="delete({{ $ann->id }})" wire:confirm="هل تريد حذف هذا الإعلان؟"
                        class="btn-sm bg-red-50 text-red-600 hover:bg-red-100">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </button>
              </div>
            </td>
          </tr>
          @empty
          <tr><td colspan="6" class="text-center py-12 text-gray-400">
            <svg class="w-10 h-10 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
            لا توجد إعلانات بعد
          </td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
