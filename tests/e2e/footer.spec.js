// @ts-check
import {
    test,
    expect
} from '@playwright/test';

const BASE_URL = 'http://127.0.0.1:8000';

async function gotoFooter(page) {
    await page.goto(BASE_URL, {
        waitUntil: 'networkidle'
    });
    const footer = page.locator('footer.footer-shell');
    await footer.scrollIntoViewIfNeeded();
    await page.waitForTimeout(250);
    return footer;
}

test.describe('Footer', () => {
    test('renders CTA, panels, and direct links', async ({
        page
    }) => {
        const footer = await gotoFooter(page);

        await expect(footer).toBeVisible();
        await expect(footer.locator('#footer-title')).toBeVisible();
        await expect(footer.locator('.footer-panel')).toHaveCount(4);
        await expect(footer.locator('a[href="#contact"]').first()).toBeVisible();
        await expect(footer.locator('.social-icon')).toHaveCount(4);
    });

    test('keeps footer usable on mobile and desktop', async ({
        page
    }) => {
        await page.setViewportSize({
            width: 375,
            height: 812
        });
        const mobileFooter = await gotoFooter(page);
        const mobilePanels = await mobileFooter.locator('.footer-panel').evaluateAll((elements) => {
            return elements.map((element) => element.getBoundingClientRect());
        });
        expect(mobilePanels[1].top).toBeGreaterThan(mobilePanels[0].top + mobilePanels[0].height - 20);

        await page.setViewportSize({
            width: 1440,
            height: 900
        });
        const desktopFooter = await gotoFooter(page);
        const desktopPanels = await desktopFooter.locator('.footer-panel').evaluateAll((elements) => {
            return elements.map((element) => element.getBoundingClientRect());
        });
        expect(Math.abs(desktopPanels[1].left - desktopPanels[2].left)).toBeGreaterThan(150);
    });

    test('supports dark mode without bright footer glow', async ({
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
        const footer = await gotoFooter(page);

        const logoShell = footer.locator('.group .bg-white').first();
        const orb = footer.locator('.footer-orb').first();
        const panel = footer.locator('.footer-panel').first();

        const logoBackground = await logoShell.evaluate((element) => window.getComputedStyle(element).backgroundColor);
        const logoShadow = await logoShell.evaluate((element) => window.getComputedStyle(element).boxShadow);
        const orbOpacity = await orb.evaluate((element) => window.getComputedStyle(element).opacity);
        const orbFilter = await orb.evaluate((element) => window.getComputedStyle(element).filter);
        const panelShadow = await panel.evaluate((element) => window.getComputedStyle(element).boxShadow);

        expect(logoBackground).not.toBe('rgb(255, 255, 255)');
        expect(logoShadow).not.toContain('rgba(255, 255, 255');
        expect(Number.parseFloat(orbOpacity)).toBeLessThan(0.2);
        expect(orbFilter).not.toContain('80px');
        expect(panelShadow).not.toContain('0 25px 50px');

        await context.close();
    });
});
