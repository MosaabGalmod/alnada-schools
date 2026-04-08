# مهام التحكم الكامل — مدارس الندى

## الحالة: المرحلة 6 قيد التنفيذ

---

## ✅ المراحل المنجزة (1–5)
- **M1** Custom Section ديناميكي + intro_card
- **M2** Repeaters: programs, stats, why_us, testimonials
- **M3** رفع الشعار والـ favicon
- **M4** ملف المدير (اسم + كلمة مرور)
- **M5** إدارة الرسائل (bulk, delete, read)

---

## 🔄 المرحلة 6 — SEO + نصوص الواجهة + السياسات + الأقسام

### ✅ منجز
- [x] SEO meta من SiteSetting (title, description, keywords, author)
- [x] Footer strings من SiteSetting (20+ مفتاح)
- [x] Navbar brand + CTA من SiteSetting
- [x] About, Testimonials, Why Us, Contact strings من SiteSetting
- [x] Contact form header (kicker, title, text) من SiteSetting + Settings tab
- [x] صفحتا Privacy + Terms (admin editor + frontend)
- [x] save-btn partial
- [x] إصلاح news zigzag layout
- [x] إصلاح custom section dark mode (inline CSS vars injection)
- [x] إصلاح custom section duplicate content bug
- [x] إصلاح highlight card text color في dark mode
- [x] إصلاح custom-empty-hint style

### ✅ منجز (إضافي من جلسة لاحقة)
- [x] CSS للـ flip items في news-zigzag على desktop (md+)
- [x] Seed البيانات الجديدة: `php artisan db:seed`
- [x] اختبار صفحتي /privacy-policy و /terms-of-use
- [x] Dark Mode toggle للـ admin panel (moon/sun button)
- [x] localStorage persistence لحالة الـ Dark Mode
- [x] Full dark CSS لجميع صفحات الأدمن (sidebar, topbar, modals, tables)
- [x] Arabic pagination (Livewire + standard) — عرض X–Y من Z نتيجة
- [x] RTL pagination buttons (SVG arrows)
- [x] APP_LOCALE=ar للترجمة العربية

---

## التحسينات المقترحة اللاحقة
- Programs: ربط الأيقونة بحقل من DB بدل mapping ثابت
- Why Us: eyebrow categories قابلة للتعديل
- Email notification للرسائل الجديدة
- JSON-LD structured data من SiteSetting
- لوحة إحصائيات متقدمة (Charts)
