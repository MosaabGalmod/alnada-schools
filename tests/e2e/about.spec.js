// @ts-check
import {
    test,
    expect
} from '@playwright/test';

const BASE_URL = 'http://127.0.0.1:8000';

async function gotoAbout(page) {
    await page.goto(BASE_URL, {
        waitUntil: 'networkidle'
    });
    const section = page.locator('#about');
    await section.scrollIntoViewIfNeeded();
    await page.waitForTimeout(250);
    return section;
}

test.describe('About Section', () => {
    test('renders the visual card, floating badges, pillars, and CTA', async ({
        page
    }) => {
        const section = await gotoAbout(page);

        await expect(section).toBeVisible();
        await expect(section.locator('.section-title')).toBeVisible();
        await expect(section.locator('.floating-badge')).toHaveCount(2);
        await expect(section.locator('.pill-card')).toHaveCount(3);
        await expect(section.locator('a.btn-primary')).toHaveAttribute('href', '#contact');
    });

    test('stacks on mobile and becomes two columns on desktop', async ({
        page
    }) => {
        await page.setViewportSize({
            width: 375,
            height: 812
        });
        await gotoAbout(page);

        const mobileVisual = await page.locator('#about .grid > div').first().boundingBox();
        const mobileText = await page.locator('#about .grid > div').nth(1).boundingBox();
        expect(mobileVisual).not.toBeNull();
        expect(mobileText).not.toBeNull();
        expect(mobileText.y).toBeGreaterThan(mobileVisual.y + mobileVisual.height - 20);

        await page.setViewportSize({
            width: 1440,
            height: 900
        });
        await gotoAbout(page);

        const desktopVisual = await page.locator('#about .grid > div').first().boundingBox();
        const desktopText = await page.locator('#about .grid > div').nth(1).boundingBox();
        expect(desktopVisual).not.toBeNull();
        expect(desktopText).not.toBeNull();
        expect(Math.abs(desktopText.x - desktopVisual.x)).toBeGreaterThan(200);
    });

    test('keeps layered icon treatment in light mode', async ({
        page
    }) => {
        await gotoAbout(page);

        const visualCard = page.locator('#about .rounded-4xl').first();
        const floatingBadge = page.locator('#about .floating-badge').first();
        const badgeIcon = floatingBadge.locator('.rounded-xl').first();

        const visualBackground = await visualCard.evaluate((element) => window.getComputedStyle(element).backgroundImage);
        const badgeBackground = await floatingBadge.evaluate((element) => window.getComputedStyle(element).backgroundColor);
        const iconBackground = await badgeIcon.evaluate((element) => window.getComputedStyle(element).backgroundColor);

        expect(visualBackground).toContain('linear-gradient');
        expect(badgeBackground).toBe('rgb(255, 255, 255)');
        expect(iconBackground).not.toBe('rgba(0, 0, 0, 0)');
    });

    test('supports dark mode with readable badges, text, and no bright icon glow', async ({
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

        const section = await gotoAbout(page);
        const title = section.locator('.section-title');
        const floatingBadge = section.locator('.floating-badge').first();
        const floatingBadgeTitle = floatingBadge.locator('.about-floating-badge-title').first();
        const floatingBadgeMeta = floatingBadge.locator('.about-floating-badge-meta').first();
        const pillarText = section.locator('.pill-card p').first();
        const visualIconShell = section.locator('.rounded-3xl').first();

        const sectionBg = await section.evaluate((element) => window.getComputedStyle(element).backgroundColor);
        const titleColor = await title.evaluate((element) => window.getComputedStyle(element).color);
        const badgeBg = await floatingBadge.evaluate((element) => window.getComputedStyle(element).backgroundColor);
        const badgeTitleColor = await floatingBadgeTitle.evaluate((element) => window.getComputedStyle(element).color);
        const badgeMetaColor = await floatingBadgeMeta.evaluate((element) => window.getComputedStyle(element).color);
        const pillarTextColor = await pillarText.evaluate((element) => window.getComputedStyle(element).color);
        const iconShadow = await visualIconShell.evaluate((element) => window.getComputedStyle(element).boxShadow);

        expect(sectionBg).not.toBe('rgb(255, 255, 255)');
        expect(titleColor).toBe('rgb(255, 255, 255)');
        expect(badgeBg).not.toBe('rgb(255, 255, 255)');
        expect(badgeTitleColor).not.toBe('rgb(31, 41, 55)');
        expect(badgeMetaColor).not.toBe('rgb(156, 163, 175)');
        expect(pillarTextColor).not.toBe('rgb(75, 85, 99)');
        expect(iconShadow).not.toContain('rgba(255, 255, 255');
        expect(iconShadow).not.toContain('rgba(89, 194, 213, 0.3)');

        await context.close();
    });
});
