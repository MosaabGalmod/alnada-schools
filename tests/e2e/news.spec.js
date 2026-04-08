// @ts-check
import {
    test,
    expect
} from '@playwright/test';

const BASE_URL = 'http://127.0.0.1:8000';

async function gotoNews(page) {
    await page.goto(BASE_URL, {
        waitUntil: 'networkidle'
    });

    for (let y = 0; y <= 6000; y += 400) {
        await page.evaluate((scrollY) => window.scrollTo(0, scrollY), y);
        await page.waitForTimeout(60);
    }

    await page.locator('#news').scrollIntoViewIfNeeded();
    await page.waitForTimeout(400);
}

test.describe('News Section', () => {
    test.beforeEach(async ({
        page
    }) => {
        await gotoNews(page);
    });

    test('section is visible and labeled by its heading and intro', async ({
        page
    }) => {
        const section = page.locator('#news[aria-labelledby="news-heading"][aria-describedby="news-intro"]');
        await expect(section).toHaveCount(1);
        await expect(page.locator('#news-heading')).toBeVisible();
        await expect(page.locator('#news-intro')).toBeVisible();
    });

    test('keeps rtl semantics and Arabic time copy inside the news UI', async ({
        page
    }) => {
        const section = page.locator('#news');
        const firstTime = page.locator('#news [data-news-time]').first();

        await expect(section).toHaveAttribute('dir', 'rtl');
        await expect(section).toHaveAttribute('lang', 'ar');
        await expect(firstTime).toHaveAttribute('dir', 'rtl');
        await expect(firstTime).toHaveAttribute('lang', 'ar');
        await expect(firstTime).toContainText(/منذ|اليوم|أمس|دقيقة|ساعة|أيام|أسبوع|شهر/);
    });

    test('renders a featured announcement and supporting feed cards', async ({
        page
    }) => {
        const featured = page.locator('[data-news-featured]');
        const cards = page.locator('[data-news-card]');

        await expect(featured).toBeVisible();
        await expect(featured.locator('[data-news-title]')).not.toBeEmpty();
        await expect(featured.locator('[data-news-body]')).not.toBeEmpty();
        await expect(cards.first()).toBeVisible();
        expect(await cards.count()).toBeGreaterThan(1);
    });

    test('uses stacked layout on mobile and split layout on desktop', async ({
        page
    }) => {
        await page.setViewportSize({
            width: 375,
            height: 812
        });
        await gotoNews(page);

        const featuredMobile = await page.locator('[data-news-featured]').boundingBox();
        const firstCardMobile = await page.locator('[data-news-card]').first().boundingBox();

        expect(featuredMobile).not.toBeNull();
        expect(firstCardMobile).not.toBeNull();
        expect(firstCardMobile.y).toBeGreaterThan(featuredMobile.y + 40);

        await page.setViewportSize({
            width: 1440,
            height: 900
        });
        await gotoNews(page);

        const featuredDesktop = await page.locator('[data-news-featured]').boundingBox();
        const cardsRailDesktop = await page.locator('[data-news-rail]').boundingBox();

        expect(featuredDesktop).not.toBeNull();
        expect(cardsRailDesktop).not.toBeNull();
        expect(Math.abs(featuredDesktop.y - cardsRailDesktop.y)).toBeLessThan(30);
    });

    test('keeps news icon treatment crisp in light mode', async ({
        page
    }) => {
        const icon = page.locator('#news [data-news-icon]').first();
        const iconShadow = await icon.evaluate((element) => window.getComputedStyle(element).boxShadow);
        const iconBg = await icon.evaluate((element) => window.getComputedStyle(element).backgroundImage);

        expect(iconBg).toContain('linear-gradient');
        expect(iconShadow).toContain('rgba(');
    });

    test('supports dark mode without icon glow and with readable text', async ({
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

        await gotoNews(page);

        const section = page.locator('#news');
        const icon = page.locator('#news [data-news-icon]').first();
        const title = page.locator('#news [data-news-title]').first();

        const sectionBg = await section.evaluate((element) => window.getComputedStyle(element).backgroundImage);
        const iconShadow = await icon.evaluate((element) => window.getComputedStyle(element).boxShadow);
        const iconFilter = await icon.locator('svg').evaluate((element) => window.getComputedStyle(element).filter);
        const titleColor = await title.evaluate((element) => window.getComputedStyle(element).color);

        expect(sectionBg).toContain('linear-gradient');
        expect(iconShadow).not.toContain('rgba(255, 255, 255, 0.6)');
        expect(iconShadow).not.toContain('rgba(89, 194, 213, 0.14)');
        expect(iconFilter).toBe('none');
        expect(titleColor).toBe('rgb(255, 255, 255)');

        await context.close();
    });
});
