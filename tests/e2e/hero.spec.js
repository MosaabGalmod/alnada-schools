// @ts-check
import {
    test,
    expect
} from '@playwright/test';

const BASE_URL = 'http://127.0.0.1:8000';

async function gotoHero(page) {
    await page.goto(BASE_URL, {
        waitUntil: 'networkidle'
    });
    await page.locator('#home').scrollIntoViewIfNeeded();
    await page.waitForTimeout(250);
}

test.describe('Hero Section', () => {
    test.beforeEach(async ({
        page
    }) => {
        await gotoHero(page);
    });

    test('section is visible and labeled by its heading', async ({
        page
    }) => {
        const section = page.locator('#home[aria-labelledby="hero-heading"][data-testid="hero-section"]');

        await expect(section).toBeVisible();
        await expect(page.locator('#hero-heading')).toBeVisible();
        await expect(page.locator('[data-testid="hero-subtitle"]')).toBeVisible();
    });

    test('renders CTA row and four stat cards', async ({
        page
    }) => {
        await expect(page.locator('[data-testid="hero-cta-primary"]')).toBeVisible();
        await expect(page.locator('[data-testid="hero-cta-secondary"]')).toBeVisible();
        await expect(page.locator('[data-testid="hero-stat"]')).toHaveCount(4);
        await expect(page.locator('[data-testid="hero-scroll-hint"]')).toBeVisible();
    });

    test('stacks compactly on mobile and spreads on desktop', async ({
        page
    }) => {
        await page.setViewportSize({
            width: 375,
            height: 812
        });
        await gotoHero(page);

        const mobileStats = await page.locator('[data-testid="hero-stat"]').evaluateAll((elements) => {
            return elements.map((element) => element.getBoundingClientRect());
        });

        const mobileVerticalGap = mobileStats[2].top - mobileStats[0].top;
        expect(mobileVerticalGap).toBeGreaterThan(mobileStats[0].height);

        await page.setViewportSize({
            width: 1440,
            height: 900
        });
        await gotoHero(page);

        const desktopStats = await page.locator('[data-testid="hero-stat"]').evaluateAll((elements) => {
            return elements.map((element) => element.getBoundingClientRect());
        });

        expect(Math.abs(desktopStats[0].top - desktopStats[3].top)).toBeLessThan(20);
    });

    test('keeps rtl semantics in the rendered hero UI', async ({
        page
    }) => {
        const section = page.locator('#home');
        const scrollHint = page.locator('[data-testid="hero-scroll-hint"]');

        await expect(section).toHaveAttribute('dir', 'rtl');
        await expect(section).toHaveAttribute('lang', 'ar');
        await expect(scrollHint).toHaveAttribute('href', '#about');
    });

    test('uses layered icon treatment in light mode', async ({
        page
    }) => {
        const iconShell = page.locator('[data-hero-icon]').first();
        const iconBackground = await iconShell.evaluate((element) => window.getComputedStyle(element).backgroundImage);
        const iconShadow = await iconShell.evaluate((element) => window.getComputedStyle(element).boxShadow);

        expect(iconBackground).toContain('linear-gradient');
        expect(iconShadow).toContain('rgba(');
    });

    test('supports dark mode without bright icon glow', async ({
        browser
    }) => {
        const context = await browser.newContext({
            colorScheme: 'dark',
            viewport: {
                width: 1440,
                height: 900
            },
        });
        const page = await context.newPage();

        await gotoHero(page);

        const section = page.locator('#home');
        const statCard = page.locator('[data-testid="hero-stat"]').first();
        const iconShell = page.locator('[data-hero-icon]').first();

        await expect(section).toHaveCSS('background-image', /linear-gradient/);

        const cardBackground = await statCard.evaluate((element) => window.getComputedStyle(element).backgroundColor);
        const iconShadow = await iconShell.evaluate((element) => window.getComputedStyle(element).boxShadow);
        const iconFilter = await iconShell.locator('svg').evaluate((element) => window.getComputedStyle(element).filter);

        expect(cardBackground).not.toBe('rgba(255, 255, 255, 0.1)');
        expect(iconShadow).not.toContain('rgba(255, 255, 255, 0.45)');
        expect(iconShadow).not.toContain('rgba(89, 194, 213, 0.3)');
        expect(iconFilter).toBe('none');

        await context.close();
    });
});
