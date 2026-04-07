<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_home_page_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_the_home_page_exposes_a_skip_link_to_main_content(): void
    {
        $response = $this->get('/');

        $response->assertSee('class="skip-link"', false);
        $response->assertSee('href="#main-content"', false);
        $response->assertSee('id="main-content"', false);
        $response->assertSee('role="main"', false);
    }

    public function test_the_home_page_uses_a_navigation_landmark_for_the_main_menu(): void
    {
        $response = $this->get('/');

        $response->assertSee('aria-label="القائمة الرئيسية"', false);
        $response->assertSee('aria-label="القائمة المحمولة"', false);
    }
}
