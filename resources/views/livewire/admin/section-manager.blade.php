<div>
  {{-- Flash --}}
  @if($flashMsg)
  <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3500)"
       x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
       class="mb-4 px-4 py-3 rounded-2xl text-sm font-medium flex items-center gap-2
              {{ $flashType === 'error' ? 'bg-red-50 text-red-700 border border-red-200' : 'bg-primary-50 text-primary-700 border border-primary-200' }}">
    @if($flashType === 'error')
      <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    @else
      <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    @endif
    {{ $flashMsg }}
  </div>
  @endif

  {{-- Header --}}
  <div class="flex items-center justify-between mb-6">
    <div>
      <h2 class="font-heading text-xl font-bold text-gray-900">إدارة أقسام الموقع</h2>
      <p class="text-sm text-gray-500 mt-0.5">رتّب وعدّل ظهور وأقسام الصفحة الرئيسية</p>
    </div>
    <button wire:click="openAddModal" class="btn-primary text-sm">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
      إضافة قسم
    </button>
  </div>

  {{-- Sections table --}}
  <div class="bg-white rounded-3xl shadow-card border border-gray-50 overflow-hidden">
    <table class="data-table w-full">
      <thead>
        <tr>
          <th class="w-8">#</th>
          <th>القسم</th>
          <th>النوع</th>
          <th>الحالة</th>
          <th class="text-center">الترتيب</th>
          <th class="text-center">الإجراءات</th>
        </tr>
      </thead>
      <tbody>
        @foreach($sections as $i => $sec)
        <tr wire:key="sec-{{ $sec['id'] }}">
          <td class="text-gray-400 text-xs font-mono">{{ $sec['sort_order'] }}</td>
          <td>
            <div class="font-semibold text-gray-800 text-sm">{{ $sec['label'] }}</div>
            <div class="text-xs text-gray-400 font-mono">{{ $sec['key'] }}</div>
          </td>
          <td>
            <span class="badge
              {{ match($sec['type']) {
                  'hero'         => 'badge-green',
                  'about'        => 'badge-blue',
                  'programs'     => 'badge-purple',
                  'stats'        => 'badge-gold',
                  'why_us'       => 'badge-green',
                  'news'         => 'badge-blue',
                  'testimonials' => 'badge-purple',
                  'contact'      => 'badge-gold',
                  default        => 'bg-gray-100 text-gray-700',
              } }}">{{ $sec['type'] }}</span>
          </td>
          <td>
            <button wire:click="toggleVisibility({{ $sec['id'] }})"
                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold transition-all
                           {{ $sec['is_visible'] ? 'bg-primary-100 text-primary-700 hover:bg-primary-200' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">
              @if($sec['is_visible'])
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                ظاهر
              @else
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                مخفي
              @endif
            </button>
          </td>
          <td>
            <div class="flex items-center justify-center gap-1">
              <button wire:click="moveUp({{ $sec['id'] }})" class="w-7 h-7 rounded-lg bg-gray-100 hover:bg-primary-100 text-gray-500 hover:text-primary-700 flex items-center justify-center transition-all" title="تحريك لأعلى">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
              </button>
              <button wire:click="moveDown({{ $sec['id'] }})" class="w-7 h-7 rounded-lg bg-gray-100 hover:bg-primary-100 text-gray-500 hover:text-primary-700 flex items-center justify-center transition-all" title="تحريك لأسفل">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
              </button>
            </div>
          </td>
          <td>
            <div class="flex items-center justify-center gap-2">
              {{-- Edit content --}}
              <button wire:click="openEditModal({{ $sec['id'] }})"
                      class="btn-sm bg-primary-50 text-primary-700 hover:bg-primary-100" title="تعديل المحتوى">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                المحتوى
              </button>
              {{-- Edit style --}}
              <button wire:click="openStyleModal({{ $sec['id'] }})"
                      class="btn-sm bg-gold-100 text-gold-700 hover:bg-gold-200" title="تعديل الأنماط">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                الأنماط
              </button>
              {{-- Delete (custom only) --}}
              @if($sec['type'] === 'custom')
              <button wire:click="deleteSection({{ $sec['id'] }})"
                      wire:confirm="هل أنت متأكد من حذف هذا القسم؟"
                      class="btn-sm bg-red-50 text-red-600 hover:bg-red-100" title="حذف">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
              </button>
              @endif
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {{-- ========== EDIT CONTENT MODAL ========== --}}
  @if($showEditModal)
  <div class="fixed inset-0 z-50 flex items-start justify-center pt-16 px-4"
       x-data x-init="$el.querySelector('[data-backdrop]').addEventListener('click', () => $wire.set('showEditModal', false))">
    {{-- Backdrop --}}
    <div data-backdrop class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>

    <div class="relative bg-white rounded-4xl shadow-clay-lg w-full max-w-2xl max-h-[80vh] flex flex-col">
      {{-- Header --}}
      <div class="flex items-center justify-between p-6 border-b border-gray-100">
        <h3 class="font-heading text-lg font-bold text-gray-900">تعديل محتوى القسم</h3>
        <button wire:click="$set('showEditModal', false)" class="w-8 h-8 rounded-xl bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition-colors">
          <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
      </div>

      {{-- Body --}}
      <div class="overflow-y-auto p-6 space-y-4 flex-1">
        {{-- Label --}}
        <div>
          <label class="form-label">اسم القسم في لوحة التحكم</label>
          <input wire:model="editLabel" type="text" class="form-input" placeholder="مثال: قسم الترحيب">
        </div>

        @php
          $section = collect($sections)->firstWhere('id', $editingId);
          $fields  = $section ? $this->getFieldsForType($section['type']) : [];
          $fieldLabels = [
            'badge'              => 'شارة (Badge)',
            'title'              => 'العنوان الرئيسي',
            'title_accent'       => 'العنوان المميز (بلون مختلف)',
            'subtitle'           => 'النص الفرعي',
            'body'               => 'النص الرئيسي',
            'body1'              => 'الفقرة الأولى',
            'body2'              => 'الفقرة الثانية',
            'tag'                => 'تاج القسم (فوق العنوان)',
            'cta_primary'        => 'نص زر الدعوة الأول',
            'cta_secondary'      => 'نص زر الدعوة الثاني',
            'founding_year'      => 'سنة التأسيس (هجري)',
            'vision_title'       => 'عنوان الرؤية',
            'vision_body'        => 'نص الرؤية',
            'mission_title'      => 'عنوان الرسالة',
            'mission_body'       => 'نص الرسالة',
            'values_title'       => 'عنوان القيم',
            'values_body'        => 'نص القيم',
            'accessibility_note' => 'ملاحظة إمكانية الوصول',
          ];
        @endphp

        @foreach($fields as $field)
        <div>
          <label class="form-label">{{ $fieldLabels[$field] ?? $field }}</label>
          @if(in_array($field, ['body','body1','body2','subtitle','vision_body','mission_body','values_body','accessibility_note']))
          <textarea wire:model="editContent.{{ $field }}" rows="3" class="form-input resize-none" placeholder="{{ $fieldLabels[$field] ?? $field }}"></textarea>
          @else
          <input wire:model="editContent.{{ $field }}" type="text" class="form-input" placeholder="{{ $fieldLabels[$field] ?? $field }}">
          @endif
        </div>
        @endforeach

        {{-- Complex fields note --}}
        @if(in_array($section['type'] ?? '', ['programs','stats','testimonials','why_us']))
        <div class="p-4 bg-gold-50 border border-gold-200 rounded-2xl text-sm text-gold-800">
          <svg class="w-4 h-4 inline ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          العناصر المتعددة (برامج، إحصائيات، آراء، مميزات) تُعدّل من قاعدة البيانات مباشرة حالياً. سيتوفر محرر متقدم قريباً.
        </div>
        @endif
      </div>

      {{-- Footer --}}
      <div class="p-6 border-t border-gray-100 flex gap-3 justify-end">
        <button wire:click="$set('showEditModal', false)" class="btn-sm bg-gray-100 text-gray-700 hover:bg-gray-200 px-5 py-2.5">إلغاء</button>
        <button wire:click="saveContent" class="btn-primary text-sm">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
          حفظ التغييرات
        </button>
      </div>
    </div>
  </div>
  @endif

  {{-- ========== STYLE MODAL ========== --}}
  @if($showStyleModal)
  <div class="fixed inset-0 z-50 flex items-start justify-center pt-16 px-4"
       x-data x-init="$el.querySelector('[data-backdrop]').addEventListener('click', () => $wire.set('showStyleModal', false))">
    <div data-backdrop class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>

    <div class="relative bg-white rounded-4xl shadow-clay-lg w-full max-w-xl max-h-[80vh] flex flex-col">
      <div class="flex items-center justify-between p-6 border-b border-gray-100">
        <h3 class="font-heading text-lg font-bold text-gray-900">تعديل أنماط القسم</h3>
        <button wire:click="$set('showStyleModal', false)" class="w-8 h-8 rounded-xl bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition-colors">
          <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
      </div>

      <div class="overflow-y-auto p-6 space-y-5 flex-1">
        {{-- Background type --}}
        <div>
          <label class="form-label">نوع الخلفية</label>
          <select wire:model.live="editStyle.bg_type" class="form-input">
            <option value="white">أبيض (افتراضي)</option>
            <option value="wave">متدرج فاتح (موجة)</option>
            <option value="gradient">متدرج مخصص</option>
            <option value="solid">لون صلب</option>
            <option value="dark">داكن</option>
          </select>
        </div>

        {{-- Gradient colors --}}
        @if(($editStyle['bg_type'] ?? 'white') === 'gradient')
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="form-label">لون البداية</label>
            <div class="flex gap-2">
              <input type="color" wire:model.live="editStyle.bg_from" class="h-10 w-14 rounded-xl border border-gray-200 cursor-pointer p-0.5">
              <input type="text" wire:model.live="editStyle.bg_from" class="form-input flex-1 font-mono text-sm" placeholder="#061f2c">
            </div>
          </div>
          <div>
            <label class="form-label">لون النهاية</label>
            <div class="flex gap-2">
              <input type="color" wire:model.live="editStyle.bg_to" class="h-10 w-14 rounded-xl border border-gray-200 cursor-pointer p-0.5">
              <input type="text" wire:model.live="editStyle.bg_to" class="form-input flex-1 font-mono text-sm" placeholder="#1a9dc6">
            </div>
          </div>
        </div>
        @endif

        {{-- Solid color --}}
        @if(($editStyle['bg_type'] ?? 'white') === 'solid')
        <div>
          <label class="form-label">لون الخلفية</label>
          <div class="flex gap-2">
            <input type="color" wire:model.live="editStyle.bg_color" class="h-10 w-14 rounded-xl border border-gray-200 cursor-pointer p-0.5">
            <input type="text" wire:model.live="editStyle.bg_color" class="form-input flex-1 font-mono text-sm" placeholder="#ffffff">
          </div>
        </div>
        @endif

        {{-- Text colors --}}
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="form-label">لون العنوان</label>
            <div class="flex gap-2">
              <input type="color" wire:model.live="editStyle.heading_color" class="h-10 w-14 rounded-xl border border-gray-200 cursor-pointer p-0.5">
              <input type="text" wire:model.live="editStyle.heading_color" class="form-input flex-1 font-mono text-sm">
            </div>
          </div>
          <div>
            <label class="form-label">لون النص</label>
            <div class="flex gap-2">
              <input type="color" wire:model.live="editStyle.text_color" class="h-10 w-14 rounded-xl border border-gray-200 cursor-pointer p-0.5">
              <input type="text" wire:model.live="editStyle.text_color" class="form-input flex-1 font-mono text-sm">
            </div>
          </div>
        </div>

        {{-- Accent color --}}
        <div>
          <label class="form-label">اللون المميز (Accent)</label>
          <div class="flex gap-2">
            <input type="color" wire:model.live="editStyle.accent_color" class="h-10 w-14 rounded-xl border border-gray-200 cursor-pointer p-0.5">
            <input type="text" wire:model.live="editStyle.accent_color" class="form-input flex-1 font-mono text-sm" placeholder="#1a9dc6">
          </div>
        </div>

        {{-- Font size --}}
        <div>
          <label class="form-label">حجم الخط</label>
          <select wire:model.live="editStyle.font_size" class="form-input">
            <option value="normal">عادي (افتراضي)</option>
            <option value="large">كبير</option>
            <option value="small">صغير</option>
          </select>
        </div>

        {{-- Live preview --}}
        <div class="rounded-2xl overflow-hidden border border-gray-200">
          <div class="px-3 py-1.5 bg-gray-50 border-b border-gray-200 text-xs font-semibold text-gray-500">معاينة مباشرة</div>
          <div class="p-6 text-center" style="
            {{ match($editStyle['bg_type'] ?? 'white') {
              'gradient' => 'background: linear-gradient(150deg, ' . ($editStyle['bg_from'] ?? '#061f2c') . ' 0%, ' . ($editStyle['bg_to'] ?? '#1a9dc6') . ' 100%)',
              'solid'    => 'background-color: ' . ($editStyle['bg_color'] ?? '#ffffff'),
              'wave'     => 'background: linear-gradient(135deg,#f0f9fd 0%,#daf1fa 100%)',
              'dark'     => 'background: linear-gradient(150deg,#061f2c 0%,#0d4858 100%)',
              default    => 'background:#ffffff',
            } }}">
            <p class="font-heading font-bold text-lg mb-1" style="color: {{ $editStyle['heading_color'] ?? '#111827' }}">عنوان القسم</p>
            <p class="text-sm" style="color: {{ $editStyle['text_color'] ?? '#374151' }}">نص توضيحي للقسم</p>
            <span class="inline-block mt-2 px-3 py-1 rounded-full text-xs font-semibold" style="background: {{ $editStyle['accent_color'] ?? '#1a9dc6' }}20; color: {{ $editStyle['accent_color'] ?? '#1a9dc6' }}">تاج القسم</span>
          </div>
        </div>
      </div>

      <div class="p-6 border-t border-gray-100 flex gap-3 justify-end">
        <button wire:click="$set('showStyleModal', false)" class="btn-sm bg-gray-100 text-gray-700 hover:bg-gray-200 px-5 py-2.5">إلغاء</button>
        <button wire:click="saveStyle" class="btn-primary text-sm">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
          حفظ الأنماط
        </button>
      </div>
    </div>
  </div>
  @endif

  {{-- ========== ADD SECTION MODAL ========== --}}
  @if($showAddModal)
  <div class="fixed inset-0 z-50 flex items-center justify-center px-4"
       x-data x-init="$el.querySelector('[data-backdrop]').addEventListener('click', () => $wire.set('showAddModal', false))">
    <div data-backdrop class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>

    <div class="relative bg-white rounded-4xl shadow-clay-lg w-full max-w-md p-6">
      <div class="flex items-center justify-between mb-6">
        <h3 class="font-heading text-lg font-bold text-gray-900">إضافة قسم جديد</h3>
        <button wire:click="$set('showAddModal', false)" class="w-8 h-8 rounded-xl bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition-colors">
          <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
      </div>

      <div class="space-y-4">
        <div>
          <label class="form-label">اسم القسم <span class="text-red-500">*</span></label>
          <input wire:model="newLabel" type="text" class="form-input" placeholder="مثال: قسم خاص بالأنشطة"
                 wire:keydown.enter="createSection" autofocus>
          @error('newLabel') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <p class="text-xs text-gray-400">سيُنشأ قسم مخصص من نوع "custom" يمكنك تعديل محتواه وأنماطه بعد الإنشاء.</p>
      </div>

      <div class="flex gap-3 justify-end mt-6">
        <button wire:click="$set('showAddModal', false)" class="btn-sm bg-gray-100 text-gray-700 hover:bg-gray-200 px-5 py-2.5">إلغاء</button>
        <button wire:click="createSection" class="btn-primary text-sm">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
          إنشاء القسم
        </button>
      </div>
    </div>
  </div>
  @endif
</div>
