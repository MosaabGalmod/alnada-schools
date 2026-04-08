@extends("layouts.app")
@section("title", "تسجيل الدخول - لوحة التحكم")

@section("content")
	<div class="hero-bg relative flex min-h-screen items-center justify-center overflow-hidden p-4">
		<div class="blob -right-20 -top-20 h-96 w-96 bg-primary-400"></div>
		<div class="blob animation-delay-400 -left-20 bottom-10 h-64 w-64 bg-gold-400"></div>

		<div class="relative z-10 w-full max-w-md">
			{{-- Logo --}}
			<div class="mb-8 text-center">
				<div
					class="mx-auto mb-4 flex h-20 w-20 items-center justify-center overflow-hidden rounded-3xl bg-white shadow-clay-lg">
					<img class="h-auto w-16 object-contain" src="{{ \App\Models\SiteSetting::logoUrl() }}" alt="شعار مدارس الندى">
				</div>
				<h1 class="font-heading text-2xl font-bold text-white">لوحة التحكم</h1>
				<p class="mt-1 text-sm text-white/70">مدارس الندى النموذجية الأهلية</p>
			</div>

			{{-- Form --}}
			<div class="rounded-4xl bg-white p-8 shadow-clay-lg">
				<h2 class="mb-6 text-center font-heading text-xl font-bold text-gray-900">تسجيل الدخول</h2>

				@if (session("error"))
					<div class="mb-5 flex items-center gap-3 rounded-2xl border border-red-100 bg-red-50 p-4 text-sm text-red-700">
						<svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
						</svg>
						{{ session("error") }}
					</div>
				@endif

				<form class="space-y-5" method="POST" action="{{ route("admin.login.post") }}">
					@csrf
					<div>
						<label class="form-label">اسم المستخدم</label>
						<div class="relative">
							<input class="form-input pr-10" name="username" type="text" value="{{ old("username") }}" required
								placeholder="admin" dir="ltr" autocomplete="username" />
							<div class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
								<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
								</svg>
							</div>
						</div>
					</div>

					<div>
						<label class="form-label">كلمة المرور</label>
						<div class="relative" x-data="{ show: false }">
							<input class="form-input pr-10" name="password" x-bind:type="show ? 'text' : 'password'" required
								placeholder="••••••••" dir="ltr" autocomplete="current-password" />
							<button class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 transition-colors hover:text-gray-600"
								type="button" @click="show = !show">
								<svg class="h-4 w-4" x-show="!show" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
								</svg>
								<svg class="h-4 w-4" x-show="show" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
								</svg>
							</button>
						</div>
					</div>

					<button class="btn-primary w-full justify-center py-3.5" type="submit">
						<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
						</svg>
						تسجيل الدخول
					</button>
				</form>

				<div class="mt-6 text-center">
					<a class="text-sm font-medium text-primary-600 transition-colors hover:text-primary-800" href="{{ route("home") }}">
						← العودة للموقع
					</a>
				</div>
			</div>
		</div>
	</div>
@endsection
