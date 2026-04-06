# قائمة المهام — مدارس الندى

> آخر تحديث: 6 أبريل 2026
> الحالات: `[ ]` لم يُبدأ | `[~]` جارٍ | `[x]` مكتمل

---

## المرحلة 1 — إصلاح المشاكل الحرجة (Critical Fixes)

- [ ] **[C-01]** إنشاء `_footer.blade.php` وإضافته لـ `layouts/app.blade.php`
  - شعار + وصف مختصر
  - روابط سريعة (الأقسام)
  - وسائل التواصل الاجتماعي
  - معلومات الاتصال
  - حقوق الملكية + سنة
  
- [ ] **[C-03]** التحقق من CSRF في Livewire contact-form
  - فحص `AppServiceProvider` وإعدادات Livewire

- [ ] **[C-04]** إضافة `logo-sm.png` إلى `public/` أو تغيير الـ favicon path
  - توليد نسخة 32×32 و 16×16 من الشعار

- [ ] **[H-03]** تغيير `<div id="main-content">` إلى `<main id="main-content">`
  - الملف: `resources/views/home.blade.php`

---

## المرحلة 2 — إصلاح مشاكل عالية الأولوية

- [ ] **[H-01]** تحسين Hero Typography للجوال
  - `text-4xl sm:text-5xl md:text-6xl lg:text-7xl`
  - التحقق من contrast ratio للذهبي على الأزرق

- [ ] **[H-02]** تحقق من تعريف Alpine `statsCounter` في `app.js`
  - إضافة Intersection Observer لتشغيل العداد عند الظهور فقط

- [ ] **[H-04]** تحسين `title` الـ Google Maps iframe

- [ ] **[H-05]** إنشاء OG Image مخصصة 1200×630 للمشاركة الاجتماعية

- [ ] **[H-06]** إضافة رابط "الأقسام" لقائمة Admin Sidebar
  - الملف: `resources/views/admin/layout.blade.php`
  - إضافة `['sections', '...icon path...', 'الأقسام']` في مصفوفة الروابط

---

## المرحلة 3 — إصلاح مشاكل متوسطة

- [ ] **[M-02]** إضافة `prefers-reduced-motion` في `app.css`

- [ ] **[M-03]** ربط أيقونات Programs بـ `icon_key` بدلاً من اسم البرنامج

- [ ] **[M-04]** إضافة loading state في Contact Form
  - `wire:loading.attr="disabled"` على زر الإرسال
  - Spinner أو نص "جاري الإرسال..."

- [ ] **[M-08]** تحديث `tailwind.config.js` safelist لتشمل الألوان الديناميكية

---

## المرحلة 4 — تحسينات منخفضة الأولوية

- [ ] **[L-03]** إضافة CSS لـ `.skip-link` في `app.css`

- [ ] **[L-05]** تحديث `public/robots.txt` لحماية `/admin`

- [ ] **[L-06]** إنشاء route ديناميكي لـ `sitemap.xml`

- [ ] **[L-07]** نقل Google Fonts من `@import` CSS إلى `<link>` tags في layout

- [ ] **[L-04]** إضافة confirmation dialog لحذف الأقسام (Alpine.js modal)

- [ ] **[L-02]** إصلاح شعار لوحة التحكم (عرض الصورة بدلاً من حرف "ن")

---

## المرحلة 5 — الاختبارات (Testing — 0% → 80%+)

### اختبارات الوحدة (Unit Tests)
- [ ] `SectionTest` — bgCss(), headingColor(), accentColor() methods
- [ ] `AnnouncementTest` — badge_color, category validation
- [ ] `MessageTest` — mark as read, unread count

### اختبارات التكامل (Feature Tests)
- [ ] `HomePageTest` — الصفحة الرئيسية تحمل وتعرض الأقسام
- [ ] `ContactFormTest` — إرسال نموذج التواصل ويُحفظ في DB
- [ ] `AdminAuthTest` — تسجيل الدخول / الخروج / حماية المسارات
- [ ] `AdminAnnouncementsTest` — CRUD كامل
- [ ] `AdminSectionsTest` — ترتيب + إخفاء/إظهار + تعديل المحتوى

### اختبارات E2E (Playwright)
- [ ] تدفق زيارة الصفحة الرئيسية والتنقل بين الأقسام
- [ ] إرسال نموذج التواصل
- [ ] تسجيل الدخول للأدمن وإضافة إعلان

---

## المرحلة 6 — ميزات جديدة (New Features)

- [ ] **Footer** — المرحلة 1 أعلاه
- [ ] **PWA Manifest** — `manifest.json` + service worker بسيط
- [ ] **Gallery Section** — معرض صور اختياري من لوحة التحكم
- [ ] **Print View** — إخفاء navbar/footer عند الطباعة
- [ ] **WhatsApp Float Button** — زر واتساب عائم في الزاوية
- [ ] **Cookie Banner** — إشعار ملفات تعريف الارتباط (GDPR/PDPL)
- [ ] **Rate Limiting** — على contact form endpoint (منع spam)

---

## الأولويات المقترحة للجلسة القادمة

1. إصلاح Footer (C-01) — أثر مرئي فوري
2. إصلاح Sidebar Sections link (H-06) — bug واضح في الصورة
3. تغيير div→main (H-03) — سطر واحد
4. prefers-reduced-motion (M-02) — سطور قليلة
5. skip-link CSS (L-03) — سطور قليلة
6. robots.txt (L-05) — ملف جاهز
