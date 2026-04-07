<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\SiteSetting;
use App\View\Components\Footer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FooterComponentTest extends TestCase
{
    use RefreshDatabase;

    public function test_footer_component_renders_default_footer_content(): void
    {
        $view = $this->component(Footer::class);

		$view->assertSee('وزارة التعليم');
        $view->assertSee('+966 14 848 2306');
        $view->assertSee('alnadaiec@gmail.com');
        $view->assertSee('ابدأ رحلة التسجيل');
    }

    public function test_footer_component_uses_site_settings_values_when_available(): void
    {
        SiteSetting::setMany([
            'phone' => '+966 55 111 2222',
            'email' => 'hello@alnada.test',
            'instagram' => 'alnada_custom',
            'working_hours' => 'الأحد - الخميس: 8:00ص - 2:00م',
        ]);

        $view = $this->component(Footer::class);

        $view->assertSee('+966 55 111 2222');
        $view->assertSee('hello@alnada.test');
        $view->assertSee('الأحد - الخميس: 8:00ص - 2:00م');
        $view->assertSee('https://www.instagram.com/alnada_custom/', false);
    }

    public function test_footer_component_sanitizes_social_handles_from_settings(): void
    {
        SiteSetting::setMany([
            'instagram' => '../bad<script>alert(1)</script>handle',
            'twitter' => 'AIEC_../bad',
        ]);

        $view = $this->component(Footer::class);

        $view->assertDontSee('../bad', false);
        $view->assertDontSee('<script>', false);
        $view->assertSee('https://www.instagram.com/badscriptalert1scripthandle/', false);
        $view->assertSee('https://x.com/AIEC_.bad', false);
    }

    public function test_footer_component_preserves_valid_leading_underscores_in_social_handles(): void
    {
        SiteSetting::setMany([
            'instagram' => '_alnada_school',
        ]);

        $view = $this->component(Footer::class);

        $view->assertSee('https://www.instagram.com/_alnada_school/', false);
    }
}
