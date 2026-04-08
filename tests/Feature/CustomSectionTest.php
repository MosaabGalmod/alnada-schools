<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Section;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomSectionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

        Section::create([
            'key' => 'custom_test',
            'type' => 'custom',
            'label' => 'قسم مخصص تجريبي',
            'sort_order' => 99,
            'is_visible' => true,
            'content' => [
                'tag' => 'قسم مخصص',
                'title' => 'مساحة مرنة للمحتوى',
                'subtitle' => 'نص تمهيدي يشرح الغرض من هذه المساحة المخصصة.',
                'body' => "فقرة افتتاحية تعرف بالقسم.\n\n>> رسالة بارزة للأسرة التعليمية\n\n- نقطة أولى\n- نقطة ثانية\n\nفقرة ختامية قصيرة.",
            ],
            'style' => [
                'bg_type' => 'white',
                'heading_color' => '#111827',
                'text_color' => '#374151',
                'accent_color' => '#1a9dc6',
                'font_size' => 'normal',
            ],
        ]);
    }

    public function test_custom_section_exposes_accessible_markup_and_rtl_hooks(): void
    {
        $section = $this->getCustomSectionMarkup();

        $this->assertNotNull($section);
        $this->assertStringContainsString('data-testid="custom-section"', $section);
        $this->assertStringContainsString('aria-labelledby="custom-heading-', $section);
        $this->assertStringContainsString('lang="ar"', $section);
        $this->assertStringContainsString('dir="rtl"', $section);
        $this->assertStringContainsString('data-testid="custom-title"', $section);
        $this->assertStringContainsString('data-testid="custom-subtitle"', $section);
        $this->assertStringContainsString('data-testid="custom-blocks"', $section);
    }

    public function test_custom_section_renders_structured_blocks_and_icon_hooks(): void
    {
        $section = $this->getCustomSectionMarkup();

        $this->assertNotNull($section);
        $this->assertStringContainsString('data-testid="custom-paragraph"', $section);
        $this->assertStringContainsString('data-testid="custom-highlight"', $section);
        $this->assertStringContainsString('data-testid="custom-bullets"', $section);
        $this->assertStringContainsString('data-custom-icon', $section);
        $this->assertStringContainsString('role="list"', $section);
    }

    private function getCustomSectionMarkup(): ?string
    {
        $content = $this->get('/')->getContent();

        preg_match('/<section[^>]*data-testid="custom-section"[^>]*>.*?<\/section>/s', $content, $matches);

        return $matches[0] ?? null;
    }
}
