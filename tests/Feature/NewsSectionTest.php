<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsSectionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_news_section_is_labeled_by_heading_and_intro(): void
    {
        $response = $this->get('/');

        $response->assertSee('id="news"', false);
        $response->assertSee('aria-labelledby="news-heading"', false);
        $response->assertSee('aria-describedby="news-intro"', false);
        $response->assertSee('id="news-heading"', false);
        $response->assertSee('id="news-intro"', false);
    }

    public function test_news_section_exposes_feed_and_featured_story_markup(): void
    {
        $section = $this->getNewsSectionMarkup();

        $this->assertNotNull($section);
        $this->assertStringContainsString('role="feed"', $section);
        $this->assertStringContainsString('data-news-featured', $section);
        $this->assertStringContainsString('data-news-card', $section);
        $this->assertStringContainsString('data-news-icon', $section);
    }

    public function test_news_section_is_explicitly_rtl_and_uses_arabic_time_markup(): void
    {
        $section = $this->getNewsSectionMarkup();

        $this->assertNotNull($section);
        $this->assertStringContainsString('dir="rtl"', $section);
        $this->assertStringContainsString('lang="ar"', $section);
        $this->assertStringContainsString('data-news-time', $section);
        $this->assertMatchesRegularExpression('/<time[^>]*data-news-time[^>]*>[^<]*[\x{0600}-\x{06FF}]+/u', $section);
    }

    private function getNewsSectionMarkup(): ?string
    {
        $content = $this->get('/')->getContent();

        preg_match('/<section[^>]*id="news"[^>]*>.*?<\/section>/s', $content, $matches);

        return $matches[0] ?? null;
    }
}
