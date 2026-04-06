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
            'content'    => ['title' => $label ?: 'قسم مخصص', 'tag' => '', 'subtitle' => '', 'body' => ''],
            'style'      => ['bg_type' => 'white', 'font_size' => 'normal'],
            'is_visible' => true,
            'sort_order' => $max + 1,
        ]);
    }

    public function delete(int $id): void
    {
        $section = Section::findOrFail($id);

        if ($section->type !== 'custom') {
            throw new RuntimeException('يمكن حذف الأقسام المخصصة فقط.');
        }

        $section->delete();
    }
}
