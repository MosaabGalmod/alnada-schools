<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(SectionSeeder::class);


        // ===== Site Settings =====
        $settings = [
            'hero_title'    => 'مدارس الندى النموذجية الأهلية',
            'hero_subtitle' => 'نُشكّل مستقبل أبنائنا بأيدٍ متخصصة وقلوب مخلصة في بيئة تعليمية آمنة ومحفّزة للإبداع',
            'phone'         => '+966 14 848 2306',
            'email'         => 'alnadaiec@gmail.com',
            'address'       => '(2957) شارع الحسين بن علي بن الأسود، حي البركة (8393)، المدينة المنورة 42332',
            'working_hours' => 'الأحد – الخميس: 7:00ص – 1:00م | الجمعة والسبت: مغلق',
            'instagram'     => 'alnada_school',
            'twitter'       => 'AIEC_',
            'facebook'      => 'Alnada2021',
            'whatsapp'      => '966559281924',
        ];

        SiteSetting::setMany($settings);

        // ===== Sample Announcements =====
        $announcements = [
            [
                'title'       => 'افتتاح باب التسجيل للعام الدراسي 1446هـ',
                'body'        => 'يسعد مدارس الندى النموذجية الأهلية الإعلان عن فتح باب التسجيل والقبول للعام الدراسي الجديد 1446هـ لجميع المراحل الدراسية. يرجى التواصل مع الإدارة للحصول على المزيد من التفاصيل وشروط القبول.',
                'category'    => 'تسجيل',
                'badge_color' => 'green',
                'is_published'=> true,
                'published_at'=> now(),
            ],
            [
                'title'       => 'ورشة عمل تدريبية لأولياء الأمور',
                'body'        => 'تدعوكم مدارس الندى لحضور ورشة عمل تدريبية متخصصة حول أساليب التعامل مع ذوي الاحتياجات الخاصة في المنزل. الورشة مجانية ومفتوحة لجميع أولياء الأمور.',
                'category'    => 'فعاليات',
                'badge_color' => 'gold',
                'is_published'=> true,
                'published_at'=> now()->subDays(3),
            ],
            [
                'title'       => 'الاحتفال باليوم الوطني السعودي 94',
                'body'        => 'احتفلت مدارس الندى باليوم الوطني السعودي 94 بفعاليات وأنشطة متنوعة شارك فيها الطلاب والكادر التعليمي في أجواء احتفالية مميزة تعكس الانتماء الوطني.',
                'category'    => 'أخبار',
                'badge_color' => 'blue',
                'is_published'=> true,
                'published_at'=> now()->subWeek(),
            ],
        ];

        foreach ($announcements as $ann) {
            Announcement::create($ann);
        }

        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('🔑 Admin credentials: username=admin | password=alnada2024');
    }
}
