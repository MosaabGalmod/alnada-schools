# PROJECT_OVERVIEW — مدارس الندى

> للمرجعية السريعة أثناء التنفيذ.

## Stack
- Laravel 11 · Livewire 3 · Tailwind CSS · Alpine.js · SQLite/MySQL

## Admin Credentials
- URL: `/admin`  |  username: `admin`  |  password: `alnada2024`

## هيكل لوحة التحكم
```
/admin              → Dashboard
/admin/sections     → SectionManager (Livewire) — الأهم
/admin/settings     → Settings (Livewire)
/admin/announcements→ Announcements (Livewire)
/admin/messages     → Messages (Livewire)
```

## الملفات الرئيسية للتعديل الآن
```
app/Livewire/Admin/SectionManager.php
resources/views/livewire/admin/section-manager.blade.php
resources/views/sections/_custom.blade.php
```
