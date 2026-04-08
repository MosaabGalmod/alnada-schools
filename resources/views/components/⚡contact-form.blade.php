<?php

use App\Models\Message;
use Livewire\Component;
use Livewire\Attributes\Validate;

new class extends Component {
    #[Validate("required|string|max:100")]
    public string $name = "";

    #[Validate("required|string|max:20")]
    public string $phone = "";

    #[Validate("nullable|email|max:150")]
    public string $email = "";

    #[Validate("nullable|string|max:100")]
    public string $subject = "";

    #[Validate("required|string|max:1000")]
    public string $message = "";

    public bool $sent = false;

    public function submit(): void
    {
        $this->validate();

        Message::create([
            "name" => $this->name,
            "phone" => $this->phone,
            "email" => $this->email ?: null,
            "subject" => $this->subject ?: null,
            "message" => $this->message,
        ]);

        $this->reset(["name", "phone", "email", "subject", "message"]);
        $this->sent = true;
    }
};
?>

<div class="contact-form-component">
	@if ($sent)
		{{-- Success State --}}
		<div class="flex animate-fade-up flex-col items-center py-10 text-center" role="status" aria-live="polite">
			<div class="contact-form-success-icon mb-4 flex h-16 w-16 items-center justify-center rounded-3xl bg-primary-100">
				<svg class="h-8 w-8 text-primary-600" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
				</svg>
			</div>
			<h3 class="mb-2 font-heading text-xl font-bold text-gray-900 dark:text-white">تم الإرسال بنجاح!</h3>
			<p class="mb-6 text-gray-500 dark:text-slate-300">شكرًا لتواصلك معنا. سنرد عليك في أقرب وقت ممكن.</p>
			<button class="btn-primary cursor-pointer" wire:click="$set('sent', false)">إرسال رسالة أخرى</button>
		</div>
	@else
		<form class="space-y-4" wire:submit="submit" novalidate>
			{{-- Global validation errors --}}
			@if ($errors->any())
				<div class="rounded-2xl border border-red-100 bg-red-50 p-4" role="alert" aria-live="assertive">
					<p class="text-sm font-medium text-red-700">يرجى تصحيح الأخطاء التالية:</p>
					<ul class="mt-1 list-inside list-disc text-sm text-red-600">
						@foreach ($errors->all() as $err)
							<li>{{ $err }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			<div class="grid gap-4 md:grid-cols-2">
				<div>
					<label class="form-label" for="cf-name">الاسم الكامل <span class="text-red-500"
							aria-hidden="true">*</span></label>
					<input class="@error("name") border-red-400 focus:ring-red-400 @enderror form-input" id="cf-name" type="text"
						aria-required="true" wire:model="name" placeholder="اسمك الكريم" required
						@error("name") aria-invalid="true" aria-describedby="cf-name-error" @enderror />
					@error("name")
						<p class="mt-1 text-xs text-red-500" id="cf-name-error" role="alert">{{ $message }}</p>
					@enderror
				</div>
				<div>
					<label class="form-label" for="cf-phone">رقم الجوال <span class="text-red-500" aria-hidden="true">*</span></label>
					<input class="@error("phone") border-red-400 focus:ring-red-400 @enderror form-input" id="cf-phone" type="tel"
						aria-required="true" wire:model="phone" placeholder="05XXXXXXXX" dir="ltr" required
						@error("phone") aria-invalid="true" aria-describedby="cf-phone-error" @enderror />
					@error("phone")
						<p class="mt-1 text-xs text-red-500" id="cf-phone-error" role="alert">{{ $message }}</p>
					@enderror
				</div>
			</div>

			<div>
				<label class="form-label" for="cf-email">البريد الإلكتروني</label>
				<input class="@error("email") border-red-400 focus:ring-red-400 @enderror form-input" id="cf-email" type="email"
					wire:model="email" placeholder="email@example.com" dir="ltr"
					@error("email") aria-invalid="true" aria-describedby="cf-email-error" @enderror />
				@error("email")
					<p class="mt-1 text-xs text-red-500" id="cf-email-error" role="alert">{{ $message }}</p>
				@enderror
			</div>

			<div>
				<label class="form-label" for="cf-subject">موضوع الرسالة</label>
				<select class="form-input cursor-pointer" id="cf-subject" wire:model="subject">
					<option value="" disabled>اختر الموضوع</option>
					<option value="التسجيل والالتحاق">التسجيل والالتحاق</option>
					<option value="الاستفسار عن البرامج">الاستفسار عن البرامج</option>
					<option value="الرسوم الدراسية">الرسوم الدراسية</option>
					<option value="الشراكة المجتمعية">الشراكة المجتمعية</option>
					<option value="أخرى">أخرى</option>
				</select>
			</div>

			<div>
				<label class="form-label" for="cf-message">رسالتك <span class="text-red-500" aria-hidden="true">*</span></label>
				<textarea class="@error("message") border-red-400 focus:ring-red-400 @enderror form-input resize-none" id="cf-message"
				 aria-required="true" wire:model="message" rows="4" placeholder="اكتب رسالتك هنا..." required
				 @error("message") aria-invalid="true" aria-describedby="cf-message-error" @enderror></textarea>
				@error("message")
					<p class="mt-1 text-xs text-red-500" id="cf-message-error" role="alert">{{ $message }}</p>
				@enderror
			</div>

			<button class="btn-primary w-full cursor-pointer justify-center" type="submit" aria-live="polite"
				wire:loading.attr="disabled" wire:loading.class="opacity-75 cursor-not-allowed">
				<span class="flex items-center gap-2" wire:loading.remove>
					<svg class="h-4 w-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
					</svg>
					إرسال الرسالة
				</span>
				<span class="flex items-center gap-2" wire:loading>
					<svg class="h-4 w-4 animate-spin" aria-hidden="true" fill="none" viewBox="0 0 24 24">
						<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
						<path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
					</svg>
					جارٍ الإرسال...
				</span>
			</button>
		</form>
	@endif
</div>
