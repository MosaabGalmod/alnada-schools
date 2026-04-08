<?php

declare(strict_types=1);

namespace App\View\Support;

/**
 * Central SVG icon registry (Heroicons outline paths).
 *
 * Each entry: [svgPath, arabicLabel, category]
 * Usage:
 *   IconLibrary::path('book')          → SVG <path d="…">
 *   IconLibrary::all()                 → all icons for admin picker
 *   IconLibrary::forCategory('edu')    → education-related icons only
 */
final class IconLibrary
{
    /** @var array<string, array{path: string, label: string, category: string}> */
    private const ICONS = [
        // ── Education ──────────────────────────────────────────────────
        'book' => [
            'path'     => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
            'label'    => 'كتاب',
            'category' => 'edu',
        ],
        'academic-cap' => [
            'path'     => 'M12 14l9-5-9-5-9 5 9 5zM12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z',
            'label'    => 'قبعة التخرج',
            'category' => 'edu',
        ],
        'pencil' => [
            'path'     => 'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z',
            'label'    => 'قلم',
            'category' => 'edu',
        ],
        'clipboard' => [
            'path'     => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01',
            'label'    => 'لوحة',
            'category' => 'edu',
        ],
        'light-bulb' => [
            'path'     => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z',
            'label'    => 'مصباح (ابتكار)',
            'category' => 'edu',
        ],
        'calculator' => [
            'path'     => 'M9 7H6a2 2 0 00-2 2v9a2 2 0 002 2h9a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4',
            'label'    => 'آلة حاسبة',
            'category' => 'edu',
        ],

        // ── People ─────────────────────────────────────────────────────
        'users' => [
            'path'     => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
            'label'    => 'مجموعة أشخاص',
            'category' => 'people',
        ],
        'user' => [
            'path'     => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
            'label'    => 'شخص',
            'category' => 'people',
        ],
        'user-group' => [
            'path'     => 'M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z',
            'label'    => 'فريق',
            'category' => 'people',
        ],
        'child' => [
            'path'     => 'M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
            'label'    => 'طفل / ابتسامة',
            'category' => 'people',
        ],
        'microphone' => [
            'path'     => 'M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z',
            'label'    => 'علاج النطق',
            'category' => 'people',
        ],
        'chat' => [
            'path'     => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z',
            'label'    => 'محادثة',
            'category' => 'people',
        ],

        // ── Achievement ────────────────────────────────────────────────
        'star' => [
            'path'     => 'm12 3 2.65 5.37L20.5 9.2l-4.25 4.15 1 5.9L12 16.8l-5.25 2.45 1-5.9L3.5 9.2l5.85-.83L12 3Z',
            'label'    => 'نجمة',
            'category' => 'achievement',
        ],
        'badge-check' => [
            'path'     => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z',
            'label'    => 'شارة اعتماد',
            'category' => 'achievement',
        ],
        'trophy' => [
            'path'     => 'M6 3h12M6 3v14a3 3 0 003 3h6a3 3 0 003-3V3M6 3H4a1 1 0 00-1 1v2a4 4 0 004 4h1M18 3h2a1 1 0 011 1v2a4 4 0 01-4 4h-1m-4 7v1m-2 0h4',
            'label'    => 'كأس',
            'category' => 'achievement',
        ],
        'trending-up' => [
            'path'     => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6',
            'label'    => 'تطور / نمو',
            'category' => 'achievement',
        ],
        'chart-bar' => [
            'path'     => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
            'label'    => 'رسم بياني',
            'category' => 'achievement',
        ],

        // ── Care & Support ─────────────────────────────────────────────
        'heart' => [
            'path'     => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
            'label'    => 'قلب / رعاية',
            'category' => 'care',
        ],
        'shield' => [
            'path'     => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
            'label'    => 'درع / حماية',
            'category' => 'care',
        ],
        'hand' => [
            'path'     => 'M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11',
            'label'    => 'يد مساعدة',
            'category' => 'care',
        ],
        'puzzle' => [
            'path'     => 'M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z',
            'label'    => 'تكامل',
            'category' => 'care',
        ],
        'clock' => [
            'path'     => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
            'label'    => 'ساعة / وقت',
            'category' => 'care',
        ],
    ];

    /** Default fallback icon key */
    public const DEFAULT = 'clipboard';

    /**
     * Get SVG path string for a named icon.
     * Returns the fallback path if key not found.
     */
    public static function path(string $key, ?string $fallbackKey = null): string
    {
        if (isset(self::ICONS[$key])) {
            return self::ICONS[$key]['path'];
        }

        $fb = $fallbackKey ?? self::DEFAULT;

        return self::ICONS[$fb]['path'] ?? self::ICONS[self::DEFAULT]['path'];
    }

    /**
     * All icons as [key => ['path', 'label', 'category']] for admin pickers.
     *
     * @return array<string, array{path: string, label: string, category: string}>
     */
    public static function all(): array
    {
        return self::ICONS;
    }

    /**
     * Icons filtered by category.
     *
     * @return array<string, array{path: string, label: string, category: string}>
     */
    public static function forCategory(string $category): array
    {
        return array_filter(
            self::ICONS,
            static fn(array $icon): bool => $icon['category'] === $category,
        );
    }

    /**
     * Flat list [key => label] for simple HTML <select> elements.
     *
     * @return array<string, string>
     */
    public static function selectOptions(): array
    {
        $opts = [];
        foreach (self::ICONS as $key => $icon) {
            $opts[$key] = $icon['label'];
        }

        return $opts;
    }
}
