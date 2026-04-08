// @ts-check
import {
    test,
    expect
} from '@playwright/test';

const BASE_URL = 'http://127.0.0.1:8000';

test.describe('Stats Section', () => {
    test.beforeEach(async ({
        page
    }) => {
        await page.goto(BASE_URL, {
            waitUntil: 'networkidle'
        });
        // Scroll through page to trigger counter animations
        for (let y = 0; y <= 6000; y += 400) {
            await page.evaluate((scrollY) => window.scrollTo(0, scrollY), y);
            await page.waitForTimeout(60);
        }
        await page.locator('#stats').scrollIntoViewIfNeeded();
        await page.waitForTimeout(800); // allow counter animation to complete
    });

    // ── Visibility ────────────────────────────────────────────────────────

    test('section is visible', async ({
        page
    }) => {
        await expect(page.locator('#stats')).toBeVisible();
    });

    test('heading is visible and non-empty', async ({
        page
    }) => {
        const heading = page.locator('#stats #stats-heading');
        await expect(heading).toBeVisible();
        await expect(heading).not.toBeEmpty();
    });

    // ── Card count ────────────────────────────────────────────────────────

    test('renders correct number of stat cards', async ({
        page
    }) => {
        const cards = page.locator('#stats [role="listitem"]');
        const count = await cards.count();
        expect(count).toBeGreaterThanOrEqual(3);
        expect(count).toBeLessThanOrEqual(5);
    });

    // ── Icon containers ────────────────────────────────────────────────────

    test('icon containers are square (not stretched bars)', async ({
        page
    }) => {
        const icons = page.locator('#stats .stats-card-icon');
        const count = await icons.count();
        expect(count).toBeGreaterThan(0);

        for (let i = 0; i < count; i++) {
            const box = await icons.nth(i).boundingBox();
            expect(box).not.toBeNull();
            // Width and height should be roughly equal (square) within 5px
            expect(Math.abs(box.width - box.height)).toBeLessThan(10);
            // Should be a reasonable icon size, not a full-width bar
            expect(box.width).toBeLessThan(80);
            expect(box.width).toBeGreaterThan(30);
        }
    });

    test('each icon container contains an SVG', async ({
        page
    }) => {
        const svgs = page.locator('#stats .stats-card-icon svg');
        const count = await svgs.count();
        expect(count).toBeGreaterThan(0);
    });

    // ── Counter animation ─────────────────────────────────────────────────

    test('counters animate to non-zero values after scroll', async ({
        page
    }) => {
        const counters = page.locator('#stats .counter');
        const count = await counters.count();
        expect(count).toBeGreaterThan(0);

        for (let i = 0; i < count; i++) {
            const text = await counters.nth(i).textContent();
            const val = parseInt(text ? ? '0');
            expect(val).toBeGreaterThan(0);
        }
    });

    test('counter has data-target attribute set', async ({
        page
    }) => {
        const counters = page.locator('#stats [data-target]');
        await expect(counters.first()).toBeVisible();
        const target = await counters.first().getAttribute('data-target');
        expect(parseInt(target ? ? '0')).toBeGreaterThan(0);
    });

    // ── Labels ────────────────────────────────────────────────────────────

    test('each card has a visible label', async ({
        page
    }) => {
        const labels = page.locator('#stats .stats-card-label');
        const count = await labels.count();
        expect(count).toBeGreaterThan(0);
        for (let i = 0; i < count; i++) {
            await expect(labels.nth(i)).not.toBeEmpty();
        }
    });

    // ── Accessibility ─────────────────────────────────────────────────────

    test('list has correct aria role', async ({
        page
    }) => {
        await expect(page.locator('#stats [role="list"]')).toBeVisible();
    });

    test('section is labeled via aria-labelledby', async ({
        page
    }) => {
        const section = page.locator('#stats[aria-labelledby="stats-heading"]');
        await expect(section).toHaveCount(1);
    });

    // ── Responsive ────────────────────────────────────────────────────────

    test('single column layout on mobile (375px)', async ({
        page
    }) => {
        await page.setViewportSize({
            width: 375,
            height: 812
        });
        await page.goto(BASE_URL, {
            waitUntil: 'networkidle'
        });
        await page.locator('#stats').scrollIntoViewIfNeeded();
        await page.waitForTimeout(300);

        const cards = page.locator('#stats [role="listitem"]');
        const box0 = await cards.nth(0).boundingBox();
        const box1 = await cards.nth(1).boundingBox();
        // On mobile, cards should be in a 2-col grid, so card 0 & 1 on same row
        expect(box0).not.toBeNull();
        expect(box1).not.toBeNull();
        // Width should not overflow
        expect(box0.width).toBeLessThanOrEqual(375);
    });

    test('multi-column grid on desktop (1440px)', async ({
        page
    }) => {
        await page.setViewportSize({
            width: 1440,
            height: 900
        });
        await page.goto(BASE_URL, {
            waitUntil: 'networkidle'
        });
        for (let y = 0; y <= 6000; y += 400) {
            await page.evaluate((scrollY) => window.scrollTo(0, scrollY), y);
            await page.waitForTimeout(50);
        }
        await page.locator('#stats').scrollIntoViewIfNeeded();
        await page.waitForTimeout(400);

        const cards = page.locator('#stats [role="listitem"]');
        const box0 = await cards.nth(0).boundingBox();
        const box1 = await cards.nth(1).boundingBox();
        expect(box0).not.toBeNull();
        expect(box1).not.toBeNull();
        // Cards should be side-by-side (same Y)
        expect(Math.abs(box0.y - box1.y)).toBeLessThan(20);
    });

    // ── Dark mode ─────────────────────────────────────────────────────────

    test('dark mode: cards are visible and not white', async ({
        browser
    }) => {
        const context = await browser.newContext({
            colorScheme: 'dark',
            viewport: {
                width: 1440,
                height: 900
            }
        });
        const page = await context.newPage();
        await page.goto(BASE_URL, {
            waitUntil: 'networkidle'
        });
        for (let y = 0; y <= 6000; y += 400) {
            await page.evaluate((scrollY) => window.scrollTo(0, scrollY), y);
            await page.waitForTimeout(50);
        }
        await page.locator('#stats').scrollIntoViewIfNeeded();
        await page.waitForTimeout(400);

        const firstCard = page.locator('#stats .stats-card').first();
        const title = page.locator('#stats #stats-heading');
        const label = page.locator('#stats .stats-card-label').first();
        const number = page.locator('#stats .stats-card-number').first();
        await expect(firstCard).toBeVisible();

        // Background should not be white in dark mode
        const bg = await firstCard.evaluate((el) => window.getComputedStyle(el).backgroundColor);
        const titleColor = await title.evaluate((el) => window.getComputedStyle(el).color);
        const labelColor = await label.evaluate((el) => window.getComputedStyle(el).color);
        const numberColor = await number.evaluate((el) => window.getComputedStyle(el).color);
        // White = rgb(255, 255, 255) — should not be that in dark mode
        expect(bg).not.toBe('rgb(255, 255, 255)');
        expect(titleColor).toBe('rgb(255, 255, 255)');
        expect(numberColor).toBe('rgb(255, 255, 255)');
        expect(labelColor).not.toBe('rgb(55, 65, 81)');

        await context.close();
    });
});
