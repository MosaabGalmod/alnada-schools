<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Section;
use Illuminate\Database\Eloquent\Collection;
use RuntimeException;

class SectionService
{
    public function getVisible(): Collection
    {
        return Section::visible()->ordered()->get();
    }

    public function all(): Collection
    {
        return Section::ordered()->get();
    }

    public function find(int $id): Section
    {
        return Section::findOrFail($id);
    }

    public function updateContent(int $id, array $content): void
    {
        Section::findOrFail($id)->update(['content' => $content]);
    }

    public function updateStyle(int $id, array $style): void
    {
        Section::findOrFail($id)->update(['style' => $style]);
    }

    public function toggleVisibility(int $id): void
    {
        $section = Section::findOrFail($id);
        $section->update(['is_visible' => ! $section->is_visible]);
    }

    public function moveUp(int $id): void
    {
        $section = Section::findOrFail($id);
        $prev = Section::where('sort_order', '<', $section->sort_order)
            ->orderByDesc('sort_order')->first();

        if ($prev) {
            [$section->sort_order, $prev->sort_order] = [$prev->sort_order, $section->sort_order];
            $section->save();
            $prev->save();
        }
    }

    public function moveDown(int $id): void
    {
        $section = Section::findOrFail($id);
        $next = Section::where('sort_order', '>', $section->sort_order)
            ->orderBy('sort_order')->first();

        if ($next) {
            [$section->sort_order, $next->sort_order] = [$next->sort_order, $section->sort_order];
            $section->save();
            $next->save();
        }
    }

    public function createCustom(string $label): Section
    {
        $max = Section::max('sort_order') ?? 0;
        return Section::create([
            'key'        => 'custom_' . time(),
            'type'       => 'custom',
            'label'      => $label ?: 'قسم مخصص',
            'content'    => [
                'title'            => $label ?: 'قسم مخصص',
                'tag'              => '',
                'subtitle'         => '',
                'body'             => '',
                'intro_card_title' => '',
                'intro_card_body'  => '',
            ],
            'style'      => ['bg_type' => 'white', 'font_size' => 'normal'],
            'is_visible' => true,
            'sort_order' => $max + 1,
        ]);
    }

    public function duplicate(int $id): Section
    {
        $source = Section::findOrFail($id);
        $max    = Section::max('sort_order') ?? 0;

        return Section::create([
            'key'        => ($source->type === 'custom' ? 'custom_' : $source->type . '_') . time(),
            'type'       => $source->type,
            'label'      => 'نسخة من: ' . $source->label,
            'content'    => $source->content,
            'style'      => $source->style,
            'is_visible' => false,
            'sort_order' => $max + 1,
        ]);
    }

    public function delete(int $id): void
    {
        Section::findOrFail($id)->delete();
    }

    /** Re-create a built-in section from seeder defaults if it was deleted */
    public function restoreBuiltIn(string $type): Section
    {
        if (Section::where('type', $type)->exists()) {
            throw new RuntimeException('القسم موجود بالفعل.');
        }

        $defaults = $this->builtInDefaults($type);
        $max      = Section::max('sort_order') ?? 0;

        return Section::create([...$defaults, 'sort_order' => $max + 1]);
    }

    private function builtInDefaults(string $type): array
    {
        return match ($type) {
            'hero' => [
                'key' => 'hero', 'type' => 'hero', 'label' => 'قسم الهيرو',
                'content' => ['badge' => 'مدارس الندى النموذجية', 'title' => 'نصنع المستقبل', 'title_accent' => 'بالتربية الخاصة', 'subtitle' => '', 'cta_primary' => 'تواصل معنا', 'cta_secondary' => 'تعرف علينا', 'stats' => []],
                'style' => [], 'is_visible' => true,
            ],
            'about' => [
                'key' => 'about', 'type' => 'about', 'label' => 'من نحن',
                'content' => ['tag' => 'من نحن', 'title' => 'مدارس الندى النموذجية الأهلية', 'body1' => '', 'body2' => '', 'founding_year' => '2010', 'vision_title' => 'رؤيتنا', 'vision_body' => '', 'mission_title' => 'رسالتنا', 'mission_body' => '', 'values_title' => 'قيمنا', 'values_body' => '', 'accessibility_note' => ''],
                'style' => [], 'is_visible' => true,
            ],
            'news' => [
                'key' => 'news', 'type' => 'news', 'label' => 'الأخبار والإعلانات',
                'content' => ['tag' => 'أخبار', 'title' => 'آخر المستجدات'],
                'style' => [], 'is_visible' => true,
            ],
            'contact' => [
                'key' => 'contact', 'type' => 'contact', 'label' => 'تواصل معنا',
                'content' => ['tag' => 'تواصل', 'title' => 'نحن هنا لمساعدتك', 'subtitle' => ''],
                'style' => [], 'is_visible' => true,
            ],
            default => throw new RuntimeException("نوع القسم '{$type}' غير معروف."),
        };
    }
}
