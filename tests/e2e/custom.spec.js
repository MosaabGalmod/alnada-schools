// @ts-check
import {
    test,
    expect
} from '@playwright/test';

const BASE_URL = 'http://127.0.0.1:8000';

async function loginAndCreateCustomSection(page, suffix) {
    const sectionLabel = `قسم مخصص آلي ${suffix}`;

    await page.goto(`${BASE_URL}/admin/login`, {
        waitUntil: 'networkidle'
    });
    await page.locator('input[name="username"]').fill('admin');
    await page.locator('input[name="password"]').fill('alnada2024');
    await page.getByRole('button', {
        name: 'تسجيل الدخول'
    }).click();
    await page.waitForURL(/\/admin$/);

    await page.goto(`${BASE_URL}/admin/sections`, {
        waitUntil: 'networkidle'
    });
    await page.getByRole('button', {
        name: 'إضافة قسم'
    }).click();
    await page.locator('input[placeholder="مثال: قسم خاص بالأنشطة"]').fill(sectionLabel);
    await page.getByRole('button', {
        name: 'إنشاء القسم'
    }).click();

    const row = page.locator('tr').filter({
        hasText: sectionLabel
    }).first();
    await expect(row).toBeVisible();
    await row.getByRole('button', {
        name: 'المحتوى'
    }).click();

    await page.locator('input[placeholder="تاج القسم (فوق العنوان)"]').fill('قسم معرفي');
    await page.locator('input[placeholder="العنوان الرئيسي"]').fill('محتوى مرن ومنظم');
    await page.locator('textarea[placeholder="النص الفرعي"]').fill('واجهة أكثر ثراءً للمحتوى الحر مع تنظيم بصري واضح.');
    await page.locator('textarea[placeholder="النص الرئيسي"]').fill(
        'فقرة افتتاحية تعرف بالقسم.\n\n>> رسالة بارزة للأسرة التعليمية\n\n- نقطة أولى\n- نقطة ثانية\n\nفقرة ختامية قصيرة.'
    );
    await page.getByRole('button', {
        name: 'حفظ التغييرات'
    }).click();
    await expect(page.getByText('تم حفظ المحتوى بنجاح')).toBeVisible();

    return sectionLabel;
}

async function gotoCustomSection(page, sectionLabel) {
    await page.goto(BASE_URL, {
        waitUntil: 'networkidle'
    });

    const section = page.locator('[data-testid="custom-section"]').filter({
        hasText: sectionLabel
    }).first();
    await section.scrollIntoViewIfNeeded();
    await page.waitForTimeout(250);

    return section;
}

test.describe('Custom Section', () => {
    test('renders structured content with RTL hooks and dark-mode-safe icons', async ({
        page,
        browser
    }) => {
        const sectionLabel = await loginAndCreateCustomSection(page, Date.now());
        const section = await gotoCustomSection(page, sectionLabel);

        await expect(section).toHaveAttribute('dir', 'rtl');
        await expect(section).toHaveAttribute('lang', 'ar');
        await expect(section.locator('[data-testid="custom-title"]')).toBeVisible();
        await expect(section.locator('[data-testid="custom-highlight"]')).toBeVisible();
        await expect(section.locator('[data-testid="custom-bullets"]')).toBeVisible();

        const iconShell = section.locator('[data-custom-icon]').first();
        const lightBackground = await iconShell.evaluate((element) => window.getComputedStyle(element).backgroundImage);
        expect(lightBackground).toContain('linear-gradient');

        const darkContext = await browser.newContext({
            colorScheme: 'dark',
            viewport: {
                width: 1440,
                height: 900
            },
        });
        const darkPage = await darkContext.newPage();
        const darkSection = await gotoCustomSection(darkPage, sectionLabel);
        const darkIcon = darkSection.locator('[data-custom-icon]').first();

        const iconShadow = await darkIcon.evaluate((element) => window.getComputedStyle(element).boxShadow);
        const iconFilter = await darkIcon.locator('svg').evaluate((element) => window.getComputedStyle(element).filter);
        const textColor = await darkSection.locator('[data-testid="custom-title"]').evaluate((element) => window.getComputedStyle(element).color);

        expect(iconShadow).not.toContain('rgba(255, 255, 255, 0.45)');
        expect(iconShadow).not.toContain('rgba(89, 194, 213, 0.3)');
        expect(iconFilter).toBe('none');
        expect(textColor).toBe('rgb(255, 255, 255)');

        await darkContext.close();
    });
});
