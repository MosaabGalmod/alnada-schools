<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactSectionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_contact_section_exposes_accessible_heading_and_rtl_hooks(): void
    {
        $section = $this->getContactSectionMarkup();

        $this->assertNotNull($section);
        $this->assertStringContainsString('data-testid="contact-section"', $section);
        $this->assertStringContainsString('aria-labelledby="contact-heading"', $section);
        $this->assertStringContainsString('lang="ar"', $section);
        $this->assertStringContainsString('dir="rtl"', $section);
        $this->assertStringContainsString('data-testid="contact-title"', $section);
        $this->assertStringContainsString('data-testid="contact-subtitle"', $section);
    }

    public function test_contact_section_renders_clickable_cards_social_links_and_form_shell(): void
    {
        $section = $this->getContactSectionMarkup();

        $this->assertNotNull($section);
        $this->assertStringContainsString('data-testid="contact-address-card"', $section);
        $this->assertStringContainsString('data-testid="contact-phone-card"', $section);
        $this->assertStringContainsString('href="tel:+966148482306"', $section);
        $this->assertStringContainsString('data-testid="contact-email-card"', $section);
        $this->assertStringContainsString('href="mailto:alnadaiec@gmail.com"', $section);
        $this->assertStringContainsString('data-testid="contact-hours-card"', $section);
        $this->assertStringContainsString('data-testid="contact-social-instagram"', $section);
        $this->assertStringContainsString('data-testid="contact-social-whatsapp"', $section);
        $this->assertStringContainsString('data-testid="contact-map"', $section);
        $this->assertStringContainsString('data-testid="contact-form-shell"', $section);
        $this->assertStringContainsString('wire:submit="submit"', $section);
    }

    private function getContactSectionMarkup(): ?string
    {
        $content = $this->get('/')->getContent();

        preg_match('/<section[^>]*id="contact"[^>]*>.*?<\/section>/s', $content, $matches);

        return $matches[0] ?? null;
    }
}
