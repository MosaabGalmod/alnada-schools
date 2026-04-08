# OBSERVATIONS — ملاحظات عامة للمشروع

> هذه قواعد ثابتة تنطبق على **كل** العمل في هذا المشروع.

---

## 🌐 دعم اللغة العربية و RTL
- كل صفحة وعنصر يجب أن يحمل `lang="ar" dir="rtl"`
- استخدم `text-align: start` بدلاً من `left/right` في CSS
- استخدم `margin-inline-start/end` و `padding-inline-start/end` بدلاً من left/right
- الأيقونات والعناصر الاتجاهية (أسهم، قوائم) تُعكس تلقائياً عبر `rtl:` في Tailwind
- تحقق من RTL في كل مكوّن جديد قبل الإغلاق

## 🌙 الوضع الداكن والفاتح (Dark / Light Mode)
- كل عنصر جديد يجب أن يحمل فئات `dark:` المناسبة
- استخدم CSS custom properties للألوان بدلاً من hardcoded colors عند الإمكان
- اختبر كل واجهة في الوضعين قبل الإنهاء
- النمط الحالي: `dark:` class على `<html>` + `@media (prefers-color-scheme: dark)`

## 🌱 السيدرز (Seeders)
- **دائماً** حدّث `DatabaseSeeder` و `SectionSeeder` بأي محتوى حقيقي جديد
- لا تترك بيانات وهمية (Lorem Ipsum) في الإنتاج
- استخدم `updateOrCreate` لضمان إعادة تشغيل السيدر بأمان
- كلمة مرور الأدمن الحالية: `alnada2024` — تغييرها من لوحة التحكم فقط

## 🏗️ المعايير التقنية الثابتة
| المعيار | التطبيق |
|---------|---------|
| **OOP / SOLID** | كل منطق في Service classes، Livewire للـ state، Controllers للـ routing فقط |
| **Laravel Best Practice** | Eloquent Scopes، Form Requests للـ validation، Caching للـ settings |
| **UI/UX Pro Max** | كل واجهة تمر بمعايير: Accessibility (ARIA)، Responsive، RTL، Dark mode |
| **CSS** | Tailwind utility-first + CSS custom properties للثيم، لا inline styles إلا للقيم الديناميكية |
| **Context7** | استشر Context7 لأي library/framework documentation قبل التنفيذ |

## 🚫 ممنوعات
- لا hardcoded نصوص عربية في PHP/JS (ضعها في Blade views أو DB)
- لا `direction: ltr` بدون مبرر واضح
- لا ألوان hardcoded في JS (استخدم CSS vars)
- لا `?  ?` مع مسافة في JS (nullish coalescing يُكتب `??` بدون مسافة)
