// @ts-check
import {
    test,
    expect
} from '@playwright/test';

const BASE_URL = 'http://127.0.0.1:8000';

async function gotoContact(page) {
    await page.goto(BASE_URL, {
        waitUntil: 'networkidle'
    });
    const section = page.locator('[data-testid="contact-section"]');
    await section.scrollIntoViewIfNeeded();
    await page.waitForTimeout(250);
    return section;
}

test.describe('Contact Section', () => {
    test('renders labeled cards, form shell, and responsive layout with dark-mode-safe icons', async ({
        page,
        browser
    }) => {
        const section = await gotoContact(page);

        await expect(section).toHaveAttribute('dir', 'rtl');
        await expect(section).toHaveAttribute('lang', 'ar');
        await expect(section.locator('[data-testid="contact-title"]')).toBeVisible();
        await expect(section.locator('[data-testid="contact-form-shell"]')).toBeVisible();
        await expect(section.locator('[data-testid^="contact-social-"]')).toHaveCount(4);

        const phoneCard = section.locator('[data-testid="contact-phone-card"]');
        const emailCard = section.locator('[data-testid="contact-email-card"]');
        await expect(phoneCard).toHaveAttribute('href', /tel:/);
        await expect(emailCard).toHaveAttribute('href', /mailto:/);

        await page.setViewportSize({
            width: 375,
            height: 812
        });
        const mobileSection = await gotoContact(page);
        const mobileInfo = await mobileSection.locator('[data-testid="contact-info-column"]').boundingBox();
        const mobileForm = await mobileSection.locator('[data-testid="contact-form-column"]').boundingBox();
        expect(mobileInfo).not.toBeNull();
        expect(mobileForm).not.toBeNull();
        expect(mobileForm.y).toBeGreaterThan(mobileInfo.y + mobileInfo.height - 20);

        await page.setViewportSize({
            width: 1440,
            height: 900
        });
        const desktopSection = await gotoContact(page);
        const desktopInfo = await desktopSection.locator('[data-testid="contact-info-column"]').boundingBox();
        const desktopForm = await desktopSection.locator('[data-testid="contact-form-column"]').boundingBox();
        expect(desktopInfo).not.toBeNull();
        expect(desktopForm).not.toBeNull();
        expect(desktopForm.x).toBeGreaterThan(desktopInfo.x + desktopInfo.width - 20);

        const socialIcon = desktopSection.locator('[data-contact-icon]').first();
        const lightBg = await socialIcon.evaluate((element) => window.getComputedStyle(element).backgroundImage);
        expect(lightBg).toContain('linear-gradient');

        const darkContext = await browser.newContext({
            colorScheme: 'dark',
            viewport: {
                width: 1440,
                height: 900
            },
        });
        const darkPage = await darkContext.newPage();
        const darkSection = await gotoContact(darkPage);
        const darkIcon = darkSection.locator('[data-contact-icon]').first();
        const iconShadow = await darkIcon.evaluate((element) => window.getComputedStyle(element).boxShadow);
        const iconFilter = await darkIcon.locator('svg').evaluate((element) => window.getComputedStyle(element).filter);
        const titleColor = await darkSection.locator('[data-testid="contact-title"]').evaluate((element) => window.getComputedStyle(element).color);

        expect(iconShadow).not.toContain('rgba(255, 255, 255, 0.45)');
        expect(iconShadow).not.toContain('rgba(89, 194, 213, 0.3)');
        expect(iconFilter).toBe('none');
        expect(titleColor).toBe('rgb(255, 255, 255)');

        await darkContext.close();
    });
});
