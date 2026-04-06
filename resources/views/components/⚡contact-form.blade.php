<?php

use App\Models\Message;
use Livewire\Component;
use Livewire\Attributes\Validate;

new class extends Component
{
    #[Validate('required|string|max:100')]
    public string $name = '';

    #[Validate('required|string|max:20')]
    public string $phone = '';

    #[Validate('nullable|email|max:150')]
    public string $email = '';

    #[Validate('nullable|string|max:100')]
    public string $subject = '';

    #[Validate('required|string|max:1000')]
    public string $message = '';

    public bool $sent = false;

    public function submit(): void
    {
        $this->validate();

        Message::create([
            'name'    => $this->name,
            'phone'   => $this->phone,
            'email'   => $this->email ?: null,
            'subject' => $this->subject ?: null,
            'message' => $this->message,
        ]);

        $this->reset(['name','phone','email','subject','message']);
        $this->sent = true;
    }
};
?>

<div>
  @if($sent)
  <div class="flex flex-col items-center text-center py-10 animate-fade-up">
    <div class="w-16 h-16 bg-primary-100 rounded-3xl flex items-center justify-center mb-4">
      <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
      </svg>
    </div>
    <h3 class="font-heading text-xl font-bold text-gray-900 mb-2">تم الإرسال بنجاح!</h3>
    <p class="text-gray-500 mb-6">شكرًا لتواصلك معنا. سنرد عليك في أقرب وقت ممكن.</p>
    <button wire:click="$set('sent', false)" class="btn-primary">إرسال رسالة أخرى</button>
  </div>
  @else
  <form wire:submit="submit" class="space-y-4">
    <div class="grid md:grid-cols-2 gap-4">
      <div>
        <label class="form-label">الاسم الكامل <span class="text-red-500">*</span></label>
        <input wire:model="name" type="text" class="form-input" placeholder="اسمك الكريم" />
        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="form-label">رقم الجوال <span class="text-red-500">*</span></label>
        <input wire:model="phone" type="tel" class="form-input" placeholder="05XXXXXXXX" dir="ltr" />
        @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
      </div>
    </div>

    <div>
      <label class="form-label">البريد الإلكتروني</label>
      <input wire:model="email" type="email" class="form-input" placeholder="email@example.com" dir="ltr" />
      @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
      <label class="form-label">موضوع الرسالة</label>
      <select wire:model="subject" class="form-input">
        <option value="">اختر الموضوع</option>
        <option value="التسجيل والالتحاق">التسجيل والالتحاق</option>
        <option value="الاستفسار عن البرامج">الاستفسار عن البرامج</option>
        <option value="الرسوم الدراسية">الرسوم الدراسية</option>
        <option value="الشراكة المجتمعية">الشراكة المجتمعية</option>
        <option value="أخرى">أخرى</option>
      </select>
    </div>

    <div>
      <label class="form-label">رسالتك <span class="text-red-500">*</span></label>
      <textarea wire:model="message" rows="4" class="form-input resize-none" placeholder="اكتب رسالتك هنا..."></textarea>
      @error('message')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    <button type="submit" class="btn-primary w-full justify-center" wire:loading.attr="disabled">
      <span wire:loading.remove>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
        إرسال الرسالة
      </span>
      <span wire:loading class="flex items-center gap-2">
        <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
        جارٍ الإرسال...
      </span>
    </button>
  </form>
  @endif
</div>
