{{-- Contact Section --}}
@php
	$c = $section->content ?? [];
	$cs = \App\Models\SiteSetting::all_settings();
	$csPhone = $cs["phone"] ?? "+966 14 848 2306";
	$csEmail = $cs["email"] ?? "alnadaiec@gmail.com";
	$csAddress = $cs["address"] ?? "شارع الحسين بن علي بن الأسود، حي البركة، المدينة المنورة 42332";
	$csHours = $cs["working_hours"] ?? "الأحد – الخميس: 7:00ص – 1:00م";
	$csTel = "tel:" . preg_replace("/[\s\-()]/", "", $csPhone);
	$csSocials = [
	    [
	        "href" => "https://www.instagram.com/" . ($cs["instagram"] ?? "alnada_school") . "/",
	        "path" =>
	            "M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z",
	        "bg" => "bg-gradient-to-br from-primary-500 to-primary-700",
	    ],
	    [
	        "href" => "https://x.com/" . ($cs["twitter"] ?? "AIEC_"),
	        "path" =>
	            "M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.742l7.74-8.855L1.254 2.25H8.08l4.26 5.632L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77z",
	        "bg" => "bg-gray-900",
	    ],
	    [
	        "href" => "https://www.facebook.com/" . ($cs["facebook"] ?? "Alnada2021") . "/",
	        "path" =>
	            "M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z",
	        "bg" => "bg-blue-600",
	    ],
	    [
	        "href" => "https://wa.me/" . ($cs["whatsapp"] ?? "966559281924"),
	        "path" =>
	            "M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z",
	        "bg" => "bg-green-500",
	    ],
	];
@endphp
<section class="section" id="contact"
	style="{{ $section->bgCss() ?: "background: linear-gradient(135deg,#f0f9fd 0%,#daf1fa 100%);" }}">
	<div class="mx-auto max-w-7xl">
		<div class="mb-14 text-center">
			@if (!empty($c["tag"]))
				<span class="section-tag mx-auto">{{ $c["tag"] }}</span>
			@endif
			<h2 class="section-title" style="color: {{ $section->headingColor() }}">{{ $c["title"] ?? "نحن هنا لمساعدتك" }}</h2>
			@if (!empty($c["subtitle"]))
				<p class="section-desc mx-auto" style="color: {{ $section->textColor() }}">{{ $c["subtitle"] }}</p>
			@endif
		</div>

		<div class="grid gap-8 lg:grid-cols-5">
			{{-- Info --}}
			<div class="space-y-4 lg:col-span-2">
				{{-- Address --}}
				<div class="flex gap-4 rounded-2xl bg-white p-4 shadow-card transition-shadow hover:shadow-card-hover">
					<div class="mt-0.5 flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-primary-50">
						<svg class="h-5 w-5 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
								d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
						</svg>
					</div>
					<div>
						<div class="mb-0.5 text-xs font-semibold text-gray-400">العنوان</div>
						<p class="text-sm font-medium leading-relaxed text-gray-800">{{ $csAddress }}</p>
					</div>
				</div>

				{{-- Phone — clickable, LTR number, RTL-safe icon --}}
				<a
					class="group flex gap-4 rounded-2xl bg-white p-4 shadow-card transition-all hover:bg-gold-50 hover:shadow-card-hover"
					href="{{ $csTel }}">
					<div
						class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gold-50 transition-colors group-hover:bg-gold-100">
						{{-- Phone handset — no flip needed, symmetric icon --}}
						<svg class="h-5 w-5 text-gold-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
								d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
						</svg>
					</div>
					<div>
						<div class="mb-0.5 text-xs font-semibold text-gray-400">الهاتف</div>
						<div class="text-sm font-semibold text-gray-800 transition-colors group-hover:text-gold-700" dir="ltr">
							{{ $csPhone }}</div>
					</div>
				</a>

				{{-- Email — clickable --}}
				<a
					class="group flex gap-4 rounded-2xl bg-white p-4 shadow-card transition-all hover:bg-blue-50 hover:shadow-card-hover"
					href="mailto:{{ $csEmail }}">
					<div
						class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 transition-colors group-hover:bg-blue-100">
						<svg class="h-5 w-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
								d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
						</svg>
					</div>
					<div>
						<div class="mb-0.5 text-xs font-semibold text-gray-400">البريد الإلكتروني</div>
						<div class="text-sm font-semibold text-gray-800 transition-colors group-hover:text-blue-700" dir="ltr">
							{{ $csEmail }}</div>
					</div>
				</a>

				{{-- Hours --}}
				<div class="flex gap-4 rounded-2xl bg-white p-4 shadow-card transition-shadow hover:shadow-card-hover">
					<div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-primary-50">
						<svg class="h-5 w-5 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
								d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
						</svg>
					</div>
					<div>
						<div class="mb-0.5 text-xs font-semibold text-gray-400">ساعات العمل</div>
						<div class="text-sm font-medium text-gray-800">{{ $csHours }}</div>
					</div>
				</div>

				{{-- Map --}}
				<div class="overflow-hidden rounded-2xl bg-white shadow-card">
					<iframe class="block"
						src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3647.11!2d39.5657885!3d24.5084508!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15bdb9d2a3eee2d1%3A0x1cf494e6a0e0773a!2z2YXYr9Cw2LHYsyDYp9mE2YbYr9mdINin2YTZhtmH2YjYtNal2YrYqSDYp9mE2KPZh9mE2YrYqQ!5e0!3m2!1sar!2ssa!4v1712000000000!5m2!1sar!2ssa"
						title="موقع مدارس الندى" style="border:0;" width="100%" height="200" allowfullscreen="" loading="lazy"
						referrerpolicy="no-referrer-when-downgrade">
					</iframe>
				</div>

				{{-- Social --}}
				<div class="flex gap-3">
					@foreach ($csSocials as ["href" => $href, "path" => $path, "bg" => $bg])
						<a
							class="{{ $bg }} flex h-10 w-10 items-center justify-center rounded-xl shadow-md transition-transform hover:scale-110"
							href="{{ $href }}" target="_blank" rel="noopener noreferrer">
							<svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24">
								<path d="{{ $path }}" />
							</svg>
						</a>
					@endforeach
				</div>
			</div>

			{{-- Form --}}
			<div class="lg:col-span-3">
				<div class="rounded-3xl bg-white p-8 shadow-card">
					<h3 class="mb-6 font-heading text-xl font-bold text-gray-900">أرسل لنا رسالة</h3>
					@livewire("contact-form")
				</div>
			</div>
		</div>
	</div>
</section>
