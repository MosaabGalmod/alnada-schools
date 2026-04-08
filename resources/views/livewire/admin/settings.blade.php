<div x-data="{ tab: 'contact' }" lang="ar" dir="rtl">

    {{-- Flash --}}
    @if ($flashMsg)
        <div class="{{ $flashType === 'error'
                ? 'bg-red-50 text-red-700 border border-red-200 dark:bg-red-900/20 dark:text-red-400 dark:border-red-800'
                : 'bg-primary-50 text-primary-700 border border-primary-200 dark:bg-primary-900/20 dark:text-primary-400 dark:border-primary-800' }}
            mb-6 flex items-center gap-3 rounded-2xl px-5 py-3.5 text-sm font-medium"
            x-data="{ show: true }" x-show="show"
            x-init="setTimeout(() => show = false, 4000)"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-end="opacity-0 -translate-y-2">
            <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ $flashMsg }}
        </div>
    @endif

    {{-- ── Tabs ────────────────────────────────────────── --}}
    <div class="mb-6 overflow-x-auto">
        <div class="flex min-w-max gap-1 rounded-2xl border border-gray-100 bg-gray-50/80 p-1 dark:border-gray-700 dark:bg-gray-800/60" role="tablist" aria-label="أقسام الإعدادات">
            @foreach ([
                ['contact',  'التواصل',    'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z'],
                ['branding', 'الهوية',     'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'],
                ['seo',      'السيو',      'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'],
                ['footer',   'التذييل',   'M4 6h16M4 12h16M4 18h7'],
                ['strings',  'النصوص',    'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z'],
            ] as [$key, $label, $icon])
                <button
                    role="tab" :aria-selected="tab === '{{ $key }}'" :tabindex="tab === '{{ $key }}' ? 0 : -1"
                    @click="tab = '{{ $key }}'"
                    :class="tab === '{{ $key }}'
                        ? 'bg-white shadow-sm text-primary-700 dark:bg-gray-700 dark:text-primary-300'
                        : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                    class="flex items-center gap-2 rounded-xl px-4 py-2 text-sm font-medium transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-400">
                    <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $icon }}" />
                    </svg>
                    <span>{{ $label }}</span>
                </button>
            @endforeach
        </div>
    </div>

    {{-- ══════════════════════════════════════════════════
     |  TAB: التواصل
     ══════════════════════════════════════════════════ --}}
    <div x-show="tab === 'contact'" x-transition role="tabpanel" aria-label="معلومات التواصل">
        <form class="space-y-6" wire:submit="saveContact">
            {{-- Contact Info --}}
            <div class="overflow-hidden rounded-3xl border border-gray-50 bg-white shadow-card dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center gap-3 border-b border-gray-100 bg-gray-50/50 px-6 py-4 dark:border-gray-700 dark:bg-gray-700/50">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-primary-100 dark:bg-primary-900/30">
                        <svg class="h-5 w-5 text-primary-700 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-heading text-sm font-bold text-gray-900 dark:text-white">معلومات التواصل</h3>
                        <p class="text-xs text-gray-400">الهاتف، البريد، العنوان، وساعات العمل</p>
                    </div>
                </div>
                <div class="grid gap-5 p-6 md:grid-cols-2">
                    <div>
                        <label class="form-label" for="phone">رقم الهاتف <span class="text-red-400">*</span></label>
                        <input class="form-input" id="phone" type="tel" wire:model="phone" dir="ltr" autocomplete="tel">
                        @error('phone') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="form-label" for="email">البريد الإلكتروني <span class="text-red-400">*</span></label>
                        <input class="form-input" id="email" type="email" wire:model="email" dir="ltr" autocomplete="email">
                        @error('email') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="form-label" for="address">العنوان <span class="text-red-400">*</span></label>
                        <input class="form-input" id="address" type="text" wire:model="address">
                        @error('address') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="form-label" for="working_hours">ساعات العمل <span class="text-red-400">*</span></label>
                        <input class="form-input" id="working_hours" type="text" wire:model="working_hours">
                        @error('working_hours') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Social Media --}}
            <div class="overflow-hidden rounded-3xl border border-gray-50 bg-white shadow-card dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center gap-3 border-b border-gray-100 bg-gray-50/50 px-6 py-4 dark:border-gray-700 dark:bg-gray-700/50">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-pink-100 dark:bg-pink-900/30">
                        <svg class="h-5 w-5 text-pink-700 dark:text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-heading text-sm font-bold text-gray-900 dark:text-white">وسائل التواصل الاجتماعي</h3>
                        <p class="text-xs text-gray-400">أدخل اسم المستخدم أو الرابط فقط</p>
                    </div>
                </div>
                <div class="grid gap-5 p-6 md:grid-cols-2">
                    @foreach ([['instagram','إنستغرام','@'],['twitter','تويتر/X','@'],['facebook','فيسبوك','fb/'],['whatsapp','واتساب (رقم)','+']] as [$field,$lbl,$prefix])
                    <div>
                        <label class="form-label" for="{{ $field }}">{{ $lbl }}</label>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 end-3.5 flex items-center text-xs text-gray-400 dark:text-gray-500" dir="ltr">{{ $prefix }}</span>
                            <input class="form-input pe-8" id="{{ $field }}" type="text" wire:model="{{ $field }}" dir="ltr">
                        </div>
                        @error($field) <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-end">
                @include('livewire.admin._partials.save-btn', ['target' => 'saveContact', 'label' => 'حفظ التواصل'])
            </div>
        </form>
    </div>

    {{-- ══════════════════════════════════════════════════
     |  TAB: الهوية
     ══════════════════════════════════════════════════ --}}
    <div x-show="tab === 'branding'" x-cloak x-transition role="tabpanel" aria-label="هوية الموقع">
        <div class="space-y-6">
            {{-- Site Name & Tagline --}}
            <div class="overflow-hidden rounded-3xl border border-gray-50 bg-white shadow-card dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center gap-3 border-b border-gray-100 bg-gray-50/50 px-6 py-4 dark:border-gray-700 dark:bg-gray-700/50">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-100 dark:bg-indigo-900/30">
                        <svg class="h-5 w-5 text-indigo-700 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-heading text-sm font-bold text-gray-900 dark:text-white">اسم الموقع والشعار النصي</h3>
                        <p class="text-xs text-gray-400">يظهر في المتصفح والـ SEO</p>
                    </div>
                </div>
                <form class="grid gap-5 p-6 md:grid-cols-2" wire:submit="saveBranding">
                    <div>
                        <label class="form-label" for="site_name">اسم الموقع</label>
                        <input class="form-input" id="site_name" type="text" wire:model="site_name">
                        @error('site_name') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="form-label" for="site_tagline">الشعار النصي (Tagline)</label>
                        <input class="form-input" id="site_tagline" type="text" wire:model="site_tagline">
                        @error('site_tagline') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div class="md:col-span-2 flex justify-end">
                        @include('livewire.admin._partials.save-btn', ['target' => 'saveBranding', 'label' => 'حفظ الاسم'])
                    </div>
                </form>
            </div>

            {{-- Logo --}}
            <div class="overflow-hidden rounded-3xl border border-gray-50 bg-white shadow-card dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center gap-3 border-b border-gray-100 bg-gray-50/50 px-6 py-4 dark:border-gray-700 dark:bg-gray-700/50">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-purple-100 dark:bg-purple-900/30">
                        <svg class="h-5 w-5 text-purple-700 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-heading text-sm font-bold text-gray-900 dark:text-white">شعار الموقع (Logo)</h3>
                        <p class="text-xs text-gray-400">PNG, JPG, SVG, WebP — بحد أقصى 2 ميجابايت</p>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex flex-wrap items-start gap-5">
                        <div class="flex flex-col items-center gap-2">
                            <div class="flex h-20 w-20 items-center justify-center overflow-hidden rounded-2xl border-2 border-dashed border-gray-200 bg-gray-50 dark:border-gray-600 dark:bg-gray-700">
                                @if($currentLogo)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($currentLogo) }}" alt="الشعار الحالي" class="h-auto max-h-16 w-auto max-w-[4rem] object-contain">
                                @else
                                    <img src="{{ asset('logo.svg') }}" alt="الشعار الافتراضي" class="h-auto max-h-14 w-auto max-w-[3.5rem] object-contain opacity-60">
                                @endif
                            </div>
                            <span class="text-[10px] text-gray-400">{{ $currentLogo ? 'الحالي' : 'الافتراضي' }}</span>
                        </div>
                        <div class="flex-1 min-w-[200px] space-y-3">
                            <div class="flex flex-wrap gap-2">
                                <label for="logo-upload" class="btn-sm cursor-pointer bg-primary-50 text-primary-700 hover:bg-primary-100 dark:bg-primary-900/30 dark:text-primary-300">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                                    اختر صورة
                                </label>
                                <input id="logo-upload" type="file" class="sr-only" wire:model="logoFile" accept="image/png,image/jpeg,image/svg+xml,image/webp">
                                @if($logoFile)
                                    <button type="button" wire:click="uploadLogo" class="btn-sm bg-green-50 text-green-700 hover:bg-green-100 dark:bg-green-900/30 dark:text-green-300">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                        رفع الشعار
                                    </button>
                                @endif
                                @if($currentLogo)
                                    <button type="button" wire:click="deleteLogo" wire:confirm="حذف الشعار والعودة للافتراضي؟"
                                        class="btn-sm bg-red-50 text-red-600 hover:bg-red-100 dark:bg-red-900/30 dark:text-red-400">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        حذف
                                    </button>
                                @endif
                            </div>
                            @if($logoFile)
                                <div class="flex items-center gap-2">
                                    <div class="h-10 w-10 overflow-hidden rounded-xl border border-gray-200 bg-gray-50 dark:border-gray-700 dark:bg-gray-700">
                                        <img src="{{ $logoFile->temporaryUrl() }}" class="h-full w-full object-contain" alt="">
                                    </div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">{{ $logoFile->getClientOriginalName() }}</span>
                                </div>
                            @endif
                            <div wire:loading wire:target="logoFile" class="flex items-center gap-1.5 text-xs text-primary-600">
                                <svg class="h-3 w-3 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>
                                جاري التحميل...
                            </div>
                            @error('logoFile') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Favicon --}}
            <div class="overflow-hidden rounded-3xl border border-gray-50 bg-white shadow-card dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center gap-3 border-b border-gray-100 bg-gray-50/50 px-6 py-4 dark:border-gray-700 dark:bg-gray-700/50">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-teal-100 dark:bg-teal-900/30">
                        <svg class="h-5 w-5 text-teal-700 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-heading text-sm font-bold text-gray-900 dark:text-white">أيقونة التبويب (Favicon)</h3>
                        <p class="text-xs text-gray-400">PNG, ICO, WebP — بحد أقصى 512 كيلوبايت</p>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex flex-wrap items-start gap-5">
                        <div class="flex flex-col items-center gap-2">
                            <div class="flex h-16 w-16 items-center justify-center overflow-hidden rounded-xl border-2 border-dashed border-gray-200 bg-gray-50 dark:border-gray-600 dark:bg-gray-700">
                                @if($currentFavicon)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($currentFavicon) }}" alt="الأيقونة الحالية" class="h-8 w-8 object-contain">
                                @else
                                    <img src="{{ asset('logo-sm.png') }}" alt="الأيقونة الافتراضية" class="h-8 w-8 object-contain opacity-60">
                                @endif
                            </div>
                            <span class="text-[10px] text-gray-400">32×32 px</span>
                        </div>
                        <div class="flex-1 min-w-[200px] space-y-3">
                            <div class="flex flex-wrap gap-2">
                                <label for="favicon-upload" class="btn-sm cursor-pointer bg-teal-50 text-teal-700 hover:bg-teal-100 dark:bg-teal-900/30 dark:text-teal-300">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                                    اختر أيقونة
                                </label>
                                <input id="favicon-upload" type="file" class="sr-only" wire:model="faviconFile" accept="image/png,image/jpeg,image/x-icon,image/webp">
                                @if($faviconFile)
                                    <button type="button" wire:click="uploadFavicon" class="btn-sm bg-green-50 text-green-700 hover:bg-green-100 dark:bg-green-900/30 dark:text-green-300">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                        رفع الأيقونة
                                    </button>
                                @endif
                            </div>
                            @error('faviconFile') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════════
     |  TAB: السيو
     ══════════════════════════════════════════════════ --}}
    <div x-show="tab === 'seo'" x-cloak x-transition role="tabpanel" aria-label="إعدادات السيو">
        <form class="space-y-6" wire:submit="saveSeo">
            <div class="overflow-hidden rounded-3xl border border-gray-50 bg-white shadow-card dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center gap-3 border-b border-gray-100 bg-gray-50/50 px-6 py-4 dark:border-gray-700 dark:bg-gray-700/50">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-green-100 dark:bg-green-900/30">
                        <svg class="h-5 w-5 text-green-700 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-heading text-sm font-bold text-gray-900 dark:text-white">إعدادات محركات البحث (SEO)</h3>
                        <p class="text-xs text-gray-400">العنوان الافتراضي، الوصف، الكلمات المفتاحية</p>
                    </div>
                </div>
                <div class="space-y-5 p-6">
                    <div>
                        <label class="form-label" for="seo_title_default">العنوان الافتراضي للصفحة</label>
                        <input class="form-input" id="seo_title_default" type="text" wire:model="seo_title_default"
                            placeholder="مدارس الندى النموذجية الأهلية | التربية الخاصة والدمج - المدينة المنورة">
                        <p class="mt-1.5 text-xs text-gray-400">يظهر في تبويب المتصفح ونتائج جوجل (≤ 60 حرف مثالي)</p>
                        @error('seo_title_default') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="form-label" for="seo_description_default">الوصف الافتراضي</label>
                        <textarea class="form-input min-h-[80px] resize-y" id="seo_description_default" wire:model="seo_description_default" rows="3"
                            placeholder="مدارس الندى النموذجية الأهلية – مؤسسة تعليمية رائدة في التربية الخاصة والدمج..."></textarea>
                        <p class="mt-1.5 text-xs text-gray-400">ما يظهر تحت الرابط في جوجل (≤ 160 حرف مثالي)</p>
                        @error('seo_description_default') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="form-label" for="seo_keywords">الكلمات المفتاحية</label>
                        <input class="form-input" id="seo_keywords" type="text" wire:model="seo_keywords"
                            placeholder="مدارس الندى، التربية الخاصة، الدمج، المدينة المنورة...">
                        <p class="mt-1.5 text-xs text-gray-400">افصل بين الكلمات بفاصلة</p>
                        @error('seo_keywords') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="form-label" for="seo_author">اسم المؤلف / الجهة</label>
                        <input class="form-input" id="seo_author" type="text" wire:model="seo_author"
                            placeholder="مدارس الندى النموذجية الأهلية">
                        @error('seo_author') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
            <div class="flex justify-end">
                @include('livewire.admin._partials.save-btn', ['target' => 'saveSeo', 'label' => 'حفظ السيو'])
            </div>
        </form>
    </div>

    {{-- ══════════════════════════════════════════════════
     |  TAB: التذييل
     ══════════════════════════════════════════════════ --}}
    <div x-show="tab === 'footer'" x-cloak x-transition role="tabpanel" aria-label="محتوى التذييل">
        <form class="space-y-6" wire:submit="saveFooter">

            {{-- CTA Panel --}}
            <div class="overflow-hidden rounded-3xl border border-gray-50 bg-white shadow-card dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center gap-3 border-b border-gray-100 bg-gray-50/50 px-6 py-4 dark:border-gray-700 dark:bg-gray-700/50">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-100 dark:bg-blue-900/30">
                        <svg class="h-5 w-5 text-blue-700 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-heading text-sm font-bold text-gray-900 dark:text-white">لوحة الدعوة للتسجيل (CTA)</h3>
                        <p class="text-xs text-gray-400">الجزء العلوي من التذييل</p>
                    </div>
                </div>
                <div class="grid gap-5 p-6 md:grid-cols-2">
                    <div class="md:col-span-2">
                        <label class="form-label" for="footer_cta_badge">نص الشارة</label>
                        <input class="form-input" id="footer_cta_badge" type="text" wire:model="footer_cta_badge" placeholder="قبول وتسجيل وبرامج متخصصة تحت إشراف تعليمي معتمد">
                        @error('footer_cta_badge') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="form-label" for="footer_cta_title">العنوان</label>
                        <input class="form-input" id="footer_cta_title" type="text" wire:model="footer_cta_title" placeholder="لنبدأ الرحلة التعليمية المناسبة لابنكم">
                        @error('footer_cta_title') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="form-label">الأزرار</label>
                        <div class="grid grid-cols-2 gap-3">
                            <input class="form-input" type="text" wire:model="footer_cta_btn1" placeholder="ابدأ رحلة التسجيل">
                            <input class="form-input" type="text" wire:model="footer_cta_btn2" placeholder="اتصل الآن">
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <label class="form-label" for="footer_cta_desc">الوصف</label>
                        <textarea class="form-input min-h-[72px] resize-y" id="footer_cta_desc" wire:model="footer_cta_desc" rows="2" placeholder="فريقنا يجيب عن الاستفسارات، يشرح البرامج، ويرتب زيارة تعريفية..."></textarea>
                        @error('footer_cta_desc') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Brand Column --}}
            <div class="overflow-hidden rounded-3xl border border-gray-50 bg-white shadow-card dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center gap-3 border-b border-gray-100 bg-gray-50/50 px-6 py-4 dark:border-gray-700 dark:bg-gray-700/50">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-primary-100 dark:bg-primary-900/30">
                        <svg class="h-5 w-5 text-primary-700 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-heading text-sm font-bold text-gray-900 dark:text-white">عمود العلامة التجارية</h3>
                        <p class="text-xs text-gray-400">اسم المدرسة، الوصف، وبطاقات الإحصاء</p>
                    </div>
                </div>
                <div class="grid gap-5 p-6 md:grid-cols-2">
                    <div>
                        <label class="form-label" for="footer_brand_line1">السطر الأول (اسم)</label>
                        <input class="form-input" id="footer_brand_line1" type="text" wire:model="footer_brand_line1" placeholder="مدارس الندى">
                    </div>
                    <div>
                        <label class="form-label" for="footer_brand_line2">السطر الثاني</label>
                        <input class="form-input" id="footer_brand_line2" type="text" wire:model="footer_brand_line2" placeholder="النموذجية الأهلية">
                    </div>
                    <div class="md:col-span-2">
                        <label class="form-label" for="footer_about_desc">وصف المدرسة</label>
                        <textarea class="form-input min-h-[72px] resize-y" id="footer_about_desc" wire:model="footer_about_desc" rows="2" placeholder="رائدة في التربية الخاصة والدمج بالمدينة المنورة منذ عام 1429هـ..."></textarea>
                    </div>
                    {{-- Stat cards --}}
                    @foreach ([
                        ['footer_stat1_label','footer_stat1_value','بداية التميز','1429هـ'],
                        ['footer_stat2_label','footer_stat2_value','المرجعية','اعتماد وزارة التعليم'],
                        ['footer_stat3_label','footer_stat3_value','التجربة','بيئة تعليمية واضحة ومساندة للأسرة'],
                    ] as [$lField, $vField, $lPlaceholder, $vPlaceholder])
                    <div>
                        <label class="form-label">بطاقة إحصاء — التسمية</label>
                        <input class="form-input" type="text" wire:model="{{ $lField }}" placeholder="{{ $lPlaceholder }}">
                    </div>
                    <div>
                        <label class="form-label">بطاقة إحصاء — القيمة</label>
                        <input class="form-input" type="text" wire:model="{{ $vField }}" placeholder="{{ $vPlaceholder }}">
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Nav & Contact sections --}}
            <div class="grid gap-6 md:grid-cols-2">
                {{-- Nav section --}}
                <div class="overflow-hidden rounded-3xl border border-gray-50 bg-white shadow-card dark:border-gray-700 dark:bg-gray-800">
                    <div class="border-b border-gray-100 bg-gray-50/50 px-5 py-3.5 dark:border-gray-700 dark:bg-gray-700/50">
                        <h3 class="font-heading text-sm font-bold text-gray-900 dark:text-white">قسم التنقل السريع</h3>
                    </div>
                    <div class="space-y-4 p-5">
                        <div>
                            <label class="form-label text-xs" for="footer_nav_kicker">Kicker</label>
                            <input class="form-input" id="footer_nav_kicker" type="text" wire:model="footer_nav_kicker" placeholder="خريطة سريعة">
                        </div>
                        <div>
                            <label class="form-label text-xs" for="footer_nav_title">العنوان</label>
                            <input class="form-input" id="footer_nav_title" type="text" wire:model="footer_nav_title" placeholder="كل ما يحتاجه ولي الأمر في مكان واحد">
                        </div>
                        <div>
                            <label class="form-label text-xs" for="footer_nav_desc">الوصف</label>
                            <textarea class="form-input min-h-[60px] resize-y" id="footer_nav_desc" wire:model="footer_nav_desc" rows="2" placeholder="روابط أساسية مختصرة لتقليل التمرير..."></textarea>
                        </div>
                        <div>
                            <label class="form-label text-xs" for="footer_nav_chip">الشريحة</label>
                            <input class="form-input" id="footer_nav_chip" type="text" wire:model="footer_nav_chip" placeholder="تنقل مباشر وواضح">
                        </div>
                    </div>
                </div>

                {{-- Contact section --}}
                <div class="overflow-hidden rounded-3xl border border-gray-50 bg-white shadow-card dark:border-gray-700 dark:bg-gray-800">
                    <div class="border-b border-gray-100 bg-gray-50/50 px-5 py-3.5 dark:border-gray-700 dark:bg-gray-700/50">
                        <h3 class="font-heading text-sm font-bold text-gray-900 dark:text-white">قسم التواصل</h3>
                    </div>
                    <div class="space-y-4 p-5">
                        <div>
                            <label class="form-label text-xs" for="footer_contact_kicker">Kicker</label>
                            <input class="form-input" id="footer_contact_kicker" type="text" wire:model="footer_contact_kicker" placeholder="قنوات مباشرة">
                        </div>
                        <div>
                            <label class="form-label text-xs" for="footer_contact_title">العنوان</label>
                            <input class="form-input" id="footer_contact_title" type="text" wire:model="footer_contact_title" placeholder="تواصل سريع دون بحث إضافي">
                        </div>
                        <div>
                            <label class="form-label text-xs" for="footer_contact_desc">الوصف</label>
                            <textarea class="form-input min-h-[60px] resize-y" id="footer_contact_desc" wire:model="footer_contact_desc" rows="2" placeholder="كل وسائل التواصل الأساسية وساعات العمل..."></textarea>
                        </div>
                        <div>
                            <label class="form-label text-xs" for="footer_copyright">نص حقوق النشر</label>
                            <input class="form-input" id="footer_copyright" type="text" wire:model="footer_copyright" placeholder="مدارس الندى النموذجية الأهلية. جميع الحقوق محفوظة.">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                @include('livewire.admin._partials.save-btn', ['target' => 'saveFooter', 'label' => 'حفظ التذييل'])
            </div>
        </form>
    </div>

    {{-- ══════════════════════════════════════════════════
     |  TAB: النصوص
     ══════════════════════════════════════════════════ --}}
    <div x-show="tab === 'strings'" x-cloak x-transition role="tabpanel" aria-label="نصوص الواجهة">
        <form class="space-y-6" wire:submit="saveUiStrings">

            {{-- Navbar --}}
            <div class="overflow-hidden rounded-3xl border border-gray-50 bg-white shadow-card dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center gap-3 border-b border-gray-100 bg-gray-50/50 px-6 py-4 dark:border-gray-700 dark:bg-gray-700/50">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-orange-100 dark:bg-orange-900/30">
                        <svg class="h-5 w-5 text-orange-700 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-heading text-sm font-bold text-gray-900 dark:text-white">شريط التنقل (Navbar)</h3>
                        <p class="text-xs text-gray-400">اسم المدرسة وزر التسجيل</p>
                    </div>
                </div>
                <div class="grid gap-5 p-6 md:grid-cols-3">
                    <div>
                        <label class="form-label" for="nav_brand_line1">السطر الأول</label>
                        <input class="form-input" id="nav_brand_line1" type="text" wire:model="nav_brand_line1" placeholder="مدارس الندى">
                    </div>
                    <div>
                        <label class="form-label" for="nav_brand_line2">السطر الثاني</label>
                        <input class="form-input" id="nav_brand_line2" type="text" wire:model="nav_brand_line2" placeholder="النموذجية الأهلية">
                    </div>
                    <div>
                        <label class="form-label" for="nav_cta_text">نص زر الـ CTA</label>
                        <input class="form-input" id="nav_cta_text" type="text" wire:model="nav_cta_text" placeholder="سجّل الآن">
                    </div>
                </div>
            </div>

            {{-- About Section strings --}}
            <div class="overflow-hidden rounded-3xl border border-gray-50 bg-white shadow-card dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center gap-3 border-b border-gray-100 bg-gray-50/50 px-6 py-4 dark:border-gray-700 dark:bg-gray-700/50">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-sky-100 dark:bg-sky-900/30">
                        <svg class="h-5 w-5 text-sky-700 dark:text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-heading text-sm font-bold text-gray-900 dark:text-white">قسم من نحن (About)</h3>
                        <p class="text-xs text-gray-400">التسمية التوضيحية وشارات الاعتماد</p>
                    </div>
                </div>
                <div class="grid gap-5 p-6 md:grid-cols-2">
                    <div>
                        <label class="form-label" for="about_year_label">تسمية سنة التأسيس</label>
                        <input class="form-input" id="about_year_label" type="text" wire:model="about_year_label" placeholder="هـ - سنة التأسيس">
                    </div>
                    <div>
                        <label class="form-label" for="about_year_sub">النص الفرعي</label>
                        <input class="form-input" id="about_year_sub" type="text" wire:model="about_year_sub" placeholder="أكثر من 15 عامًا من التميز والعطاء...">
                    </div>
                    <div>
                        <label class="form-label" for="about_badge1_title">شارة الاعتماد — العنوان</label>
                        <input class="form-input" id="about_badge1_title" type="text" wire:model="about_badge1_title" placeholder="جودة معتمدة">
                    </div>
                    <div>
                        <label class="form-label" for="about_badge1_sub">شارة الاعتماد — النص الفرعي</label>
                        <input class="form-input" id="about_badge1_sub" type="text" wire:model="about_badge1_sub" placeholder="وزارة التعليم">
                    </div>
                    <div>
                        <label class="form-label" for="about_badge2_title">شارة البيئة — العنوان</label>
                        <input class="form-input" id="about_badge2_title" type="text" wire:model="about_badge2_title" placeholder="بيئة آمنة">
                    </div>
                    <div>
                        <label class="form-label" for="about_badge2_sub">شارة البيئة — النص الفرعي</label>
                        <input class="form-input" id="about_badge2_sub" type="text" wire:model="about_badge2_sub" placeholder="ومحفّزة للإبداع">
                    </div>
                    <div class="md:col-span-2">
                        <label class="form-label" for="about_cta_text">نص زر التواصل</label>
                        <input class="form-input" id="about_cta_text" type="text" wire:model="about_cta_text" placeholder="تواصل معنا">
                    </div>
                </div>
            </div>

            {{-- Testimonials + Why Us + Contact --}}
            <div class="grid gap-6 lg:grid-cols-3">
                <div class="overflow-hidden rounded-3xl border border-gray-50 bg-white shadow-card dark:border-gray-700 dark:bg-gray-800">
                    <div class="border-b border-gray-100 bg-gray-50/50 px-5 py-3.5 dark:border-gray-700 dark:bg-gray-700/50">
                        <h3 class="font-heading text-sm font-bold text-gray-900 dark:text-white">قسم الآراء</h3>
                    </div>
                    <div class="p-5">
                        <label class="form-label text-xs" for="testimonials_intro">المقدمة</label>
                        <textarea class="form-input min-h-[80px] resize-y" id="testimonials_intro" wire:model="testimonials_intro" rows="3" placeholder="تجارب حقيقية من أولياء أمور وثقوا في مدارس الندى — بأصواتهم وبكلماتهم."></textarea>
                        @error('testimonials_intro') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="overflow-hidden rounded-3xl border border-gray-50 bg-white shadow-card dark:border-gray-700 dark:bg-gray-800">
                    <div class="border-b border-gray-100 bg-gray-50/50 px-5 py-3.5 dark:border-gray-700 dark:bg-gray-700/50">
                        <h3 class="font-heading text-sm font-bold text-gray-900 dark:text-white">قسم لماذا الندى</h3>
                    </div>
                    <div class="p-5">
                        <label class="form-label text-xs" for="why_us_intro">فقرة المقدمة</label>
                        <textarea class="form-input min-h-[80px] resize-y" id="why_us_intro" wire:model="why_us_intro" rows="3" placeholder="نرتب تجربة ولي الأمر حول محاور واضحة..."></textarea>
                        @error('why_us_intro') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="overflow-hidden rounded-3xl border border-gray-50 bg-white shadow-card dark:border-gray-700 dark:bg-gray-800">
                    <div class="border-b border-gray-100 bg-gray-50/50 px-5 py-3.5 dark:border-gray-700 dark:bg-gray-700/50">
                        <h3 class="font-heading text-sm font-bold text-gray-900 dark:text-white">قسم التواصل</h3>
                    </div>
                    <div class="space-y-3 p-5">
                        <div>
                            <label class="form-label text-xs" for="contact_kicker">Kicker</label>
                            <input class="form-input" id="contact_kicker" type="text" wire:model="contact_kicker" placeholder="جاهزون للاستماع">
                        </div>
                        <div>
                            <label class="form-label text-xs" for="contact_intro_title">العنوان</label>
                            <input class="form-input" id="contact_intro_title" type="text" wire:model="contact_intro_title" placeholder="قنوات واضحة للتواصل...">
                        </div>
                        <div>
                            <label class="form-label text-xs" for="contact_intro_text">النص</label>
                            <textarea class="form-input min-h-[60px] resize-y" id="contact_intro_text" wire:model="contact_intro_text" rows="2" placeholder="اختر الوسيلة الأسرع لك..."></textarea>
                        </div>
                    </div>
                </div>

                {{-- Contact Form --}}
                <div class="settings-card">
                    <h3 class="settings-section-title">نموذج التواصل</h3>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="form-label text-xs" for="contact_form_kicker">Kicker</label>
                            <input class="form-input" id="contact_form_kicker" type="text" wire:model="contact_form_kicker" placeholder="راسلنا مباشرة">
                        </div>
                        <div>
                            <label class="form-label text-xs" for="contact_form_title">العنوان</label>
                            <input class="form-input" id="contact_form_title" type="text" wire:model="contact_form_title" placeholder="أرسل لنا رسالة">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="form-label text-xs" for="contact_form_text">النص التوضيحي</label>
                            <textarea class="form-input min-h-[60px] resize-y" id="contact_form_text" wire:model="contact_form_text" rows="2" placeholder="املأ النموذج وسيتابع فريق المدرسة..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                @include('livewire.admin._partials.save-btn', ['target' => 'saveUiStrings', 'label' => 'حفظ النصوص'])
            </div>
        </form>
    </div>
</div>
