<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WhyUsSectionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_why_us_section_is_labeled_by_its_heading_and_intro(): void
    {
        $response = $this->get('/');

        $response->assertSee('id="why_us"', false);
        $response->assertSee('aria-labelledby="why-us-heading"', false);
        $response->assertSee('aria-describedby="why-us-intro"', false);
        $response->assertSee('id="why-us-heading"', false);
        $response->assertSee('id="why-us-intro"', false);
    }

    public function test_why_us_section_uses_semantic_list_markup_for_features(): void
    {
        $section = $this->getWhyUsSectionMarkup();

        $this->assertNotNull($section);
        $this->assertStringContainsString('<ul', $section);
        $this->assertStringContainsString('<li', $section);
        $this->assertStringNotContainsString('role="list"', $section);
        $this->assertStringNotContainsString('role="listitem"', $section);
    }

    public function test_why_us_section_contains_accessible_feature_headings(): void
    {
        $section = $this->getWhyUsSectionMarkup();

        $this->assertNotNull($section);
        $this->assertStringContainsString('<h2 id="why-us-heading"', $section);
        $this->assertStringContainsString('<h3', $section);
        $this->assertStringContainsString('aria-hidden="true"', $section);
    }

    public function test_why_us_section_exposes_interactive_summary_hooks(): void
    {
        $section = $this->getWhyUsSectionMarkup();

        $this->assertNotNull($section);
        $this->assertStringContainsString('x-data="whyUsSection(', $section);
        $this->assertStringContainsString('x-on:mouseenter="setActive(', $section);
        $this->assertStringContainsString('x-on:keydown.enter.prevent="setActive(', $section);
        $this->assertStringContainsString('x-on:keydown.space.prevent="setActive(', $section);
        $this->assertStringContainsString('x-text="activeFeature.title"', $section);
        $this->assertStringContainsString('x-text="activeFeature.body"', $section);
    }

    private function getWhyUsSectionMarkup(): ?string
    {
        $content = $this->get('/')->getContent();

        preg_match('/<section[^>]*id="why_us"[^>]*>.*?<\/section>/s', $content, $matches);

        return $matches[0] ?? null;
    }
}
