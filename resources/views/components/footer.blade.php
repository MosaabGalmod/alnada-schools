<footer class="footer-shell relative overflow-hidden bg-primary-950 text-white" aria-labelledby="footer-title">
	<div class="pointer-events-none absolute inset-0 overflow-hidden" aria-hidden="true">
		<div class="footer-orb footer-orb-primary"></div>
		<div class="footer-orb footer-orb-secondary"></div>
	</div>

	<div class="relative w-full overflow-hidden leading-none" aria-hidden="true">
		<svg class="block h-14 w-full" viewBox="0 0 1440 56" fill="none" xmlns="http://www.w3.org/2000/svg"
			preserveAspectRatio="none">
			<path
				d="M0 56L60 46.7C120 37 240 19 360 14C480 9 600 18.7 720 28C840 37 960 46.7 1080 46.7C1200 46.7 1320 37 1380 32.7L1440 28V0H1380C1320 0 1200 0 1080 0C960 0 840 0 720 0C600 0 480 0 360 0C240 0 120 0 60 0H0V56Z"
				fill="white" fill-opacity="0.04" />
		</svg>
	</div>

	<div class="relative z-10 mx-auto max-w-7xl px-4 pb-10 pt-8 sm:px-6 lg:px-8">
		<section class="footer-panel mb-8 overflow-hidden p-6 sm:p-8" aria-label="دعوة للتواصل">
			<div class="grid gap-6 lg:grid-cols-[1.4fr_.8fr] lg:items-center">
				<div>
					<div
						class="footer-kicker mb-3 inline-flex items-center gap-2 rounded-full px-4 py-2 text-xs font-semibold text-primary-100">
						<span class="h-2 w-2 rounded-full bg-gold-400"></span>
						قبول وتسجيل وبرامج متخصصة تحت إشراف تعليمي معتمد
					</div>
					<h2 class="font-heading text-2xl font-extrabold leading-tight text-white sm:text-3xl" id="footer-title">
						لنبدأ الرحلة التعليمية المناسبة لابنكم
					</h2>
					<p class="mt-3 max-w-2xl text-sm leading-7 text-primary-200 sm:text-base">
						فريقنا يجيب عن الاستفسارات، يشرح البرامج، ويرتب زيارة تعريفية بسرعة ووضوح. صُمم هذا القسم ليقود مباشرة
						إلى التواصل أو التسجيل دون تشتيت.
					</p>
				</div>
				<div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2">
					<a class="btn-primary min-h-[48px] justify-center text-sm" href="#contact">
						ابدأ رحلة التسجيل
					</a>
					<a
						class="inline-flex min-h-[48px] items-center justify-center rounded-2xl border border-white/15 bg-white/5 px-5 py-3 text-sm font-semibold text-white transition-all duration-200 hover:bg-white/10 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-gold-400 focus-visible:ring-offset-2 focus-visible:ring-offset-primary-950"
						href="{{ $telUri }}" dir="ltr" lang="en">
						اتصل الآن
					</a>
				</div>
			</div>
		</section>

		<div class="grid items-start gap-5 xl:grid-cols-[minmax(0,1.15fr)_minmax(0,.85fr)]">
			<div class="grid items-start gap-5 lg:grid-cols-[minmax(0,.92fr)_minmax(0,1.08fr)]">
				<section class="footer-panel p-6 sm:p-7">
					<a class="group mb-5 inline-flex items-center gap-3" href="#home" aria-label="مدارس الندى - الصفحة الرئيسية">
						<div
							class="flex h-12 w-12 shrink-0 items-center justify-center overflow-hidden rounded-2xl bg-white shadow-clay transition-all duration-200 group-hover:shadow-clay-lg">
							<img class="h-auto w-10 object-contain" src="{{ asset("logo.svg") }}" alt="" aria-hidden="true">
						</div>
						<div class="leading-tight">
							<div class="font-heading text-lg font-bold text-white">مدارس الندى</div>
							<div class="text-xs text-primary-300">النموذجية الأهلية</div>
						</div>
					</a>

					<p class="max-w-sm text-sm leading-7 text-primary-200">
						رائدة في التربية الخاصة والدمج بالمدينة المنورة منذ عام 1429هـ. نركز على وضوح التواصل، موثوقية الخدمة،
						وتجربة رقمية تعكس جودة المدرسة.
					</p>

					<dl class="mt-6 grid grid-cols-2 gap-3">
						<div class="footer-stat-card">
							<dt class="footer-stat-label">بداية التميز</dt>
							<dd class="footer-stat-value">1429هـ</dd>
						</div>
						<div class="footer-stat-card">
							<dt class="footer-stat-label">المرجعية</dt>
							<dd class="footer-stat-value">اعتماد وزارة التعليم</dd>
						</div>
						<div class="footer-stat-card sm:col-span-2">
							<dt class="footer-stat-label">التجربة</dt>
							<dd class="footer-stat-value">بيئة تعليمية واضحة ومساندة للأسرة من أول تواصل</dd>
						</div>
					</dl>

					<ul class="mt-6 flex flex-wrap gap-2" aria-label="وسائل التواصل الاجتماعي">
						@foreach ($socials as $item)
							@include("components.footer.social-link", ["item" => $item])
						@endforeach
					</ul>
				</section>

				<section class="footer-panel p-6 sm:p-7" aria-label="التنقل السريع">
					<div class="mb-5 flex flex-wrap items-start justify-between gap-3">
						<div>
							<p class="footer-section-kicker">خريطة سريعة</p>
							<h3 class="font-heading text-lg font-bold text-white">كل ما يحتاجه ولي الأمر في مكان واحد</h3>
							<p class="mt-2 max-w-xl text-sm leading-6 text-primary-300">
								روابط أساسية مختصرة لتقليل التمرير والوصول السريع إلى البرامج والمعلومات الرئيسية.
							</p>
						</div>
						<span class="footer-chip">تنقل مباشر وواضح</span>
					</div>

					<div class="grid grid-cols-2 gap-4">
						@include("components.footer.nav-list", ["title" => "روابط سريعة", "items" => $quickLinks])
						@include("components.footer.nav-list", ["title" => "برامجنا", "items" => $programLinks])
					</div>
				</section>
			</div>

			<section class="footer-panel p-6 sm:p-7" aria-label="معلومات التواصل">
				<p class="footer-section-kicker">قنوات مباشرة</p>
				<h3 class="font-heading text-lg font-bold text-white">
					تواصل سريع دون بحث إضافي
				</h3>
				<p class="mt-2 text-sm leading-6 text-primary-300">
					كل وسائل التواصل الأساسية وساعات العمل في بطاقة واحدة، مع أولوية للوصول الهاتفي السريع.
				</p>

				<div class="mt-5 space-y-3">
					@foreach ($contactItems as $item)
						@include("components.footer.contact-item", ["item" => $item])
					@endforeach
				</div>

				<div class="mt-5 grid gap-3 sm:grid-cols-2">
					<a class="footer-inline-cta" href="{{ $telUri }}" dir="ltr" lang="en">
						اتصال مباشر
					</a>
					<a class="footer-inline-cta footer-inline-cta-muted" href="#contact">
						إرسال استفسار
					</a>
				</div>
			</section>
		</div>

		<div class="mt-8 border-t border-white/10 pt-6">
			<div class="flex flex-col items-center justify-between gap-4 text-xs text-primary-400 sm:flex-row">
				<p>
					<span aria-label="حقوق الملكية">©</span>
					{{ $year }} مدارس الندى النموذجية الأهلية. جميع الحقوق محفوظة.
				</p>

				<nav class="flex flex-wrap items-center justify-center gap-4" aria-label="روابط التذييل السفلي">
					<a class="footer-meta-link" href="#">
						سياسة الخصوصية
					</a>
					<a class="footer-meta-link" href="#">
						شروط الاستخدام
					</a>
					<a class="footer-meta-link" href="{{ route("admin.login") }}" rel="nofollow">
						لوحة التحكم
					</a>
				</nav>
			</div>
		</div>
	</div>
</footer>
