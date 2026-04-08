<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\View\Presenters\ContactSectionPresenter;
use PHPUnit\Framework\TestCase;

class ContactSectionPresenterTest extends TestCase
{
    public function test_it_builds_clickable_contact_cards_from_site_settings(): void
    {
        $presenter = new ContactSectionPresenter([
            'phone' => '+966 14 848 2306',
            'email' => 'hello@example.com',
            'address' => 'المدينة المنورة',
            'working_hours' => 'الأحد - الخميس',
        ]);

        $cards = $presenter->infoCards();

        $this->assertCount(4, $cards);
        $this->assertSame('contact-phone-card', $cards[1]['testId']);
        $this->assertSame('tel:+966148482306', $cards[1]['href']);
        $this->assertSame('mailto:hello@example.com', $cards[2]['href']);
    }

    public function test_it_keeps_distinct_social_styles_and_labels(): void
    {
        $presenter = new ContactSectionPresenter([
            'instagram' => 'alnada_school',
            'twitter' => 'AIEC_',
            'facebook' => 'Alnada2021',
            'whatsapp' => '966559281924',
        ]);

        $socialLinks = $presenter->socialLinks();

        $this->assertCount(4, $socialLinks);
        $this->assertSame('Instagram', $socialLinks[0]['label']);
        $this->assertStringContainsString('from-yellow-400', $socialLinks[0]['gradient']);
        $this->assertStringContainsString('x.com/AIEC_', $socialLinks[1]['href']);
        $this->assertSame('contact-social-whatsapp', $socialLinks[3]['testId']);
    }
}
