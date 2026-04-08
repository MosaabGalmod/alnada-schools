// @ts-check
import {
    test,
    expect
} from '@playwright/test';

const BASE_URL = 'http://127.0.0.1:8000';

async function gotoPrograms(page) {
    await page.goto(BASE_URL, {
        waitUntil: 'networkidle'
    });

    for (let y = 0; y <= 6000; y += 400) {
        await page.evaluate((scrollY) => window.scrollTo(0, scrollY), y);
        await page.waitForTimeout(60);
    }

    await page.locator('#programs').scrollIntoViewIfNeeded();
    await page.waitForTimeout(400);
}

test.describe('Programs Section', () => {
    test.beforeEach(async ({
        page
    }) => {
        await gotoPrograms(page);
    });

    test('section is visible and labeled by its heading', async ({
        page
    }) => {
        const section = page.locator('#programs[aria-labelledby="programs-heading"]');
        await expect(section).toHaveCount(1);

        const heading = page.locator('#programs-heading');
        await expect(heading).toBeVisible();
        await expect(heading).not.toBeEmpty();
    });

    test('renders an active program showcase with live content', async ({
        page
    }) => {
        const showcase = page.locator('[data-testid="programs-showcase"]');
        await expect(showcase).toBeVisible();
        await expect(showcase).toHaveAttribute('aria-live', 'polite');

        await expect(showcase.locator('[data-testid="programs-showcase-title"]')).not.toBeEmpty();
        await expect(showcase.locator('[data-testid="programs-showcase-description"]')).not.toBeEmpty();
    });

    test('cards are keyboard-focusable buttons with visible content', async ({
        page
    }) => {
        const cards = page.locator('#programs [data-program-card]');
        const count = await cards.count();

        expect(count).toBeGreaterThan(1);

        for (let i = 0; i < count; i++) {
            const card = cards.nth(i);
            await expect(card).toHaveAttribute('type', 'button');
            await expect(card.locator('[data-program-title]')).not.toBeEmpty();
            await expect(card.locator('[data-program-description]')).not.toBeEmpty();
            await expect(card.locator('[data-program-tags] .badge').first()).toBeVisible();
        }

        await cards.first().focus();
        await expect(cards.first()).toBeFocused();
    });

    test('hovering or focusing a card updates the showcase', async ({
        page
    }) => {
        const cards = page.locator('#programs [data-program-card]');
        const secondCard = cards.nth(1);
        const secondTitle = (await secondCard.locator('[data-program-title]').textContent()) ? .trim();
        const secondDescription = (await secondCard.locator('[data-program-description]').textContent()) ? .trim();

        expect(secondTitle).toBeTruthy();
        expect(secondDescription).toBeTruthy();

        await secondCard.hover();
        await page.waitForTimeout(150);

        await expect(page.locator('[data-testid="programs-showcase-title"]')).toHaveText(secondTitle);
        await expect(page.locator('[data-testid="programs-showcase-description"]')).toContainText(secondDescription);

        await cards.nth(0).focus();
        await cards.nth(0).press('Enter');

        const firstTitle = (await cards.nth(0).locator('[data-program-title]').textContent()) ? .trim();
        await expect(page.locator('[data-testid="programs-showcase-title"]')).toHaveText(firstTitle ? ? '');
    });

    test('uses stacked layout on mobile and multi-column layout on desktop', async ({
        page
    }) => {
        await page.setViewportSize({
            width: 375,
            height: 812
        });
        await gotoPrograms(page);

        const mobileCards = page.locator('#programs [data-program-card]');
        const mobileBox0 = await mobileCards.nth(0).boundingBox();
        const mobileBox1 = await mobileCards.nth(1).boundingBox();

        expect(mobileBox0).not.toBeNull();
        expect(mobileBox1).not.toBeNull();
        expect(mobileBox1.y).toBeGreaterThan(mobileBox0.y + 20);

        await page.setViewportSize({
            width: 1440,
            height: 900
        });
        await gotoPrograms(page);

        const desktopCards = page.locator('#programs [data-program-card]');
        const desktopBox0 = await desktopCards.nth(0).boundingBox();
        const desktopBox1 = await desktopCards.nth(1).boundingBox();

        expect(desktopBox0).not.toBeNull();
        expect(desktopBox1).not.toBeNull();
        expect(Math.abs(desktopBox0.y - desktopBox1.y)).toBeLessThan(24);
    });

    test('keeps the light mode card treatment intact', async ({
        page
    }) => {
        const firstCard = page.locator('#programs [data-program-card]').first();
        const cardTitleColor = await firstCard.locator('[data-program-title]').evaluate((element) => window.getComputedStyle(element).color);
        const cardBgImage = await firstCard.evaluate((element) => window.getComputedStyle(element).backgroundImage);

        expect(cardTitleColor).toBe('rgb(16, 42, 59)');
        expect(cardBgImage).toContain('linear-gradient');
    });

    test('supports dark mode with readable cards and showcase', async ({
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

        await gotoPrograms(page);

        const showcase = page.locator('[data-testid="programs-showcase"]');
        const firstCard = page.locator('#programs [data-program-card]').first();

        await expect(showcase).toBeVisible();
        await expect(firstCard).toBeVisible();

        const showcaseBg = await showcase.evaluate((element) => window.getComputedStyle(element).backgroundImage);
        const showcaseTextColor = await page
            .locator('[data-testid="programs-showcase-title"]')
            .evaluate((element) => window.getComputedStyle(element).color);
        const cardTextColor = await firstCard.locator('[data-program-title]').evaluate((element) => window.getComputedStyle(element).color);
        const cardBgImage = await firstCard.evaluate((element) => window.getComputedStyle(element).backgroundImage);

        expect(showcaseBg).toContain('linear-gradient');
        expect(showcaseTextColor).toBe('rgb(255, 255, 255)');
        expect(cardTextColor).toBe('rgb(255, 255, 255)');
        expect(cardBgImage).toContain('linear-gradient');

        await context.close();
    });

    test('removes bright icon glow in dark mode', async ({
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

        await gotoPrograms(page);

        const showcaseIcon = page.locator('.programs-showcase-icon');
        const cardIcon = page.locator('#programs .programs-card-icon').first();

        const showcaseShadow = await showcaseIcon.evaluate((element) => window.getComputedStyle(element).boxShadow);
        const cardShadow = await cardIcon.evaluate((element) => window.getComputedStyle(element).boxShadow);

        expect(showcaseShadow).not.toContain('rgba(89, 194, 213, 0.14)');
        expect(cardShadow).not.toContain('rgba(89, 194, 213, 0.14)');
        expect(showcaseShadow).not.toContain('rgba(255, 255, 255, 0.6)');
        expect(cardShadow).not.toContain('rgba(255, 255, 255, 0.6)');

        await context.close();
    });
});
