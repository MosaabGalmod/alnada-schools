<div>
	{{-- Flash --}}
	@if ($flashMsg)
		<div
			class="{{ $flashType === "error" ? "bg-red-50 text-red-700 border border-red-200" : "bg-primary-50 text-primary-700 border border-primary-200" }} mb-6 flex items-center gap-3 rounded-2xl px-5 py-3.5 text-sm font-medium"
			x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition:leave="transition ease-in duration-300"
			x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2">
			@if ($flashType === "error")
				<svg class="h-5 w-5 shrink-0 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
				</svg>
			@else
				<svg class="h-5 w-5 shrink-0 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
				</svg>
			@endif
			{{ $flashMsg }}
		</div>
	@endif

	<form class="space-y-8" wire:submit="save">

		{{-- ── Contact Info ──────────────────────────────── --}}
		<div class="overflow-hidden rounded-3xl border border-gray-50 bg-white shadow-card">
			<div class="flex items-center gap-3 border-b border-gray-100 bg-gray-50/50 px-6 py-4">
				<div class="flex h-9 w-9 items-center justify-center rounded-xl bg-primary-100">
					<svg class="h-5 w-5 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
							d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
					</svg>
				</div>
				<div>
					<h3 class="font-heading text-sm font-bold text-gray-900">معلومات التواصل</h3>
					<p class="text-xs text-gray-400">الهاتف والبريد والعنوان وساعات العمل</p>
				</div>
			</div>

			<div class="grid gap-5 p-6 md:grid-cols-2">
				{{-- Phone --}}
				<div>
					<label class="form-label" for="phone">
						رقم الهاتف
						<span class="mr-0.5 text-red-500">*</span>
					</label>
					<div class="relative">
						<span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-gray-400" aria-hidden="true">
							<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
									d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
							</svg>
						</span>
						<input class="form-input pr-10 text-left placeholder:text-right" id="phone" type="tel" wire:model="phone"
							dir="ltr" placeholder="+966 14 848 2306">
					</div>
					@error("phone")
						<p class="mt-1 text-xs text-red-500">{{ $message }}</p>
					@enderror
				</div>

				{{-- Email --}}
				<div>
					<label class="form-label" for="email">
						البريد الإلكتروني
						<span class="mr-0.5 text-red-500">*</span>
					</label>
					<div class="relative">
						<span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-gray-400" aria-hidden="true">
							<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
									d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
							</svg>
						</span>
						<input class="form-input pr-10 text-left placeholder:text-right" id="email" type="email" wire:model="email"
							dir="ltr" placeholder="alnadaiec@gmail.com">
					</div>
					@error("email")
						<p class="mt-1 text-xs text-red-500">{{ $message }}</p>
					@enderror
				</div>

				{{-- Address --}}
				<div class="md:col-span-2">
					<label class="form-label" for="address">
						العنوان
						<span class="mr-0.5 text-red-500">*</span>
					</label>
					<div class="relative">
						<span class="pointer-events-none absolute right-3 top-3.5 text-gray-400" aria-hidden="true">
							<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
									d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
							</svg>
						</span>
						<textarea class="form-input resize-none pr-10" id="address" wire:model="address" rows="2"
						 placeholder="شارع الحسين بن علي، حي البركة، المدينة المنورة 42332"></textarea>
					</div>
					@error("address")
						<p class="mt-1 text-xs text-red-500">{{ $message }}</p>
					@enderror
				</div>

				{{-- Working hours --}}
				<div class="md:col-span-2">
					<label class="form-label" for="working_hours">
						ساعات العمل
						<span class="mr-0.5 text-red-500">*</span>
					</label>
					<div class="relative">
						<span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-gray-400" aria-hidden="true">
							<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
									d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
							</svg>
						</span>
						<input class="form-input pr-10" id="working_hours" type="text" wire:model="working_hours"
							placeholder="الأحد – الخميس: 7:00ص – 1:00م | الجمعة والسبت: مغلق">
					</div>
					@error("working_hours")
						<p class="mt-1 text-xs text-red-500">{{ $message }}</p>
					@enderror
				</div>
			</div>
		</div>

		{{-- ── Social Media ──────────────────────────────── --}}
		<div class="overflow-hidden rounded-3xl border border-gray-50 bg-white shadow-card">
			<div class="flex items-center gap-3 border-b border-gray-100 bg-gray-50/50 px-6 py-4">
				<div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gold-100">
					<svg class="h-5 w-5 text-gold-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
							d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
					</svg>
				</div>
				<div>
					<h3 class="font-heading text-sm font-bold text-gray-900">وسائل التواصل الاجتماعي</h3>
					<p class="text-xs text-gray-400">أدخل اسم المستخدم فقط (بدون الرابط الكامل) — باستثناء واتساب</p>
				</div>
			</div>

			<div class="grid gap-5 p-6 sm:grid-cols-2">
				{{-- Instagram --}}
				<div>
					<label class="form-label" for="instagram">إنستغرام</label>
					<div
						class="flex overflow-hidden rounded-2xl border border-gray-200 bg-gray-50 transition-all focus-within:border-primary-400 focus-within:bg-white focus-within:ring-2 focus-within:ring-primary-400">
						<span
							class="flex shrink-0 items-center gap-1 border-l border-gray-200 bg-gradient-to-b from-purple-50 to-pink-50 px-3 py-3 text-xs text-gray-500">
							<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
								<path
									d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
							</svg>
							instagram.com/
						</span>
						<input class="flex-1 bg-transparent px-3 py-3 text-sm outline-none" id="instagram" type="text"
							wire:model="instagram" dir="ltr" placeholder="alnada_school">
					</div>
					@error("instagram")
						<p class="mt-1 text-xs text-red-500">{{ $message }}</p>
					@enderror
				</div>

				{{-- Twitter / X --}}
				<div>
					<label class="form-label" for="twitter">تويتر / إكس</label>
					<div
						class="flex overflow-hidden rounded-2xl border border-gray-200 bg-gray-50 transition-all focus-within:border-primary-400 focus-within:bg-white focus-within:ring-2 focus-within:ring-primary-400">
						<span
							class="flex shrink-0 items-center gap-1 border-l border-gray-200 bg-gray-50 px-3 py-3 text-xs text-gray-500">
							<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
								<path
									d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.742l7.74-8.855L1.254 2.25H8.08l4.26 5.632L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77z" />
							</svg>
							x.com/
						</span>
						<input class="flex-1 bg-transparent px-3 py-3 text-sm outline-none" id="twitter" type="text"
							wire:model="twitter" dir="ltr" placeholder="AIEC_">
					</div>
					@error("twitter")
						<p class="mt-1 text-xs text-red-500">{{ $message }}</p>
					@enderror
				</div>

				{{-- Facebook --}}
				<div>
					<label class="form-label" for="facebook">فيسبوك</label>
					<div
						class="flex overflow-hidden rounded-2xl border border-gray-200 bg-gray-50 transition-all focus-within:border-primary-400 focus-within:bg-white focus-within:ring-2 focus-within:ring-primary-400">
						<span
							class="flex shrink-0 items-center gap-1 border-l border-gray-200 bg-blue-50 px-3 py-3 text-xs text-gray-500">
							<svg class="h-4 w-4 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
								<path
									d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
							</svg>
							facebook.com/
						</span>
						<input class="flex-1 bg-transparent px-3 py-3 text-sm outline-none" id="facebook" type="text"
							wire:model="facebook" dir="ltr" placeholder="Alnada2021">
					</div>
					@error("facebook")
						<p class="mt-1 text-xs text-red-500">{{ $message }}</p>
					@enderror
				</div>

				{{-- WhatsApp --}}
				<div>
					<label class="form-label" for="whatsapp">
						واتساب
						<span class="text-xs font-normal text-gray-400">(رقم الهاتف بدون + أو مسافات)</span>
					</label>
					<div
						class="flex overflow-hidden rounded-2xl border border-gray-200 bg-gray-50 transition-all focus-within:border-primary-400 focus-within:bg-white focus-within:ring-2 focus-within:ring-primary-400">
						<span
							class="flex shrink-0 items-center gap-1 border-l border-gray-200 bg-green-50 px-3 py-3 text-xs text-gray-500">
							<svg class="h-4 w-4 text-green-600" fill="currentColor" viewBox="0 0 24 24">
								<path
									d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
							</svg>
							wa.me/
						</span>
						<input class="flex-1 bg-transparent px-3 py-3 text-sm outline-none" id="whatsapp" type="tel"
							wire:model="whatsapp" dir="ltr" placeholder="966559281924">
					</div>
					@error("whatsapp")
						<p class="mt-1 text-xs text-red-500">{{ $message }}</p>
					@enderror
				</div>
			</div>
		</div>

		{{-- ── Save Button ───────────────────────────────── --}}
		<div class="flex items-center justify-between">
			<p class="text-xs text-gray-400">
				<span class="text-red-400">*</span> حقول إلزامية
			</p>
			<button class="btn-primary" type="submit" wire:loading.attr="disabled"
				wire:loading.class="opacity-75 cursor-not-allowed">
				<span wire:loading.remove>
					<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
					</svg>
					حفظ الإعدادات
				</span>
				<span class="flex items-center gap-2" wire:loading>
					<svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
						<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
						</circle>
						<path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
					</svg>
					جاري الحفظ...
				</span>
			</button>
		</div>

	</form>
</div>
