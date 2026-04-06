<div class="flex h-[calc(100vh-10rem)] gap-6">
	{{-- ── Messages List ────────────────────────────────────── --}}
	<div class="{{ $showViewer ? "hidden lg:flex lg:w-2/5" : "flex-1" }} flex flex-col">

		{{-- Toolbar --}}
		<div class="mb-4 flex flex-wrap items-center gap-3">
			<div class="relative min-w-[180px] flex-1">
				<span class="pointer-events-none absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400">
					<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
					</svg>
				</span>
				<input class="form-input py-2.5 pr-10" type="search" wire:model.live.debounce.300ms="search"
					placeholder="بحث في الرسائل...">
			</div>
			<select class="form-input w-auto py-2.5" wire:model.live="filterRead">
				<option value="">الكل</option>
				<option value="unread">غير المقروءة</option>
				<option value="read">المقروءة</option>
			</select>
		</div>

		{{-- List --}}
		<div class="flex-1 overflow-hidden overflow-y-auto rounded-3xl border border-gray-50 bg-white shadow-card">
			<div class="divide-y divide-gray-50">
				@forelse($messages as $msg)
					<button
						class="{{ !$msg->is_read ? "bg-primary-50/50" : "hover:bg-gray-50" }} {{ $viewingId === $msg->id ? "bg-primary-100/70" : "" }} flex w-full cursor-pointer items-start gap-3 px-5 py-4 text-right transition-colors duration-150"
						wire:click="view({{ $msg->id }})">

						{{-- Avatar --}}
						<div
							class="{{ !$msg->is_read ? "bg-primary-600 text-white" : "bg-gray-100 text-gray-600" }} flex h-9 w-9 shrink-0 items-center justify-center rounded-xl text-sm font-bold">
							{{ mb_substr($msg->name, 0, 1) }}
						</div>

						<div class="min-w-0 flex-1">
							<div class="flex items-center justify-between gap-1.5">
								<span
									class="font-{{ $msg->is_read ? "medium" : "bold" }} truncate text-sm text-gray-900">{{ $msg->name }}</span>
								@if (!$msg->is_read)
									<span class="h-2 w-2 shrink-0 rounded-full bg-primary-500"></span>
								@endif
							</div>
							@if ($msg->subject)
								<p class="mt-0.5 truncate text-xs font-medium text-gray-600">{{ $msg->subject }}</p>
							@endif
							<p class="mt-0.5 truncate text-xs text-gray-400">{{ Str::limit($msg->message, 55) }}</p>
							<p class="mt-1 text-[10px] text-gray-400">{{ $msg->created_at->diffForHumans() }}</p>
						</div>
					</button>
				@empty
					<div class="py-20 text-center text-gray-400">
						<svg class="mx-auto mb-3 h-10 w-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
								d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
						</svg>
						لا توجد رسائل
					</div>
				@endforelse
			</div>

			{{-- Pagination --}}
			@if ($messages->hasPages())
				<div class="border-t border-gray-100 px-5 py-4">
					{{ $messages->links() }}
				</div>
			@endif
		</div>
	</div>

	{{-- ── Message Viewer ───────────────────────────────────── --}}
	@if ($showViewer && $viewing)
		<div class="flex flex-1 flex-col overflow-hidden rounded-3xl border border-gray-50 bg-white shadow-card">

			{{-- Viewer header --}}
			<div class="flex items-center gap-3 border-b border-gray-100 px-6 py-4">
				<button
					class="flex h-8 w-8 items-center justify-center rounded-xl bg-gray-100 transition-colors hover:bg-gray-200 lg:hidden"
					aria-label="رجوع" wire:click="closeViewer">
					<svg class="h-4 w-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
					</svg>
				</button>

				<div
					class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-primary-100 text-sm font-bold text-primary-700">
					{{ mb_substr($viewing->name, 0, 1) }}
				</div>
				<div class="min-w-0 flex-1">
					<div class="font-bold text-gray-900">{{ $viewing->name }}</div>
					<div class="text-xs text-gray-500">{{ $viewing->email }} @if ($viewing->phone)
							· {{ $viewing->phone }}
						@endif
					</div>
				</div>
				<div class="flex shrink-0 items-center gap-2">
					<button
						class="flex h-8 w-8 items-center justify-center rounded-xl bg-red-50 text-red-600 transition-colors hover:bg-red-100"
						title="حذف" wire:click="delete({{ $viewing->id }})" wire:confirm="هل أنت متأكد من حذف هذه الرسالة؟">
						<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
								d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
						</svg>
					</button>
				</div>
			</div>

			{{-- Message content --}}
			<div class="flex-1 overflow-y-auto p-6">
				@if ($viewing->subject)
					<h4 class="mb-4 font-heading text-base font-bold text-gray-900">{{ $viewing->subject }}</h4>
				@endif

				<div class="whitespace-pre-wrap rounded-2xl bg-gray-50 p-5 text-sm leading-relaxed text-gray-700">
					{{ $viewing->message }}</div>

				<div class="mt-6 flex flex-wrap gap-4 text-xs text-gray-500">
					<span class="flex items-center gap-1.5">
						<svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
						</svg>
						{{ $viewing->created_at->format("d/m/Y، h:i A") }}
					</span>
					@if ($viewing->email)
						<a class="flex items-center gap-1.5 text-primary-600 hover:underline" href="mailto:{{ $viewing->email }}">
							<svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
							</svg>
							{{ $viewing->email }}
						</a>
					@endif
					@if ($viewing->phone)
						<a class="flex items-center gap-1.5 text-primary-600 hover:underline" href="tel:{{ $viewing->phone }}"
							dir="ltr">
							<svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
							</svg>
							{{ $viewing->phone }}
						</a>
					@endif
				</div>
			</div>
		</div>
	@elseif(!$showViewer)
		{{-- Empty state on desktop --}}
		<div
			class="hidden flex-1 items-center justify-center rounded-3xl border border-gray-50 bg-white shadow-card lg:flex">
			<div class="p-8 text-center text-gray-400">
				<svg class="mx-auto mb-4 h-14 w-14 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
						d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
				</svg>
				<p class="font-semibold text-gray-500">اختر رسالة للعرض</p>
				<p class="mt-1 text-sm">انقر على أي رسالة من القائمة</p>
			</div>
		</div>
	@endif

</div>
