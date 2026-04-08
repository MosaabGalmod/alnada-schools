<div class="space-y-6" x-data>

    {{-- Flash Message --}}
    @if($flashMsg)
        <div class="rounded-2xl px-5 py-3.5 text-sm font-medium {{ $flashType === 'success' ? 'bg-green-50 text-green-700 border border-green-200 dark:bg-green-900/20 dark:text-green-400 dark:border-green-800' : 'bg-red-50 text-red-700 border border-red-200 dark:bg-red-900/20 dark:text-red-400 dark:border-red-800' }}"
            wire:key="flash">
            <div class="flex items-center gap-2">
                @if($flashType === 'success')
                    <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                @else
                    <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                @endif
                {{ $flashMsg }}
            </div>
        </div>
    @endif

    {{-- ── Change Username ────────────────────────── --}}
    <div class="overflow-hidden rounded-3xl border border-gray-50 bg-white shadow-card dark:bg-gray-800 dark:border-gray-700">
        <div class="flex items-center gap-3 border-b border-gray-100 bg-gray-50/50 px-6 py-4 dark:border-gray-700 dark:bg-gray-700/50">
            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-100 dark:bg-blue-900/30">
                <svg class="h-5 w-5 text-blue-700 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <div>
                <h3 class="font-heading text-sm font-bold text-gray-900 dark:text-white">اسم المستخدم</h3>
                <p class="text-xs text-gray-400">تغيير اسم الدخول للوحة التحكم</p>
            </div>
        </div>

        <form class="space-y-5 p-6" wire:submit="saveUsername">
            <div>
                <label class="form-label" for="admin_username">اسم المستخدم الجديد</label>
                <input class="form-input" id="admin_username" type="text"
                    wire:model="admin_username" autocomplete="username"
                    placeholder="admin" dir="ltr">
                @error('admin_username') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <button class="btn-primary" type="submit" wire:loading.attr="disabled">
                <span wire:loading.remove>
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    حفظ اسم المستخدم
                </span>
                <span class="flex items-center gap-2" wire:loading wire:target="saveUsername">
                    <svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    جاري الحفظ...
                </span>
            </button>
        </form>
    </div>

    {{-- ── Change Password ────────────────────────── --}}
    <div class="overflow-hidden rounded-3xl border border-gray-50 bg-white shadow-card dark:bg-gray-800 dark:border-gray-700">
        <div class="flex items-center gap-3 border-b border-gray-100 bg-gray-50/50 px-6 py-4 dark:border-gray-700 dark:bg-gray-700/50">
            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-amber-100 dark:bg-amber-900/30">
                <svg class="h-5 w-5 text-amber-700 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                </svg>
            </div>
            <div>
                <h3 class="font-heading text-sm font-bold text-gray-900 dark:text-white">كلمة المرور</h3>
                <p class="text-xs text-gray-400">تغيير كلمة مرور لوحة التحكم</p>
            </div>
        </div>

        <form class="space-y-5 p-6" wire:submit="changePassword">
            <div>
                <label class="form-label" for="current_password">كلمة المرور الحالية <span class="text-red-400">*</span></label>
                <input class="form-input" id="current_password" type="password"
                    wire:model="current_password" autocomplete="current-password" dir="ltr">
                @error('current_password') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="form-label" for="new_password">كلمة المرور الجديدة <span class="text-red-400">*</span></label>
                <input class="form-input" id="new_password" type="password"
                    wire:model="new_password" autocomplete="new-password" dir="ltr">
                @error('new_password') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                <p class="mt-1.5 text-xs text-gray-400">8 أحرف على الأقل</p>
            </div>

            <div>
                <label class="form-label" for="new_password_confirmation">تأكيد كلمة المرور الجديدة <span class="text-red-400">*</span></label>
                <input class="form-input" id="new_password_confirmation" type="password"
                    wire:model="new_password_confirmation" autocomplete="new-password" dir="ltr">
                @error('new_password_confirmation') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <button class="btn-primary" type="submit" wire:loading.attr="disabled">
                <span wire:loading.remove>
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    تغيير كلمة المرور
                </span>
                <span class="flex items-center gap-2" wire:loading wire:target="changePassword">
                    <svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    جاري الحفظ...
                </span>
            </button>
        </form>
    </div>

    {{-- ── Security Tip ───────────────────────────── --}}
    <div class="rounded-2xl border border-amber-100 bg-amber-50/50 p-4 dark:border-amber-900/30 dark:bg-amber-900/10">
        <div class="flex gap-3">
            <svg class="h-5 w-5 shrink-0 text-amber-600 dark:text-amber-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div class="text-sm text-amber-800 dark:text-amber-300">
                <p class="font-medium">نصيحة أمنية</p>
                <p class="mt-1 text-xs leading-relaxed">استخدم كلمة مرور قوية تحتوي على أحرف كبيرة وصغيرة وأرقام ورموز. لا تشارك بيانات الدخول مع أي أحد.</p>
            </div>
        </div>
    </div>
</div>
