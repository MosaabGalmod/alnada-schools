@extends("admin.layout")
@section("title", "إدارة صفحات السياسات")
@section("page-title", "صفحات السياسات")
@section("page-desc", "سياسة الخصوصية وشروط الاستخدام")

@section("admin-content")
	<div class="admin-page-header mb-6">
		<div>
			<h1 class="admin-page-title">صفحات السياسات</h1>
			<p class="admin-page-desc">سياسة الخصوصية وشروط الاستخدام</p>
		</div>
		<div class="flex gap-3">
			<a class="btn-secondary flex items-center gap-2" href="{{ route("privacy.policy") }}" target="_blank">
				<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
				</svg>
				معاينة سياسة الخصوصية
			</a>
			<a class="btn-secondary flex items-center gap-2" href="{{ route("terms.of.use") }}" target="_blank">
				<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
				</svg>
				معاينة شروط الاستخدام
			</a>
		</div>
	</div>
	<livewire:admin.policies />
@endsection
