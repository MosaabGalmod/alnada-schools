<div>

	{{-- ── Toolbar ──────────────────────────────────────────── --}}
	<div class="mb-6 flex flex-wrap items-center gap-3">
		{{-- Search --}}
		<div class="relative min-w-[200px] flex-1">
			<span class="pointer-events-none absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400">
				<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
				</svg>
			</span>
			<input class="form-input py-2.5 pr-10" type="search" wire:model.live.debounce.300ms="search"
				placeholder="بحث في الإعلانات...">
		</div>

		{{-- Status filter --}}
		<select class="form-input w-auto py-2.5 pl-8 pr-4" wire:model.live="filterStatus">
			<option value="">جميع الحالات</option>
			<option value="published">منشور</option>
			<option value="draft">مسودة</option>
		</select>

		{{-- Add button --}}
		<button class="btn-primary shrink-0 py-2.5" wire:click="openCreate">
			<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
			</svg>
			إعلان جديد
		</button>
	</div>

	{{-- ── Table ────────────────────────────────────────────── --}}
	<div class="overflow-hidden rounded-3xl border border-gray-50 bg-white shadow-card">
		<table class="data-table">
			<thead>
				<tr>
					<th class="w-1/2">العنوان</th>
					<th>التصنيف</th>
					<th>الحالة</th>
					<th>التاريخ</th>
					<th class="w-24 text-center">إجراءات</th>
				</tr>
			</thead>
			<tbody>
				@forelse($announcements as $ann)
					<tr>
						<td>
							<p class="text-sm font-semibold text-gray-900">{{ $ann->title }}</p>
							<p class="mt-0.5 line-clamp-1 text-xs text-gray-400">{{ Str::limit($ann->body, 60) }}</p>
						</td>
						<td>
							<span class="badge {{ $ann->badgeLabel }}">{{ $ann->category }}</span>
						</td>
						<td>
							<button class="group flex cursor-pointer items-center gap-1.5 text-xs font-semibold transition-all duration-200"
								title="انقر للتبديل" wire:click="togglePublish({{ $ann->id }})">
								@if ($ann->is_published)
									<span class="h-2 w-2 rounded-full bg-green-500 transition-colors group-hover:bg-yellow-500"></span>
									<span class="text-green-700 transition-colors group-hover:text-yellow-700">منشور</span>
								@else
									<span class="h-2 w-2 rounded-full bg-gray-300 transition-colors group-hover:bg-green-500"></span>
									<span class="text-gray-500 transition-colors group-hover:text-green-700">مسودة</span>
								@endif
							</button>
						</td>
						<td class="text-xs text-gray-500">
							{{ $ann->published_at?->format("d/m/Y") ?? "—" }}
						</td>
						<td>
							<div class="flex items-center justify-center gap-1.5">
								<button
									class="flex h-8 w-8 items-center justify-center rounded-xl bg-primary-50 text-primary-700 transition-colors hover:bg-primary-100"
									title="تعديل" wire:click="openEdit({{ $ann->id }})">
									<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
											d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
									</svg>
								</button>
								<button
									class="flex h-8 w-8 items-center justify-center rounded-xl bg-red-50 text-red-600 transition-colors hover:bg-red-100"
									title="حذف" wire:click="delete({{ $ann->id }})" wire:confirm="هل أنت متأكد من حذف هذا الإعلان؟">
									<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
											d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
									</svg>
								</button>
							</div>
						</td>
					</tr>
				@empty
					<tr>
						<td class="py-16 text-center text-gray-400" colspan="5">
							<svg class="mx-auto mb-3 h-10 w-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
									d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
							</svg>
							لا توجد إعلانات مطابقة
						</td>
					</tr>
				@endforelse
			</tbody>
		</table>

		{{-- Pagination --}}
		@if ($announcements->hasPages())
			<div class="border-t border-gray-100 px-6 py-4">
				{{ $announcements->links() }}
			</div>
		@endif
	</div>

	{{-- ── Modal ────────────────────────────────────────────── --}}
	@if ($showModal)
		<div class="fixed inset-0 z-50 flex items-center justify-center p-4" x-data x-init="document.body.classList.add('overflow-hidden')"
			x-destroy="document.body.classList.remove('overflow-hidden')">

			{{-- Backdrop --}}
			<div class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm" wire:click="closeModal"></div>

			{{-- Dialog --}}
			<div class="relative w-full max-w-lg overflow-hidden rounded-3xl bg-white shadow-2xl" role="dialog"
				aria-modal="true">

				{{-- Header --}}
				<div class="flex items-center justify-between border-b border-gray-100 px-6 py-5">
					<h3 class="font-heading font-bold text-gray-900">
						{{ $isEditing ? "تعديل الإعلان" : "إضافة إعلان جديد" }}
					</h3>
					<button class="flex h-8 w-8 items-center justify-center rounded-xl bg-gray-100 transition-colors hover:bg-gray-200"
						aria-label="إغلاق" wire:click="closeModal">
						<svg class="h-4 w-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
						</svg>
					</button>
				</div>

				{{-- Body --}}
				<form class="max-h-[70vh] space-y-5 overflow-y-auto p-6" wire:submit="save">

					{{-- Title --}}
					<div>
						<label class="form-label" for="ann-title">العنوان <span class="text-red-500">*</span></label>
						<input class="form-input" id="ann-title" type="text" wire:model="title" placeholder="عنوان الإعلان">
						@error("title")
							<p class="mt-1 text-xs text-red-500">{{ $message }}</p>
						@enderror
					</div>

					{{-- Body --}}
					<div>
						<label class="form-label" for="ann-body">المحتوى <span class="text-red-500">*</span></label>
						<textarea class="form-input resize-none" id="ann-body" wire:model="body" rows="4"
						 placeholder="نص الإعلان..."></textarea>
						@error("body")
							<p class="mt-1 text-xs text-red-500">{{ $message }}</p>
						@enderror
					</div>

					{{-- Category + Badge --}}
					<div class="grid grid-cols-2 gap-4">
						<div>
							<label class="form-label" for="ann-cat">التصنيف</label>
							<input class="form-input" id="ann-cat" type="text" wire:model="category" placeholder="مثال: تسجيل">
							@error("category")
								<p class="mt-1 text-xs text-red-500">{{ $message }}</p>
							@enderror
						</div>
						<div>
							<label class="form-label" for="ann-badge">لون التصنيف</label>
							<select class="form-input" id="ann-badge" wire:model="badge_color">
								<option value="green">أخضر</option>
								<option value="gold">ذهبي</option>
								<option value="blue">أزرق</option>
								<option value="red">أحمر</option>
								<option value="purple">بنفسجي</option>
							</select>
						</div>
					</div>

					{{-- Publish toggle --}}
					<label class="flex cursor-pointer select-none items-center gap-3">
						<input class="peer sr-only" type="checkbox" wire:model="is_published">
						<div
							class="relative h-6 w-10 rounded-full bg-gray-200 transition-colors duration-200 after:absolute after:right-0.5 after:top-0.5 after:h-5 after:w-5 after:rounded-full after:bg-white after:transition-transform after:duration-200 after:content-[''] peer-checked:bg-primary-600 peer-checked:after:-translate-x-4">
						</div>
						<span class="text-sm font-medium text-gray-700">نشر الإعلان مباشرة</span>
					</label>

					{{-- Actions --}}
					<div class="flex items-center gap-3 pt-2">
						<button class="btn-primary flex-1 justify-center py-3" type="submit" wire:loading.attr="disabled"
							wire:target="save">
							<svg class="h-4 w-4 animate-spin" wire:loading wire:target="save" fill="none" stroke="currentColor"
								viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
							</svg>
							<span wire:loading.remove wire:target="save">{{ $isEditing ? "حفظ التعديلات" : "إضافة الإعلان" }}</span>
							<span wire:loading wire:target="save">جاري الحفظ...</span>
						</button>
						<button class="btn-sm rounded-2xl bg-gray-100 px-5 py-3 text-gray-700 hover:bg-gray-200" type="button"
							wire:click="closeModal">
							إلغاء
						</button>
					</div>

				</form>
			</div>
		</div>
	@endif

</div>
