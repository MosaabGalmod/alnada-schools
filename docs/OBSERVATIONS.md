# ملاحظات الموقع — مشاكل وتحسينات مقترحة

> تاريخ الفحص: 6 أبريل 2026
> المصدر: فحص الكود + لقطات الشاشة (screenshots/)

---

## 🔴 مشاكل حرجة (Critical)

### [C-01] لا يوجد Footer في أي مكان
- **الملف المعني:** لا يوجد `_footer.blade.php` ولا كتلة في `layouts/app.blade.php`
- **الأثر:** الموقع ينتهي عند قسم Contact بشكل مفاجئ — تجربة مستخدم سيئة جداً
- **المطلوب:** إنشاء Footer يحتوي على: الشعار، روابط سريعة، وسائل التواصل، معلومات الاتصال، حقوق الملكية

### [C-02] لا توجد أي اختبارات (0% Test Coverage)
- **الملفات:** `tests/Feature/ExampleTest.php` + `tests/Unit/ExampleTest.php` — مجرد templates فارغة
- **الأثر:** أي تعديل قد يكسر ميزة موجودة دون أن يُكتشف
- **المطلوب:** تغطية على الأقل: HomeController, Contact Form, Admin Auth, Sections CRUD

### [C-03] لا توجد حماية CSRF في طلبات Livewire
- **الملف:** `resources/views/components/⚡contact-form.blade.php`
- **الأثر:** قد يكون النموذج عرضة لهجمات CSRF (تحقق من Livewire config)
- **المطلوب:** مراجعة أن `@livewireScripts` يُرسل CSRF token صحيح

### [C-04] favicon يحيل لـ `logo-sm.png` غير موجود
- **الملف:** `resources/views/layouts/app.blade.php` — السطر 37
- **الكود:** `<link rel="icon" type="image/png" href="{{ asset('logo-sm.png') }}" />`
- **الأثر:** رمز التبويب قد يظهر فارغاً في المتصفح
- **المطلوب:** رفع ملف `logo-sm.png` إلى `public/` أو تعديل المسار

---

## 🟠 مشاكل عالية (High)

### [H-01] Hero — إشكاليات Typography وContrast
- **الملف:** `resources/views/sections/_hero.blade.php`
- **الملاحظة (من الصورة):**
  - عنوان `مدارس الندى` بالأبيض على الخلفية الداكنة ✅
  - العنوان الفرعي `النموذجية الأهلية` بالذهبي — يجب التحقق من نسبة التباين (WCAG 4.5:1)
  - النص الوصفي يبدو صغيراً نسبياً على الجوال
- **المطلوب:** اختبار contrast ratio على الألوان الذهبية، زيادة font-size للنص الوصفي لـ `md:text-xl`

### [H-02] Stats Section — العداد يبدأ من 0 فوراً
- **الملف:** `resources/views/sections/_stats.blade.php`
- **الملاحظة:** يستخدم Alpine.js `x-data="statsCounter"` — إذا لم يُعرَّف يظل الرقم 0
- **المطلوب:** التحقق من تعريف Alpine component `statsCounter` في `resources/js/app.js`

### [H-03] الصفحة الرئيسية تفتقد `<main>` tag للـ Accessibility
- **الملف:** `resources/views/home.blade.php`
- **الملاحظة:** الـ skip link يربط بـ `#main-content` لكن العنصر المستهدف هو `<div id="main-content">` وليس `<main>`
- **الأثر:** Screen readers لا تُعرِّف المحتوى الرئيسي بشكل صحيح
- **المطلوب:** تغيير `<div id="main-content">` إلى `<main id="main-content">`

### [H-04] Google Maps iframe بدون `title` كافٍ للـ Accessibility
- **الملف:** `resources/views/sections/_contact.blade.php`
- **الملاحظة:** الـ `title` موجود لكن يجب التحقق أنه يصف الخريطة بوضوح
- **المطلوب:** `title="خريطة موقع مدارس الندى النموذجية الأهلية — المدينة المنورة"`

### [H-05] OG Image ضعيفة — `logo.png` فقط
- **الملف:** `resources/views/layouts/app.blade.php`
- **الملاحظة:** `og:image` يشير لـ `logo.png` فقط بدون أبعاد مناسبة (1200×630px)
- **الأثر:** عند مشاركة الموقع على وسائل التواصل تظهر صورة صغيرة وغير جذابة
- **المطلوب:** إنشاء OG image مخصصة (1200×630) وتحديث الـ meta

### [H-06] Admin Sidebar لا يحتوي على `Sections` في القائمة الجانبية
- **الملف:** `resources/views/admin/layout.blade.php`
- **الملاحظة (من الصورة):** لوحة التحكم تظهر: الرئيسية، الإعلانات، الرسائل، الإعدادات — **غائب: الأقسام**
- **المطلوب:** إضافة رابط الأقسام في مصفوفة روابط الـ sidebar

---

## 🟡 مشاكل متوسطة (Medium)

### [M-01] Mobile Hero — النصوص خارج الشاشة جزئياً
- **الملف:** `_hero.blade.php`
- **الملاحظة:** العنوان `text-5xl md:text-6xl lg:text-7xl` — على الجوال قد يخرج النص عن الحدود بدون `px` كافٍ
- **المطلوب:** إضافة `text-4xl sm:text-5xl md:text-6xl` + مراجعة `px-4 sm:px-6`

### [M-02] Blob animations — لا توجد `prefers-reduced-motion`
- **الملف:** `resources/css/app.css` — keyframes `blob` + `float`
- **الملاحظة:** المستخدمون الذين يُفضلون تقليل الحركة (accessibility) لن يحترم الموقع إعداداتهم
- **المطلوب:**
```css
@media (prefers-reduced-motion: reduce) {
  .blob, .animate-float, .animate-blob { animation: none; }
}
```

### [M-03] Programs Section — Icon mapping بالعربية فقط
- **الملف:** `_programs.blade.php`
- **الملاحظة:** مفاتيح `$icons` تستخدم أسماء البرامج العربية الثابتة — إذا تغير اسم البرنامج في DB لن يُعثر على الأيقونة
- **المطلوب:** ربط الأيقونة بحقل `icon_key` في JSON بدلاً من اسم البرنامج

### [M-04] Contact Form — لا يوجد `loading` state مرئي
- **الملف:** `resources/views/components/⚡contact-form.blade.php`
- **الملاحظة:** عند إرسال النموذج لا يعرف المستخدم أن هناك طلباً يُعالَج
- **المطلوب:** إضافة `wire:loading` attribute على زر الإرسال

### [M-05] Testimonials — Avatar يأخذ الحرفين الأولين من `avatar` field
- **الملف:** `_testimonials.blade.php`
- **الملاحظة:** `mb_substr($item['avatar'] ?? $item['name'] ?? '?', 0, 2)` — منطق مبهم
- **المطلوب:** استخدام حقل `initials` صريح أو تحسين الـ fallback

### [M-06] Admin Dashboard فارغ من الروابط السريعة المهمة
- **الملاحظة (من الصورة):** يكرر نفس المعلومات مرتين في بطاقتين منفصلتين (إعلانات منشورة × إعلانات كلية)
- **المطلوب:** إضافة رسم بياني بسيط للرسائل خلال الأسبوع + أحدث الرسائل preview

### [M-07] لا يوجد `lang` attribute على العناصر الإنجليزية (dir="ltr")
- **الملاحظة:** رقم الهاتف والبريد الإلكتروني يستخدمان `dir="ltr"` لكن بدون `lang="en"`
- **الأثر:** Screen readers قد تقرأها بالطريقة العربية

### [M-08] `tailwind.config.js` يفتقد safelist لألوان dynamic badges
- **الملاحظة:** `badge-green`, `badge-blue` إلخ تُنشأ ديناميكياً من الـ DB — Tailwind قد يُزيلها
- **المطلوب:** إضافة:
```js
safelist: [
  'badge-green', 'badge-gold', 'badge-blue', 'badge-red', 'badge-purple',
  'from-primary-700', 'from-blue-600', 'from-purple-600', 'from-gold-600', 'from-rose-600',
  // ... إلخ
]
```

---

## 🔵 مشاكل منخفضة / تحسينات (Low)

### [L-01] Meta keywords مهملة في Google لكن مفيدة للـ Bing
- **الملف:** `layouts/app.blade.php`
- **الملاحظة:** الـ keywords طويلة جداً (> 200 حرف) — قصّرها لـ 10 كلمات مفتاحية كحد أقصى

### [L-02] شعار لوحة التحكم يعرض "ن" بدلاً من الشعار الحقيقي
- **الملف:** `admin/layout.blade.php`
- **الملاحظة (من الصورة):** الدائرة الخضراء تحتوي "ن" × المتوقع هو الشعار الحقيقي
- **المطلوب:** تحميل `logo.png` في header لوحة التحكم بشكل صحيح

### [L-03] `skip-link` CSS غير مُعرَّف في app.css
- **الملف:** `layouts/app.blade.php` — `class="skip-link"`
- **الملاحظة:** لم أجد `.skip-link` في `app.css`
- **المطلوب:**
```css
.skip-link {
  @apply sr-only focus:not-sr-only focus:absolute focus:top-4 focus:right-4
         focus:z-50 focus:px-4 focus:py-2 focus:bg-primary-700 focus:text-white
         focus:rounded-xl focus:shadow-lg;
}
```

### [L-04] Sections Admin — لا يوجد "حذف قسم" confirmation dialog
- **الملاحظة:** حذف قسم بالخطأ قد يُخفي محتوى من الموقع فوراً
- **المطلوب:** Alpine.js confirmation modal قبل الحذف

### [L-05] لا يوجد `robots.txt` صحيح لمنع crawl `/admin`
- **الملف:** `public/robots.txt`
- **المطلوب:**
```
User-agent: *
Disallow: /admin/
Allow: /
Sitemap: https://alnada.com.sa/sitemap.xml
```

### [L-06] `sitemap.xml` ثابت — يجب أن يكون ديناميكياً
- **الملف:** `public/sitemap.xml`
- **الملاحظة:** ملف ثابت لا يُحدَّث تلقائياً عند إضافة محتوى جديد

### [L-07] Google Fonts تُحمَّل بـ `@import` في CSS
- **الملف:** `resources/css/app.css` — السطر 2
- **الملاحظة:** `@import url(...)` أبطأ من `<link rel="preconnect">` + `<link rel="stylesheet">`
- **المطلوب:** نقل الـ import إلى `layouts/app.blade.php` كـ `<link>` tags (موجود جزئياً لكن `@import` لا يزال)

---

## ✅ ما يعمل جيداً (Keep)

| البند | التقدير |
|-------|---------|
| Design System عربي كامل (Tailwind tokens) | ⭐⭐⭐⭐⭐ |
| SEO + Schema.org + OG + Twitter Cards | ⭐⭐⭐⭐ |
| RTL كامل مع Cairo/Tajawal | ⭐⭐⭐⭐⭐ |
| Clay morphism design جميل ومتناسق | ⭐⭐⭐⭐ |
| Skip link للـ accessibility | ⭐⭐⭐ |
| Livewire Sections CRUD | ⭐⭐⭐⭐ |
| Admin middleware authentication | ⭐⭐⭐⭐ |
| Scroll-aware navbar (Alpine.js) | ⭐⭐⭐⭐ |
| Reveal animations (IntersectionObserver) | ⭐⭐⭐⭐ |

---

## ملخص إحصائي

| الأولوية | العدد |
|----------|-------|
| 🔴 حرجة | 4 |
| 🟠 عالية | 6 |
| 🟡 متوسطة | 8 |
| 🔵 منخفضة | 7 |
| **المجموع** | **25 ملاحظة** |
