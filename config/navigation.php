<?php

declare(strict_types=1);

return [
    // Static first link (always shown — the home anchor)
    'main' => [
        ['href' => '#home', 'label' => 'الرئيسية'],
    ],

    // Default nav labels for each built-in section type.
    // Used when the section has show_in_nav = true.
    'section_labels' => [
        'hero'         => 'الرئيسية',
        'about'        => 'من نحن',
        'why_us'       => 'لماذا نحن',
        'programs'     => 'برامجنا',
        'stats'        => 'إنجازاتنا',
        'testimonials' => 'آراء أولياء الأمور',
        'news'         => 'الأخبار',
        'contact'      => 'تواصل معنا',
    ],

    'footer_programs' => [
        ['href' => '#programs', 'label' => 'التعليم العام'],
        ['href' => '#programs', 'label' => 'التربية الخاصة'],
        ['href' => '#programs', 'label' => 'برامج الدمج'],
        ['href' => '#programs', 'label' => 'رياض الأطفال'],
        ['href' => '#programs', 'label' => 'علاج النطق'],
        ['href' => '#programs', 'label' => 'العلاج الوظيفي'],
    ],
];
