<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HeroSectionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_hero_section_exposes_accessible_heading_and_hooks(): void
    {
        $section = $this->getHeroSectionMarkup();

        $this->assertNotNull($section);
        $this->assertStringContainsString('id="home"', $section);
        $this->assertStringContainsString('class="hero-section', $section);
        $this->assertStringContainsString('aria-labelledby="hero-heading"', $section);
        $this->assertStringContainsString('data-hero-surface', $section);
        $this->assertStringContainsString('data-testid="hero-section"', $section);
        $this->assertStringContainsString('id="hero-heading"', $section);
        $this->assertStringContainsString('data-testid="hero-title"', $section);
        $this->assertStringContainsString('data-testid="hero-subtitle"', $section);
    }

    public function test_hero_section_exposes_ctas_stats_and_scroll_hint_markup(): void
    {
        $section = $this->getHeroSectionMarkup();

        $this->assertNotNull($section);
        $this->assertStringContainsString('data-testid="hero-cta-primary"', $section);
        $this->assertStringContainsString('data-testid="hero-cta-secondary"', $section);
        $this->assertStringContainsString('role="list"', $section);
        $this->assertSame(4, preg_match_all('/data-testid="hero-stat"/', $section));
        $this->assertStringContainsString('data-testid="hero-scroll-hint"', $section);
        $this->assertStringContainsString('data-hero-icon', $section);
        $this->assertStringContainsString('aria-hidden="true"', $section);
    }

    public function test_hero_section_keeps_rtl_semantics_and_logical_positioning(): void
    {
        $section = $this->getHeroSectionMarkup();

        $this->assertNotNull($section);
        $this->assertStringContainsString('lang="ar"', $section);
        $this->assertStringContainsString('dir="rtl"', $section);
        $this->assertStringContainsString('start-1/2', $section);
        $this->assertStringNotContainsString('left-1/2', $section);
    }

    private function getHeroSectionMarkup(): ?string
    {
        $content = $this->get('/')->getContent();

        preg_match('/<section[^>]*id="home"[^>]*>.*?<\/section>/s', $content, $matches);

        return $matches[0] ?? null;
    }
}
