<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestimonialsSectionTest extends TestCase
{
    use RefreshDatabase;

    private string $html;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->html = $this->get('/')->getContent();
    }

    // ── Landmark & ARIA ────────────────────────────────────────────────

    public function test_section_has_correct_id_and_aria_label(): void
    {
        $this->assertStringContainsString('id="testimonials"', $this->html);
        $this->assertStringContainsString('aria-labelledby="testimonials-heading"', $this->html);
    }

    public function test_heading_has_matching_id(): void
    {
        $this->assertStringContainsString('id="testimonials-heading"', $this->html);
    }

    public function test_list_uses_semantic_role(): void
    {
        $markup = $this->getSectionMarkup();
        $this->assertNotNull($markup);
        $this->assertStringContainsString('role="list"', $markup);
        $this->assertStringContainsString('role="listitem"', $markup);
    }

    // ── Card structure ─────────────────────────────────────────────────

    public function test_each_card_has_star_rating_label(): void
    {
        $markup = $this->getSectionMarkup();
        $this->assertNotNull($markup);
        $this->assertStringContainsString('aria-label="تقييم 5 نجوم"', $markup);
    }

    public function test_each_card_has_blockquote_and_author(): void
    {
        $markup = $this->getSectionMarkup();
        $this->assertNotNull($markup);
        $this->assertStringContainsString('<blockquote', $markup);
        $this->assertStringContainsString('<cite', $markup);
    }

    public function test_decorative_quote_mark_is_aria_hidden(): void
    {
        $markup = $this->getSectionMarkup();
        $this->assertNotNull($markup);
        // Quote decoration should be hidden from screen readers
        $this->assertMatchesRegularExpression('/aria-hidden="true"[^>]*>.*?"/s', $markup);
    }

    public function test_avatar_initials_are_aria_hidden(): void
    {
        $markup = $this->getSectionMarkup();
        $this->assertNotNull($markup);
        // Avatar is decorative - class contains testi-avatar and is aria-hidden
        $this->assertStringContainsString('testi-avatar', $markup);
        $this->assertMatchesRegularExpression('/testi-avatar[^>]*aria-hidden="true"/', $markup);
    }

    // ── Scroll reveal ──────────────────────────────────────────────────

    public function test_section_has_reveal_animation(): void
    {
        $markup = $this->getSectionMarkup();
        $this->assertNotNull($markup);
        $this->assertStringContainsString('x-data="reveal"', $markup);
    }

    // ── Featured middle card ───────────────────────────────────────────

    public function test_middle_card_is_featured(): void
    {
        $markup = $this->getSectionMarkup();
        $this->assertNotNull($markup);
        $this->assertStringContainsString('testi-card-featured', $markup);
    }

    // ── Background ────────────────────────────────────────────────────

    public function test_section_has_testimonials_section_class(): void
    {
        $this->assertStringContainsString('testimonials-section', $this->html);
    }

    // ── Helper ────────────────────────────────────────────────────────

    private function getSectionMarkup(): ?string
    {
        preg_match('/<section[^>]*id="testimonials"[^>]*>.*?<\/section>/s', $this->html, $matches);
        return $matches[0] ?? null;
    }
}
