<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\View\Presenters\CustomSectionPresenter;
use PHPUnit\Framework\TestCase;

class CustomSectionPresenterTest extends TestCase
{
    public function test_it_parses_plain_text_into_structured_blocks(): void
    {
        $blocks = CustomSectionPresenter::fromBody(<<<'TEXT'
فقرة افتتاحية تعرف بالقسم.

>> رسالة بارزة للأسرة التعليمية

- نقطة أولى
- نقطة ثانية

فقرة ختامية قصيرة.
TEXT)->blocks();

        $this->assertCount(4, $blocks);
        $this->assertSame('paragraph', $blocks[0]['type']);
        $this->assertSame('highlight', $blocks[1]['type']);
        $this->assertSame('bullets', $blocks[2]['type']);
        $this->assertSame(['نقطة أولى', 'نقطة ثانية'], $blocks[2]['items']);
        $this->assertSame('paragraph', $blocks[3]['type']);
    }

    public function test_it_returns_empty_blocks_for_blank_body(): void
    {
        $blocks = CustomSectionPresenter::fromBody("  \n\n ")->blocks();

        $this->assertSame([], $blocks);
    }
}
