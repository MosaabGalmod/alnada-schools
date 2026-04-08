<div>
	@php use App\View\Support\IconLibrary; $iconOptions = IconLibrary::all(); @endphp
	{{-- Flash --}}
	@if ($flashMsg)
		<div
			class="{{ $flashType === "error" ? "bg-red-50 text-red-700 border border-red-200" : "bg-primary-50 text-primary-700 border border-primary-200" }} mb-4 flex items-center gap-2 rounded-2xl px-4 py-3 text-sm font-medium"
			x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3500)" x-transition:leave="transition ease-in duration-300"
			x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
			@if ($flashType === "error")
				<svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
				</svg>
			@else
				<svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
				</svg>
			@endif
			{{ $flashMsg }}
		</div>
	@endif

	{{-- Header --}}
	<div class="mb-6 flex items-center justify-between">
		<div>
			<h2 class="font-heading text-xl font-bold text-gray-900">إدارة أقسام الموقع</h2>
			<p class="mt-0.5 text-sm text-gray-500">رتّب وعدّل ظهور وأقسام الصفحة الرئيسية</p>
		</div>
		<button class="btn-primary text-sm" wire:click="openAddModal">
			<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
			</svg>
			إضافة قسم
		</button>
	</div>

	{{-- Sections table --}}
	<div class="overflow-hidden rounded-3xl border border-gray-50 bg-white shadow-card">
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
				@foreach ($sections as $i => $sec)
					<tr wire:key="sec-{{ $sec["id"] }}">
						<td class="font-mono text-xs text-gray-400">{{ $sec["sort_order"] }}</td>
						<td>
							<div class="text-sm font-semibold text-gray-800">{{ $sec["label"] }}</div>
							<div class="font-mono text-xs text-gray-400">{{ $sec["key"] }}</div>
						</td>
						<td>
							<span
								class="badge {{ match ($sec["type"]) {
								    "hero" => "badge-green",
								    "about" => "badge-blue",
								    "programs" => "badge-purple",
								    "stats" => "badge-gold",
								    "why_us" => "badge-green",
								    "news" => "badge-blue",
								    "testimonials" => "badge-purple",
								    "contact" => "badge-gold",
								    default => "bg-gray-100 text-gray-700",
								} }}">{{ $sec["type"] }}</span>
						</td>
						<td>
							<button
								class="{{ $sec["is_visible"] ? "bg-primary-100 text-primary-700 hover:bg-primary-200" : "bg-gray-100 text-gray-500 hover:bg-gray-200" }} inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-semibold transition-all"
								wire:click="toggleVisibility({{ $sec["id"] }})">
								@if ($sec["is_visible"])
									<svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
									</svg>
									ظاهر
								@else
									<svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
									</svg>
									مخفي
								@endif
							</button>
						</td>
						<td>
							<div class="flex items-center justify-center gap-1">
								<button
									class="flex h-7 w-7 items-center justify-center rounded-lg bg-gray-100 text-gray-500 transition-all hover:bg-primary-100 hover:text-primary-700"
									title="تحريك لأعلى" wire:click="moveUp({{ $sec["id"] }})">
									<svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
									</svg>
								</button>
								<button
									class="flex h-7 w-7 items-center justify-center rounded-lg bg-gray-100 text-gray-500 transition-all hover:bg-primary-100 hover:text-primary-700"
									title="تحريك لأسفل" wire:click="moveDown({{ $sec["id"] }})">
									<svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
									</svg>
								</button>
							</div>
						</td>
						<td>
							<div class="flex items-center justify-center gap-2">
								{{-- Edit content --}}
								<button class="btn-sm bg-primary-50 text-primary-700 hover:bg-primary-100" title="تعديل المحتوى"
									wire:click="openEditModal({{ $sec["id"] }})">
									<svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
									</svg>
									المحتوى
								</button>
								{{-- Edit style --}}
								<button class="btn-sm bg-gold-100 text-gold-700 hover:bg-gold-200" title="تعديل الأنماط"
									wire:click="openStyleModal({{ $sec["id"] }})">
									<svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
									</svg>
									الأنماط
								</button>
								{{-- Duplicate --}}
								<button class="btn-sm bg-teal-50 text-teal-700 hover:bg-teal-100" title="نسخ القسم"
									wire:click="duplicateSection({{ $sec['id'] }})" wire:confirm="سيتم إنشاء نسخة من هذا القسم. تأكيد؟">
									<svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
									</svg>
									نسخ
								</button>
								{{-- Delete: warning stronger for built-in --}}
								<button class="btn-sm bg-red-50 text-red-600 hover:bg-red-100" title="حذف"
									wire:click="deleteSection({{ $sec['id'] }})"
									wire:confirm="{{ $sec['type'] !== 'custom' ? 'تحذير: هذا قسم أساسي. حذفه سيتطلب استعادته يدوياً. هل تريد المتابعة؟' : 'هل أنت متأكد من حذف هذا القسم؟' }}">
									<svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
									</svg>
								</button>
							</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	{{-- ========== RESTORE BUILT-IN PANEL ========== --}}
	@php
		$existingTypes = collect($sections)->pluck('type')->unique()->toArray();
		$restorable = collect([
			['type' => 'hero',         'label' => 'الهيرو'],
			['type' => 'about',        'label' => 'من نحن'],
			['type' => 'news',         'label' => 'الأخبار'],
			['type' => 'contact',      'label' => 'تواصل معنا'],
		])->filter(fn($b) => !in_array($b['type'], $existingTypes));
	@endphp
	@if ($restorable->isNotEmpty())
		<div class="mt-4 rounded-2xl border border-amber-200 bg-amber-50 p-4 dark:border-amber-800 dark:bg-amber-950">
			<p class="mb-3 flex items-center gap-2 text-sm font-semibold text-amber-800 dark:text-amber-300">
				<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M12 3a9 9 0 100 18A9 9 0 0012 3z"/>
				</svg>
				أقسام أساسية محذوفة — يمكنك استعادتها
			</p>
			<div class="flex flex-wrap gap-2">
				@foreach ($restorable as $b)
					<button class="btn-sm bg-amber-100 text-amber-800 hover:bg-amber-200 dark:bg-amber-900 dark:text-amber-200"
						wire:click="restoreBuiltIn('{{ $b['type'] }}')" wire:confirm="استعادة قسم {{ $b['label'] }}؟">
						<svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
						</svg>
						استعادة {{ $b['label'] }}
					</button>
				@endforeach
			</div>
		</div>
	@endif

	{{-- ========== EDIT CONTENT MODAL ========== --}}
	@if ($showEditModal)
		<div class="fixed inset-0 z-50 flex items-start justify-center px-4 pt-16" x-data x-init="$el.querySelector('[data-backdrop]').addEventListener('click', () => $wire.set('showEditModal', false))">
			{{-- Backdrop --}}
			<div class="absolute inset-0 bg-black/40 backdrop-blur-sm" data-backdrop></div>

			<div class="relative flex max-h-[80vh] w-full max-w-2xl flex-col rounded-4xl bg-white shadow-clay-lg">
				{{-- Header --}}
				<div class="flex items-center justify-between border-b border-gray-100 p-6">
					<h3 class="font-heading text-lg font-bold text-gray-900">تعديل محتوى القسم</h3>
					<button
						class="flex h-8 w-8 items-center justify-center rounded-xl bg-gray-100 transition-colors hover:bg-gray-200"
						wire:click="$set('showEditModal', false)">
						<svg class="h-4 w-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
						</svg>
					</button>
				</div>

				{{-- Body --}}
				<div class="flex-1 space-y-4 overflow-y-auto p-6">
					{{-- Label --}}
					<div>
						<label class="form-label">اسم القسم في لوحة التحكم</label>
						<input class="form-input" type="text" wire:model="editLabel" placeholder="مثال: قسم الترحيب">
					</div>

					@php
						$section = collect($sections)->firstWhere("id", $editingId);
						$fields = $section ? $this->getFieldsForType($section["type"]) : [];
						$fieldLabels = [
						    "badge" => "شارة (Badge)",
						    "title" => "العنوان الرئيسي",
						    "title_accent" => "العنوان المميز (بلون مختلف)",
						    "subtitle" => "النص الفرعي",
						    "body" => "النص الرئيسي (يدعم >> للبرز، - للنقاط)",
						    "body1" => "الفقرة الأولى",
						    "body2" => "الفقرة الثانية",
						    "tag" => "تاج القسم (فوق العنوان)",
						    "cta_primary" => "نص زر الدعوة الأول",
						    "cta_secondary" => "نص زر الدعوة الثاني",
						    "founding_year" => "سنة التأسيس (هجري)",
						    "vision_title" => "عنوان الرؤية",
						    "vision_body" => "نص الرؤية",
						    "mission_title" => "عنوان الرسالة",
						    "mission_body" => "نص الرسالة",
						    "values_title" => "عنوان القيم",
						    "values_body" => "نص القيم",
						    "accessibility_note" => "ملاحظة إمكانية الوصول",
						    "intro_card_title" => "عنوان الكارت الجانبي (اختياري)",
						    "intro_card_body" => "نص الكارت الجانبي (اختياري)",
						];
					@endphp

					@foreach ($fields as $field)
						<div>
							<label class="form-label">{{ $fieldLabels[$field] ?? $field }}</label>
							@if (in_array($field, [
									"body",
									"body1",
									"body2",
									"subtitle",
									"vision_body",
									"mission_body",
									"values_body",
									"accessibility_note",
									"intro_card_body",
								]))
								<textarea class="form-input resize-none" wire:model="editContent.{{ $field }}" rows="3"
								 placeholder="{{ $fieldLabels[$field] ?? $field }}"></textarea>
							@else
								<input class="form-input" type="text" wire:model="editContent.{{ $field }}"
									placeholder="{{ $fieldLabels[$field] ?? $field }}">
							@endif
						</div>
					@endforeach

					{{-- ── Hero Stats Repeater ─────────────────────── --}}
					@if (($section["type"] ?? "") === "hero")
						<div class="space-y-3">
							<div class="flex items-center justify-between">
								<label class="form-label mb-0">إحصائيات قسم الهيرو</label>
								<button class="btn-sm bg-primary-50 text-xs text-primary-700 hover:bg-primary-100" type="button"
									wire:click="addHeroStat">
									<svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
									</svg>
									إضافة إحصائية
								</button>
							</div>
							@foreach ($editContent["stats"] ?? [] as $i => $stat)
								<div class="flex items-start gap-2 rounded-2xl border border-gray-100 bg-gray-50 p-3"
									wire:key="hero-stat-{{ $i }}">
									<div class="grid flex-1 grid-cols-2 gap-2">
										<input class="form-input text-sm" type="text" wire:model="editContent.stats.{{ $i }}.value"
											placeholder="500+">
										<input class="form-input text-sm" type="text" wire:model="editContent.stats.{{ $i }}.label"
											placeholder="طالب وطالبة">
									</div>
									<button
										class="mt-1 flex h-7 w-7 shrink-0 items-center justify-center rounded-xl bg-red-50 text-red-500 hover:bg-red-100"
										type="button" wire:click="removeHeroStat({{ $i }})">
										<svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
										</svg>
									</button>
								</div>
							@endforeach
							@if (empty($editContent["stats"]))
								<p class="py-2 text-center text-xs text-gray-400">لا توجد إحصائيات — اضغط "إضافة إحصائية"</p>
							@endif
						</div>
					@endif

					{{-- ── Programs Repeater ────────────────────────── --}}
					@if (($section["type"] ?? "") === "programs")
						<div class="space-y-3">
							<div class="flex items-center justify-between">
								<label class="form-label mb-0">البرامج التعليمية</label>
								<button class="btn-sm bg-primary-50 text-xs text-primary-700 hover:bg-primary-100" type="button"
									wire:click="addProgram">
									<svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
									</svg>
									إضافة برنامج
								</button>
							</div>
							@foreach ($editContent["programs"] ?? [] as $i => $prog)
								<div class="space-y-2 rounded-2xl border border-gray-100 bg-gray-50 p-4" wire:key="prog-{{ $i }}">
									<div class="mb-1 flex items-center justify-between">
										<span class="text-xs font-bold text-gray-500">برنامج {{ $i + 1 }}</span>
										<button class="flex h-6 w-6 items-center justify-center rounded-lg bg-red-50 text-red-500 hover:bg-red-100"
											type="button" wire:click="removeProgram({{ $i }})">
											<svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
											</svg>
										</button>
									</div>
									<input class="form-input text-sm" type="text"
										wire:model="editContent.programs.{{ $i }}.title" placeholder="عنوان البرنامج">
									<textarea class="form-input resize-none text-sm" wire:model="editContent.programs.{{ $i }}.description"
									 rows="2" placeholder="وصف البرنامج"></textarea>
									<input class="form-input text-sm" type="text" wire:model="editContent.programs.{{ $i }}.tags"
										placeholder="التصنيفات (مفصولة بفاصلة)">
									<div class="grid grid-cols-2 gap-2">
										<select class="form-input text-sm" wire:model="editContent.programs.{{ $i }}.color">
											<option value="green">أخضر</option>
											<option value="blue">أزرق</option>
											<option value="purple">بنفسجي</option>
											<option value="gold">ذهبي</option>
											<option value="red">أحمر</option>
											<option value="teal">تيل</option>
										</select>
										<div class="relative">
											<span class="pointer-events-none absolute inset-y-0 start-2.5 flex items-center">
												<svg class="h-4 w-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
													<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
														d="{{ IconLibrary::path($prog['icon'] ?? 'book') }}" />
												</svg>
											</span>
											<select class="form-input ps-9 text-sm" wire:model="editContent.programs.{{ $i }}.icon">
												@foreach ($iconOptions as $key => $ico)
													<option value="{{ $key }}">{{ $ico['label'] }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
							@endforeach
							@if (empty($editContent["programs"]))
								<p class="py-2 text-center text-xs text-gray-400">لا توجد برامج — اضغط "إضافة برنامج"</p>
							@endif
						</div>
					@endif

					{{-- ── Stats Items Repeater ─────────────────────── --}}
					@if (($section["type"] ?? "") === "stats")
						<div class="space-y-3">
							<div class="flex items-center justify-between">
								<label class="form-label mb-0">عناصر الإحصائيات</label>
								<button class="btn-sm bg-primary-50 text-xs text-primary-700 hover:bg-primary-100" type="button"
									wire:click="addStatItem">
									<svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
									</svg>
									إضافة رقم
								</button>
							</div>
							@foreach ($editContent["items"] ?? [] as $i => $item)
								<div class="flex items-start gap-2 rounded-2xl border border-gray-100 bg-gray-50 p-3"
									wire:key="stat-{{ $i }}">
									<div class="grid flex-1 grid-cols-2 gap-2">
										<input class="form-input text-sm" type="number" wire:model="editContent.items.{{ $i }}.target"
											placeholder="500">
										<input class="form-input text-sm" type="text" wire:model="editContent.items.{{ $i }}.label"
											placeholder="طالب وطالبة">
										<input class="form-input text-sm" type="text" wire:model="editContent.items.{{ $i }}.suffix"
											placeholder="+" maxlength="3">
										<div class="relative">
											<span class="pointer-events-none absolute inset-y-0 start-2.5 flex items-center">
												<svg class="h-4 w-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
													<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
														d="{{ IconLibrary::path($item['icon'] ?? 'heart') }}" />
												</svg>
											</span>
											<select class="form-input ps-9 text-sm" wire:model="editContent.items.{{ $i }}.icon">
												@foreach ($iconOptions as $key => $ico)
													<option value="{{ $key }}">{{ $ico['label'] }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<button
										class="mt-1 flex h-7 w-7 shrink-0 items-center justify-center rounded-xl bg-red-50 text-red-500 hover:bg-red-100"
										type="button" wire:click="removeStatItem({{ $i }})">
										<svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
										</svg>
									</button>
								</div>
							@endforeach
							@if (empty($editContent["items"]))
								<p class="py-2 text-center text-xs text-gray-400">لا توجد أرقام — اضغط "إضافة رقم"</p>
							@endif
							<p class="text-xs text-gray-400">الرقم: يبدأ الكاونتر منه | اللاحقة: مثل + أو %</p>
						</div>
					@endif

					{{-- ── Why Us Features Repeater ─────────────────── --}}
					@if (($section["type"] ?? "") === "why_us")
						<div class="space-y-3">
							<div class="flex items-center justify-between">
								<label class="form-label mb-0">مميزات "لماذا الندى؟"</label>
								<button class="btn-sm bg-primary-50 text-xs text-primary-700 hover:bg-primary-100" type="button"
									wire:click="addFeature">
									<svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
									</svg>
									إضافة ميزة
								</button>
							</div>
							@foreach ($editContent["features"] ?? [] as $i => $feat)
								<div class="space-y-2 rounded-2xl border border-gray-100 bg-gray-50 p-4" wire:key="feat-{{ $i }}">
									<div class="mb-1 flex items-center justify-between">
										<span class="text-xs font-bold text-gray-500">ميزة {{ $i + 1 }}</span>
										<button class="flex h-6 w-6 items-center justify-center rounded-lg bg-red-50 text-red-500 hover:bg-red-100"
											type="button" wire:click="removeFeature({{ $i }})">
											<svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
											</svg>
										</button>
									</div>
									<input class="form-input text-sm" type="text"
										wire:model="editContent.features.{{ $i }}.title" placeholder="عنوان الميزة">
									<textarea class="form-input resize-none text-sm" wire:model="editContent.features.{{ $i }}.body"
									 rows="2" placeholder="وصف الميزة"></textarea>
									<div class="relative">
										<span class="pointer-events-none absolute inset-y-0 start-2.5 flex items-center">
											<svg class="h-4 w-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
													d="{{ IconLibrary::path($feat['icon'] ?? 'badge-check') }}" />
											</svg>
										</span>
										<select class="form-input ps-9 text-sm" wire:model="editContent.features.{{ $i }}.icon">
											@foreach ($iconOptions as $key => $ico)
												<option value="{{ $key }}">{{ $ico['label'] }}</option>
											@endforeach
										</select>
									</div>
								</div>
							@endforeach
							@if (empty($editContent["features"]))
								<p class="py-2 text-center text-xs text-gray-400">لا توجد مميزات — اضغط "إضافة ميزة"</p>
							@endif
						</div>
					@endif

					{{-- ── Testimonials Repeater ────────────────────── --}}
					@if (($section["type"] ?? "") === "testimonials")
						<div class="space-y-3">
							<div class="flex items-center justify-between">
								<label class="form-label mb-0">آراء أولياء الأمور</label>
								<button class="btn-sm bg-primary-50 text-xs text-primary-700 hover:bg-primary-100" type="button"
									wire:click="addTestimonial">
									<svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
									</svg>
									إضافة رأي
								</button>
							</div>
							@foreach ($editContent["items"] ?? [] as $i => $item)
								<div class="space-y-2 rounded-2xl border border-gray-100 bg-gray-50 p-4"
									wire:key="testi-{{ $i }}">
									<div class="mb-1 flex items-center justify-between">
										<span class="text-xs font-bold text-gray-500">رأي {{ $i + 1 }}</span>
										<button class="flex h-6 w-6 items-center justify-center rounded-lg bg-red-50 text-red-500 hover:bg-red-100"
											type="button" wire:click="removeTestimonial({{ $i }})">
											<svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
											</svg>
										</button>
									</div>
									<textarea class="form-input resize-none text-sm" wire:model="editContent.items.{{ $i }}.text"
									 rows="3" placeholder="نص الرأي..."></textarea>
									<div class="grid grid-cols-3 gap-2">
										<input class="form-input text-sm" type="text" wire:model="editContent.items.{{ $i }}.name"
											placeholder="الاسم">
										<input class="form-input text-sm" type="text" wire:model="editContent.items.{{ $i }}.role"
											placeholder="الدور (ولي أمر - التوحد)">
										<input class="form-input text-sm" type="text" wire:model="editContent.items.{{ $i }}.avatar"
											placeholder="أول حرف (أم)">
									</div>
								</div>
							@endforeach
							@if (empty($editContent["items"]))
								<p class="py-2 text-center text-xs text-gray-400">لا توجد آراء — اضغط "إضافة رأي"</p>
							@endif
						</div>
					@endif
				</div>

				{{-- Footer --}}
				<div class="flex justify-end gap-3 border-t border-gray-100 p-6">
					<button class="btn-sm bg-gray-100 px-5 py-2.5 text-gray-700 hover:bg-gray-200"
						wire:click="$set('showEditModal', false)">إلغاء</button>
					<button class="btn-primary text-sm" wire:click="saveContent">
						<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
						</svg>
						حفظ التغييرات
					</button>
				</div>
			</div>
		</div>
	@endif

	{{-- ========== STYLE MODAL ========== --}}
	@if ($showStyleModal)
		<div class="fixed inset-0 z-50 flex items-start justify-center px-4 pt-16" x-data x-init="$el.querySelector('[data-backdrop]').addEventListener('click', () => $wire.set('showStyleModal', false))">
			<div class="absolute inset-0 bg-black/40 backdrop-blur-sm" data-backdrop></div>

			<div class="relative flex max-h-[80vh] w-full max-w-xl flex-col rounded-4xl bg-white shadow-clay-lg">
				<div class="flex items-center justify-between border-b border-gray-100 p-6">
					<h3 class="font-heading text-lg font-bold text-gray-900">تعديل أنماط القسم</h3>
					<button
						class="flex h-8 w-8 items-center justify-center rounded-xl bg-gray-100 transition-colors hover:bg-gray-200"
						wire:click="$set('showStyleModal', false)">
						<svg class="h-4 w-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
						</svg>
					</button>
				</div>

				<div class="flex-1 space-y-5 overflow-y-auto p-6">
					{{-- Background type --}}
					<div>
						<label class="form-label">نوع الخلفية</label>
						<select class="form-input" wire:model.live="editStyle.bg_type">
							<option value="white">أبيض (افتراضي)</option>
							<option value="wave">متدرج فاتح (موجة)</option>
							<option value="gradient">متدرج مخصص</option>
							<option value="solid">لون صلب</option>
							<option value="dark">داكن</option>
						</select>
					</div>

					{{-- Gradient colors --}}
					@if (($editStyle["bg_type"] ?? "white") === "gradient")
						<div class="grid grid-cols-2 gap-4">
							<div>
								<label class="form-label">لون البداية</label>
								<div class="flex gap-2">
									<input class="h-10 w-14 cursor-pointer rounded-xl border border-gray-200 p-0.5" type="color"
										wire:model.live="editStyle.bg_from">
									<input class="form-input flex-1 font-mono text-sm" type="text" wire:model.live="editStyle.bg_from"
										placeholder="#061f2c">
								</div>
							</div>
							<div>
								<label class="form-label">لون النهاية</label>
								<div class="flex gap-2">
									<input class="h-10 w-14 cursor-pointer rounded-xl border border-gray-200 p-0.5" type="color"
										wire:model.live="editStyle.bg_to">
									<input class="form-input flex-1 font-mono text-sm" type="text" wire:model.live="editStyle.bg_to"
										placeholder="#1a9dc6">
								</div>
							</div>
						</div>
					@endif

					{{-- Solid color --}}
					@if (($editStyle["bg_type"] ?? "white") === "solid")
						<div>
							<label class="form-label">لون الخلفية</label>
							<div class="flex gap-2">
								<input class="h-10 w-14 cursor-pointer rounded-xl border border-gray-200 p-0.5" type="color"
									wire:model.live="editStyle.bg_color">
								<input class="form-input flex-1 font-mono text-sm" type="text" wire:model.live="editStyle.bg_color"
									placeholder="#ffffff">
							</div>
						</div>
					@endif

					{{-- Text colors --}}
					<div class="grid grid-cols-2 gap-4">
						<div>
							<label class="form-label">لون العنوان</label>
							<div class="flex gap-2">
								<input class="h-10 w-14 cursor-pointer rounded-xl border border-gray-200 p-0.5" type="color"
									wire:model.live="editStyle.heading_color">
								<input class="form-input flex-1 font-mono text-sm" type="text" wire:model.live="editStyle.heading_color">
							</div>
						</div>
						<div>
							<label class="form-label">لون النص</label>
							<div class="flex gap-2">
								<input class="h-10 w-14 cursor-pointer rounded-xl border border-gray-200 p-0.5" type="color"
									wire:model.live="editStyle.text_color">
								<input class="form-input flex-1 font-mono text-sm" type="text" wire:model.live="editStyle.text_color">
							</div>
						</div>
					</div>

					{{-- Accent color --}}
					<div>
						<label class="form-label">اللون المميز (Accent)</label>
						<div class="flex gap-2">
							<input class="h-10 w-14 cursor-pointer rounded-xl border border-gray-200 p-0.5" type="color"
								wire:model.live="editStyle.accent_color">
							<input class="form-input flex-1 font-mono text-sm" type="text" wire:model.live="editStyle.accent_color"
								placeholder="#1a9dc6">
						</div>
					</div>

					{{-- Font size --}}
					<div>
						<label class="form-label">حجم الخط</label>
						<select class="form-input" wire:model.live="editStyle.font_size">
							<option value="normal">عادي (افتراضي)</option>
							<option value="large">كبير</option>
							<option value="small">صغير</option>
						</select>
					</div>

					{{-- Live preview --}}
					<div class="overflow-hidden rounded-2xl border border-gray-200">
						<div class="border-b border-gray-200 bg-gray-50 px-3 py-1.5 text-xs font-semibold text-gray-500">معاينة مباشرة
						</div>
						<div class="p-6 text-center"
							style="
            {{ match ($editStyle["bg_type"] ?? "white") {
												    "gradient" => "background: linear-gradient(150deg, " .
												        ($editStyle["bg_from"] ?? "#061f2c") .
												        " 0%, " .
												        ($editStyle["bg_to"] ?? "#1a9dc6") .
												        " 100%)",
												    "solid" => "background-color: " . ($editStyle["bg_color"] ?? "#ffffff"),
												    "wave" => "background: linear-gradient(135deg,#f0f9fd 0%,#daf1fa 100%)",
												    "dark" => "background: linear-gradient(150deg,#061f2c 0%,#0d4858 100%)",
												    default => "background:#ffffff",
												} }}">
							<p class="mb-1 font-heading text-lg font-bold" style="color: {{ $editStyle["heading_color"] ?? "#111827" }}">
								عنوان القسم</p>
							<p class="text-sm" style="color: {{ $editStyle["text_color"] ?? "#374151" }}">نص توضيحي للقسم</p>
							<span class="mt-2 inline-block rounded-full px-3 py-1 text-xs font-semibold"
								style="background: {{ $editStyle["accent_color"] ?? "#1a9dc6" }}20; color: {{ $editStyle["accent_color"] ?? "#1a9dc6" }}">تاج
								القسم</span>
						</div>
					</div>
				</div>

				<div class="flex justify-end gap-3 border-t border-gray-100 p-6">
					<button class="btn-sm bg-gray-100 px-5 py-2.5 text-gray-700 hover:bg-gray-200"
						wire:click="$set('showStyleModal', false)">إلغاء</button>
					<button class="btn-primary text-sm" wire:click="saveStyle">
						<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
						</svg>
						حفظ الأنماط
					</button>
				</div>
			</div>
		</div>
	@endif

	{{-- ========== ADD SECTION MODAL ========== --}}
	@if ($showAddModal)
		<div class="fixed inset-0 z-50 flex items-center justify-center px-4" x-data x-init="$el.querySelector('[data-backdrop]').addEventListener('click', () => $wire.set('showAddModal', false))">
			<div class="absolute inset-0 bg-black/40 backdrop-blur-sm" data-backdrop></div>

			<div class="relative w-full max-w-md rounded-4xl bg-white p-6 shadow-clay-lg">
				<div class="mb-6 flex items-center justify-between">
					<h3 class="font-heading text-lg font-bold text-gray-900">إضافة قسم جديد</h3>
					<button
						class="flex h-8 w-8 items-center justify-center rounded-xl bg-gray-100 transition-colors hover:bg-gray-200"
						wire:click="$set('showAddModal', false)">
						<svg class="h-4 w-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
						</svg>
					</button>
				</div>

				<div class="space-y-4">
					<div>
						<label class="form-label">اسم القسم <span class="text-red-500">*</span></label>
						<input class="form-input" type="text" wire:model="newLabel" placeholder="مثال: قسم خاص بالأنشطة"
							wire:keydown.enter="createSection" autofocus>
						@error("newLabel")
							<p class="mt-1 text-xs text-red-500">{{ $message }}</p>
						@enderror
					</div>
					<p class="text-xs text-gray-400">سيُنشأ قسم مخصص من نوع "custom" يمكنك تعديل محتواه وأنماطه بعد الإنشاء.</p>
				</div>

				<div class="mt-6 flex justify-end gap-3">
					<button class="btn-sm bg-gray-100 px-5 py-2.5 text-gray-700 hover:bg-gray-200"
						wire:click="$set('showAddModal', false)">إلغاء</button>
					<button class="btn-primary text-sm" wire:click="createSection">
						<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
						</svg>
						إنشاء القسم
					</button>
				</div>
			</div>
		</div>
	@endif
</div>
