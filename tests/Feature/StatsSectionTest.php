<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatsSectionTest extends TestCase
{
    use RefreshDatabase;

    private string $html;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->html = $this->get('/')->getContent();
    }

    // ── Landmark & ARIA ─────────────────────────────────────────────────

    public function test_section_has_correct_id(): void
    {
        $this->assertStringContainsString('id="stats"', $this->html);
    }

    public function test_section_has_aria_labelledby(): void
    {
        $markup = $this->getSectionMarkup();
        $this->assertNotNull($markup);
        $this->assertStringContainsString('aria-labelledby="stats-heading"', $markup);
    }

    public function test_heading_has_matching_id(): void
    {
        $markup = $this->getSectionMarkup();
        $this->assertNotNull($markup);
        $this->assertStringContainsString('id="stats-heading"', $markup);
    }

    public function test_section_has_stats_section_class(): void
    {
        $markup = $this->getSectionMarkup();
        $this->assertNotNull($markup);
        $this->assertStringContainsString('stats-section', $markup);
    }

    // ── Grid list ───────────────────────────────────────────────────────

    public function test_grid_has_role_list(): void
    {
        $markup = $this->getSectionMarkup();
        $this->assertNotNull($markup);
        $this->assertStringContainsString('role="list"', $markup);
        $this->assertStringContainsString('role="listitem"', $markup);
    }

    // ── Card structure ───────────────────────────────────────────────────

    public function test_cards_use_stats_card_class(): void
    {
        $markup = $this->getSectionMarkup();
        $this->assertNotNull($markup);
        $this->assertStringContainsString('stats-card', $markup);
    }

    public function test_icon_container_uses_stats_card_icon_class(): void
    {
        $markup = $this->getSectionMarkup();
        $this->assertNotNull($markup);
        $this->assertStringContainsString('stats-card-icon', $markup);
    }

    public function test_icon_is_aria_hidden(): void
    {
        $markup = $this->getSectionMarkup();
        $this->assertNotNull($markup);
        // SVG icon inside icon container should be aria-hidden
        $this->assertStringContainsString('aria-hidden="true"', $markup);
    }

    // ── Counter data ─────────────────────────────────────────────────────

    public function test_counters_have_data_target_attribute(): void
    {
        $markup = $this->getSectionMarkup();
        $this->assertNotNull($markup);
        $this->assertMatchesRegularExpression('/data-target="\d+"/', $markup);
    }

    public function test_counter_spans_have_counter_class(): void
    {
        $markup = $this->getSectionMarkup();
        $this->assertNotNull($markup);
        $this->assertStringContainsString('class="counter"', $markup);
    }

    public function test_cards_have_label(): void
    {
        $markup = $this->getSectionMarkup();
        $this->assertNotNull($markup);
        $this->assertStringContainsString('stats-card-label', $markup);
    }

    // ── Stagger animation ─────────────────────────────────────────────

    public function test_cards_have_stagger_delay_css_var(): void
    {
        $markup = $this->getSectionMarkup();
        $this->assertNotNull($markup);
        $this->assertMatchesRegularExpression('/--delay:\s*\d+ms/', $markup);
    }

    // ── Alpine ────────────────────────────────────────────────────────

    public function test_grid_has_alpine_stats_counter(): void
    {
        $markup = $this->getSectionMarkup();
        $this->assertNotNull($markup);
        $this->assertStringContainsString('x-data="statsCounter"', $markup);
    }

    // ── Helper ────────────────────────────────────────────────────────

    private function getSectionMarkup(): ?string
    {
        preg_match('/<section[^>]*id="stats"[^>]*>.*?<\/section>/s', $this->html, $matches);
        return $matches[0] ?? null;
    }
}
