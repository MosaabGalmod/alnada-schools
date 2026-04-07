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
  {{-- Success State --}}
  <div class="flex flex-col items-center text-center py-10 animate-fade-up" role="status" aria-live="polite">
    <div class="w-16 h-16 bg-primary-100 rounded-3xl flex items-center justify-center mb-4">
      <svg class="w-8 h-8 text-primary-600" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
      </svg>
    </div>
    <h3 class="font-heading text-xl font-bold text-gray-900 mb-2">تم الإرسال بنجاح!</h3>
    <p class="text-gray-500 mb-6">شكرًا لتواصلك معنا. سنرد عليك في أقرب وقت ممكن.</p>
    <button wire:click="$set('sent', false)" class="btn-primary cursor-pointer">إرسال رسالة أخرى</button>
  </div>
  @else
  <form wire:submit="submit" class="space-y-4" novalidate>
    {{-- Global validation errors --}}
    @if($errors->any())
    <div class="rounded-2xl border border-red-100 bg-red-50 p-4" role="alert" aria-live="assertive">
      <p class="text-sm font-medium text-red-700">يرجى تصحيح الأخطاء التالية:</p>
      <ul class="mt-1 list-inside list-disc text-sm text-red-600">
        @foreach($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <div class="grid md:grid-cols-2 gap-4">
      <div>
        <label for="cf-name" class="form-label">الاسم الكامل <span class="text-red-500" aria-hidden="true">*</span></label>
        <input id="cf-name" wire:model="name" type="text" class="form-input @error('name') border-red-400 focus:ring-red-400 @enderror"
          placeholder="اسمك الكريم" required aria-required="true" @error('name') aria-invalid="true" aria-describedby="cf-name-error" @enderror />
        @error('name')<p id="cf-name-error" class="text-red-500 text-xs mt-1" role="alert">{{ $message }}</p>@enderror
      </div>
      <div>
        <label for="cf-phone" class="form-label">رقم الجوال <span class="text-red-500" aria-hidden="true">*</span></label>
        <input id="cf-phone" wire:model="phone" type="tel" class="form-input @error('phone') border-red-400 focus:ring-red-400 @enderror"
          placeholder="05XXXXXXXX" dir="ltr" required aria-required="true" @error('phone') aria-invalid="true" aria-describedby="cf-phone-error" @enderror />
        @error('phone')<p id="cf-phone-error" class="text-red-500 text-xs mt-1" role="alert">{{ $message }}</p>@enderror
      </div>
    </div>

    <div>
      <label for="cf-email" class="form-label">البريد الإلكتروني</label>
      <input id="cf-email" wire:model="email" type="email" class="form-input @error('email') border-red-400 focus:ring-red-400 @enderror"
        placeholder="email@example.com" dir="ltr" @error('email') aria-invalid="true" aria-describedby="cf-email-error" @enderror />
      @error('email')<p id="cf-email-error" class="text-red-500 text-xs mt-1" role="alert">{{ $message }}</p>@enderror
    </div>

    <div>
      <label for="cf-subject" class="form-label">موضوع الرسالة</label>
      <select id="cf-subject" wire:model="subject" class="form-input cursor-pointer">
        <option value="" disabled>اختر الموضوع</option>
        <option value="التسجيل والالتحاق">التسجيل والالتحاق</option>
        <option value="الاستفسار عن البرامج">الاستفسار عن البرامج</option>
        <option value="الرسوم الدراسية">الرسوم الدراسية</option>
        <option value="الشراكة المجتمعية">الشراكة المجتمعية</option>
        <option value="أخرى">أخرى</option>
      </select>
    </div>

    <div>
      <label for="cf-message" class="form-label">رسالتك <span class="text-red-500" aria-hidden="true">*</span></label>
      <textarea id="cf-message" wire:model="message" rows="4" class="form-input resize-none @error('message') border-red-400 focus:ring-red-400 @enderror"
        placeholder="اكتب رسالتك هنا..." required aria-required="true" @error('message') aria-invalid="true" aria-describedby="cf-message-error" @enderror></textarea>
      @error('message')<p id="cf-message-error" class="text-red-500 text-xs mt-1" role="alert">{{ $message }}</p>@enderror
    </div>

    <button type="submit" class="btn-primary w-full justify-center cursor-pointer"
      wire:loading.attr="disabled" wire:loading.class="opacity-75 cursor-not-allowed" aria-live="polite">
      <span wire:loading.remove class="flex items-center gap-2">
        <svg class="w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
        </svg>
        إرسال الرسالة
      </span>
      <span wire:loading class="flex items-center gap-2">
        <svg class="animate-spin w-4 h-4" aria-hidden="true" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
        </svg>
        جارٍ الإرسال...
      </span>
    </button>
  </form>
  @endif
</div>
