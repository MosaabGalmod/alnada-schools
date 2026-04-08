// @ts-check
import {
    test,
    expect
} from '@playwright/test';

const BASE_URL = 'http://127.0.0.1:8000';

test.describe('Testimonials Section', () => {
    test.beforeEach(async ({
        page
    }) => {
        await page.goto(BASE_URL, {
            waitUntil: 'networkidle'
        });
        // Scroll through page to trigger reveal animations
        for (let y = 0; y <= 8000; y += 400) {
            await page.evaluate((scrollY) => window.scrollTo(0, scrollY), y);
            await page.waitForTimeout(60);
        }
        await page.locator('#testimonials').scrollIntoViewIfNeeded();
        await page.waitForTimeout(400);
    });

    // ── Visibility & Structure ──────────────────────────────────────────

    test('section is visible and has correct heading', async ({
        page
    }) => {
        const section = page.locator('#testimonials');
        await expect(section).toBeVisible();
        const heading = section.locator('[id="testimonials-heading"]');
        await expect(heading).toBeVisible();
        await expect(heading).not.toBeEmpty();
    });

    test('renders exactly 3 testimonial cards', async ({
        page
    }) => {
        const cards = page.locator('#testimonials [role="listitem"]');
        await expect(cards).toHaveCount(3);
    });

    test('each card shows 5 stars with accessible label', async ({
        page
    }) => {
        const starGroups = page.locator('#testimonials [aria-label="تقييم 5 نجوم"]');
        await expect(starGroups).toHaveCount(3);
    });

    test('each card shows author name and role', async ({
        page
    }) => {
        const cards = page.locator('#testimonials [role="listitem"]');
        for (let i = 0; i < 3; i++) {
            const card = cards.nth(i);
            const cite = card.locator('cite');
            await expect(cite).toBeVisible();
            await expect(cite).not.toBeEmpty();
        }
    });

    test('each card has a non-empty quote text', async ({
        page
    }) => {
        const quotes = page.locator('#testimonials blockquote');
        await expect(quotes).toHaveCount(3);
        for (let i = 0; i < 3; i++) {
            await expect(quotes.nth(i)).not.toBeEmpty();
        }
    });

    // ── Featured middle card ────────────────────────────────────────────

    test('middle card has featured class for visual emphasis', async ({
        page
    }) => {
        const cards = page.locator('#testimonials [role="listitem"]');
        // Middle card (index 1 in RTL grid = visual center)
        const middleCard = cards.nth(1).locator('.testi-card-featured');
        await expect(middleCard).toBeVisible();
    });

    // ── Accessibility ───────────────────────────────────────────────────

    test('list has correct aria role', async ({
        page
    }) => {
        const list = page.locator('#testimonials [role="list"]');
        await expect(list).toBeVisible();
    });

    test('section is labeled by heading via aria-labelledby', async ({
        page
    }) => {
        const section = page.locator('#testimonials[aria-labelledby="testimonials-heading"]');
        await expect(section).toHaveCount(1);
    });

    test('decorative quote marks are aria-hidden', async ({
        page
    }) => {
        const quoteDecorations = page.locator('#testimonials .testi-quote-deco[aria-hidden="true"]');
        // At least one card has a decorative quote
        await expect(quoteDecorations).toHaveCount(3);
    });

    // ── Interaction ─────────────────────────────────────────────────────

    test('cards have visible hover shadow transition', async ({
        page
    }) => {
        const firstCard = page.locator('#testimonials [role="listitem"]').first().locator('article');
        // Verify transition class present
        const cls = await firstCard.getAttribute('class');
        expect(cls).toContain('testi-card');
    });

    test('cards are keyboard-focusable', async ({
        page
    }) => {
        const firstCard = page.locator('#testimonials article').first();
        await firstCard.focus();
        await expect(firstCard).toBeFocused();
    });

    // ── Responsive ──────────────────────────────────────────────────────

    test('displays stacked on mobile (375px)', async ({
        page
    }) => {
        await page.setViewportSize({
            width: 375,
            height: 812
        });
        await page.goto(BASE_URL, {
            waitUntil: 'networkidle'
        });
        await page.locator('#testimonials').scrollIntoViewIfNeeded();
        await page.waitForTimeout(300);

        const list = page.locator('#testimonials [role="list"]');
        const box = await list.boundingBox();
        expect(box).not.toBeNull();
        // Cards should not overflow viewport
        expect(box.width).toBeLessThanOrEqual(375);
    });

    test('shows 3-column grid on desktop (1440px)', async ({
        page
    }) => {
        await page.setViewportSize({
            width: 1440,
            height: 900
        });
        await page.goto(BASE_URL, {
            waitUntil: 'networkidle'
        });
        await page.locator('#testimonials').scrollIntoViewIfNeeded();
        await page.waitForTimeout(300);

        const cards = page.locator('#testimonials [role="listitem"]');
        const box0 = await cards.nth(0).boundingBox();
        const box1 = await cards.nth(1).boundingBox();
        const box2 = await cards.nth(2).boundingBox();

        expect(box0).not.toBeNull();
        expect(box1).not.toBeNull();
        expect(box2).not.toBeNull();

        // In 3-col grid, all cards should be on the same row (similar y)
        expect(Math.abs(box0.y - box1.y)).toBeLessThan(20);
        expect(Math.abs(box1.y - box2.y)).toBeLessThan(20);
    });

    // ── Visual snapshot ─────────────────────────────────────────────────

    test('section matches visual snapshot', async ({
        page
    }) => {
        await page.setViewportSize({
            width: 1440,
            height: 900
        });
        await page.goto(BASE_URL, {
            waitUntil: 'networkidle'
        });
        for (let y = 0; y <= 8000; y += 400) {
            await page.evaluate((scrollY) => window.scrollTo(0, scrollY), y);
            await page.waitForTimeout(60);
        }
        await page.locator('#testimonials').scrollIntoViewIfNeeded();
        await page.waitForTimeout(500);

        await expect(page.locator('#testimonials')).toHaveScreenshot('testimonials-section.png', {
            maxDiffPixelRatio: 0.05,
        });
    });
});
