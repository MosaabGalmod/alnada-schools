<?php

use App\Models\SiteSetting;
use Livewire\Component;
use Livewire\Attributes\Validate;

new class extends Component
{
    public string $hero_title    = '';
    public string $hero_subtitle = '';
    public string $phone         = '';
    public string $email         = '';
    public string $address       = '';
    public string $working_hours = '';
    public string $instagram     = '';
    public string $twitter       = '';
    public string $facebook      = '';

    public bool $saved = false;

    public function mount(): void
    {
        $settings = SiteSetting::all_settings();

        $this->hero_title    = $settings['hero_title']    ?? 'مدارس الندى النموذجية الأهلية';
        $this->hero_subtitle = $settings['hero_subtitle'] ?? 'نُشكّل مستقبل أبنائنا بأيدٍ متخصصة وقلوب مخلصة';
        $this->phone         = $settings['phone']         ?? '0559281924';
        $this->email         = $settings['email']         ?? 'alnadaiec@gmail.com';
        $this->address       = $settings['address']       ?? 'DMGA2924، 2924 خالد ابن هودة، حي البركة، المدينة المنورة 42332';
        $this->working_hours = $settings['working_hours'] ?? 'الأحد – الخميس: 7:00ص – 1:00م | الجمعة والسبت: مغلق';
        $this->instagram     = $settings['instagram']     ?? 'alnada_school';
        $this->twitter       = $settings['twitter']       ?? 'AIEC_';
        $this->facebook      = $settings['facebook']      ?? 'Alnada2021';
    }

    public function save(): void
    {
        $this->validate([
            'hero_title'    => 'required|string|max:200',
            'hero_subtitle' => 'required|string|max:500',
            'phone'         => 'required|string|max:20',
            'email'         => 'required|email|max:150',
            'address'       => 'required|string|max:300',
            'working_hours' => 'required|string|max:200',
            'instagram'     => 'nullable|string|max:100',
            'twitter'       => 'nullable|string|max:100',
            'facebook'      => 'nullable|string|max:100',
        ]);

        SiteSetting::setMany([
            'hero_title'    => $this->hero_title,
            'hero_subtitle' => $this->hero_subtitle,
            'phone'         => $this->phone,
            'email'         => $this->email,
            'address'       => $this->address,
            'working_hours' => $this->working_hours,
            'instagram'     => $this->instagram,
            'twitter'       => $this->twitter,
            'facebook'      => $this->facebook,
        ]);

        $this->saved = true;
        $this->dispatch('settings-saved');
    }
};
?>

<div class="space-y-6 max-w-3xl">
  @if($saved)
  <div x-data x-init="setTimeout(() => $wire.set('saved', false), 4000)"
       class="bg-primary-50 border border-primary-200 text-primary-800 rounded-2xl px-4 py-3 flex items-center gap-3 text-sm animate-fade-up">
    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    تم حفظ الإعدادات بنجاح وسيتم تحديث الموقع.
  </div>
  @endif

  <form wire:submit="save" class="space-y-6">

    {{-- Hero --}}
    <div class="bg-white rounded-3xl shadow-card p-6">
      <h3 class="font-heading font-bold text-gray-900 mb-4 flex items-center gap-2">
        <span class="w-7 h-7 bg-primary-100 rounded-xl flex items-center justify-center">
          <svg class="w-4 h-4 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        </span>
        قسم الهيرو
      </h3>
      <div class="space-y-4">
        <div>
          <label class="form-label">العنوان الرئيسي</label>
          <input wire:model="hero_title" type="text" class="form-input" />
          @error('hero_title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="form-label">العنوان الفرعي</label>
          <textarea wire:model="hero_subtitle" rows="2" class="form-input resize-none"></textarea>
          @error('hero_subtitle')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
      </div>
    </div>

    {{-- Contact --}}
    <div class="bg-white rounded-3xl shadow-card p-6">
      <h3 class="font-heading font-bold text-gray-900 mb-4 flex items-center gap-2">
        <span class="w-7 h-7 bg-gold-100 rounded-xl flex items-center justify-center">
          <svg class="w-4 h-4 text-gold-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
        </span>
        معلومات التواصل
      </h3>
      <div class="grid md:grid-cols-2 gap-4">
        <div>
          <label class="form-label">رقم الهاتف</label>
          <input wire:model="phone" type="tel" class="form-input" dir="ltr" />
          @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="form-label">البريد الإلكتروني</label>
          <input wire:model="email" type="email" class="form-input" dir="ltr" />
          @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="md:col-span-2">
          <label class="form-label">العنوان</label>
          <input wire:model="address" type="text" class="form-input" />
          @error('address')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="md:col-span-2">
          <label class="form-label">ساعات العمل</label>
          <input wire:model="working_hours" type="text" class="form-input" />
          @error('working_hours')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
      </div>
    </div>

    {{-- Social --}}
    <div class="bg-white rounded-3xl shadow-card p-6">
      <h3 class="font-heading font-bold text-gray-900 mb-4 flex items-center gap-2">
        <span class="w-7 h-7 bg-blue-100 rounded-xl flex items-center justify-center">
          <svg class="w-4 h-4 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
        </span>
        التواصل الاجتماعي
      </h3>
      <div class="grid md:grid-cols-3 gap-4">
        <div>
          <label class="form-label">انستغرام (المعرّف)</label>
          <div class="relative">
            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">@</span>
            <input wire:model="instagram" type="text" class="form-input pr-7" dir="ltr" placeholder="alnada_school" />
          </div>
        </div>
        <div>
          <label class="form-label">تويتر X (المعرّف)</label>
          <div class="relative">
            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">@</span>
            <input wire:model="twitter" type="text" class="form-input pr-7" dir="ltr" placeholder="AIEC_" />
          </div>
        </div>
        <div>
          <label class="form-label">فيسبوك (المعرّف)</label>
          <div class="relative">
            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">/</span>
            <input wire:model="facebook" type="text" class="form-input pr-7" dir="ltr" placeholder="Alnada2021" />
          </div>
        </div>
      </div>
    </div>

    <button type="submit" class="btn-primary" wire:loading.attr="disabled">
      <span wire:loading.remove>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
        حفظ الإعدادات
      </span>
      <span wire:loading>جارٍ الحفظ...</span>
    </button>
  </form>
</div>
