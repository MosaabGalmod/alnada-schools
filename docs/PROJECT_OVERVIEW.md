# مدارس الندى النموذجية — نظرة عامة على المشروع

> آخر تحديث: 6 أبريل 2026

## الهوية

| البند | القيمة |
|-------|--------|
| الاسم | مدارس الندى النموذجية الأهلية |
| الموقع الرسمي | https://alnada.com.sa |
| الموقع الجغرافي | المدينة المنورة — منطقة المدينة المنورة |
| التخصص | التربية الخاصة، الدمج، علاج النطق، العلاج الوظيفي |
| سنة التأسيس | 1429 هـ (2008 م) |

---

## Stack التقني

| الطبقة | التقنية |
|--------|---------|
| Framework | Laravel 11 |
| Frontend Components | Livewire 3 |
| Styling | Tailwind CSS 3 + PostCSS |
| Build Tool | Vite |
| JS Interactivity | Alpine.js |
| Database | SQLite / MySQL (قابل للتغيير) |
| خطوط عربية | Tajawal (headings) + Cairo (body) |
| أيقونات | SVG inline (Heroicons) |

---

## بنية المشروع

```
alnada-schools/
├── app/
│   ├── Http/Controllers/
│   │   ├── HomeController.php          — الصفحة الرئيسية
│   │   └── Admin/                      — كل CRUD للأدمن
│   ├── Livewire/Admin/                 — مكونات لوحة التحكم التفاعلية
│   ├── Models/
│   │   ├── Announcement.php
│   │   ├── Message.php
│   │   ├── Section.php
│   │   ├── SiteSetting.php
│   │   └── User.php
│   └── Services/                       — طبقة الأعمال
├── resources/views/
│   ├── layouts/app.blade.php           — Layout رئيسي (SEO كامل)
│   ├── home.blade.php                  — صفحة الهبوط الديناميكية
│   ├── sections/                       — مكونات الأقسام (includes)
│   │   ├── _hero.blade.php
│   │   ├── _about.blade.php
│   │   ├── _programs.blade.php
│   │   ├── _stats.blade.php
│   │   ├── _why_us.blade.php
│   │   ├── _news.blade.php
│   │   ├── _testimonials.blade.php
│   │   ├── _contact.blade.php
│   │   └── _custom.blade.php
│   ├── admin/                          — واجهات لوحة التحكم
│   │   ├── layout.blade.php
│   │   ├── login.blade.php
│   │   ├── dashboard.blade.php
│   │   ├── announcements.blade.php
│   │   ├── messages.blade.php
│   │   ├── sections.blade.php
│   │   └── settings.blade.php
│   └── components/
│       └── ⚡contact-form.blade.php    — نموذج التواصل (Livewire)
├── database/
│   ├── migrations/
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── SectionSeeder.php           — بيانات الأقسام الافتراضية
├── routes/web.php                      — مسارات public + /admin
├── resources/css/app.css               — Design System كامل
└── tailwind.config.js                  — ألوان + خطوط + animations
```

---

## النظام اللوني (Design Tokens)

```
primary (أزرق مائي داكن):
  600: #167ca0  — أزرار رئيسية
  700: #115f7a  — Active states
  900: #0a3642  — خلفية hero

gold (ذهبي):
  400: #fbbf24
  600: #d97706  — أزرار CTA رئيسية
  700: #b45309
```

---

## المسارات

```
GET  /                    — الصفحة الرئيسية (عام)
GET  /admin/login         — صفحة تسجيل الدخول
POST /admin/login         — معالجة الدخول
GET  /admin/logout        — تسجيل الخروج

[محمي بـ AdminAuthenticated middleware]
GET  /admin               — لوحة التحكم
GET  /admin/announcements — الإعلانات
GET  /admin/messages      — الرسائل
GET  /admin/sections      — إدارة الأقسام
GET  /admin/settings      — الإعدادات
```

---

## Sections ديناميكية

ترتيب الأقسام في الصفحة الرئيسية يُدار من لوحة التحكم:

| # | النوع | ID |
|---|-------|-----|
| 1 | hero | home |
| 2 | about | about |
| 3 | programs | programs |
| 4 | stats | stats |
| 5 | why_us | why_us |
| 6 | news | news |
| 7 | testimonials | testimonials |
| 8 | contact | contact |

---

## وضع المشروع الحالي

- [x] نظام Sections ديناميكي يعمل
- [x] لوحة تحكم Livewire كاملة (CRUD)
- [x] نظام SEO + Schema.org + OpenGraph
- [x] RTL كامل (Tailwind dir="rtl")
- [x] Design System عربي (Tailwind tokens)
- [x] نموذج تواصل Livewire
- [ ] اختبارات (0% coverage حالياً)
- [ ] Footer مفقود
- [ ] Dark mode غير مدعوم
- [ ] PWA / manifest غير موجود
