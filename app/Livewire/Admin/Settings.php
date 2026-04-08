<?php

declare(strict_types=1);

namespace App\Livewire\Admin;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Settings extends Component
{
    use WithFileUploads;

    /* ════════════════════════════════════════
     |  CONTACT
     ════════════════════════════════════════ */
    public string $phone         = '';
    public string $email         = '';
    public string $address       = '';
    public string $working_hours = '';

    /* ════════════════════════════════════════
     |  SOCIAL
     ════════════════════════════════════════ */
    public string $instagram = '';
    public string $twitter   = '';
    public string $facebook  = '';
    public string $whatsapp  = '';

    /* ════════════════════════════════════════
     |  BRANDING
     ════════════════════════════════════════ */
    public string $site_name     = '';
    public string $site_tagline  = '';
    public $logoFile    = null;
    public $faviconFile = null;
    public string $currentLogo    = '';
    public string $currentFavicon = '';

    /* ════════════════════════════════════════
     |  SEO
     ════════════════════════════════════════ */
    public string $seo_title_default       = '';
    public string $seo_description_default = '';
    public string $seo_keywords            = '';
    public string $seo_author              = '';

    /* ════════════════════════════════════════
     |  FOOTER
     ════════════════════════════════════════ */
    // CTA panel
    public string $footer_cta_badge = '';
    public string $footer_cta_title = '';
    public string $footer_cta_desc  = '';
    public string $footer_cta_btn1  = '';
    public string $footer_cta_btn2  = '';
    // Brand column
    public string $footer_brand_line1 = '';
    public string $footer_brand_line2 = '';
    public string $footer_about_desc  = '';
    // Stat cards
    public string $footer_stat1_label = '';
    public string $footer_stat1_value = '';
    public string $footer_stat2_label = '';
    public string $footer_stat2_value = '';
    public string $footer_stat3_label = '';
    public string $footer_stat3_value = '';
    // Nav section
    public string $footer_nav_kicker = '';
    public string $footer_nav_title  = '';
    public string $footer_nav_desc   = '';
    public string $footer_nav_chip   = '';
    // Contact section
    public string $footer_contact_kicker = '';
    public string $footer_contact_title  = '';
    public string $footer_contact_desc   = '';
    // Copyright
    public string $footer_copyright = '';

    /* ════════════════════════════════════════
     |  UI STRINGS
     ════════════════════════════════════════ */
    // Navbar
    public string $nav_brand_line1 = '';
    public string $nav_brand_line2 = '';
    public string $nav_cta_text    = '';
    // About section
    public string $about_year_label   = '';
    public string $about_year_sub     = '';
    public string $about_badge1_title = '';
    public string $about_badge1_sub   = '';
    public string $about_badge2_title = '';
    public string $about_badge2_sub   = '';
    public string $about_cta_text     = '';
    // Testimonials
    public string $testimonials_intro = '';
    // Why Us
    public string $why_us_intro = '';
    // Contact section
    public string $contact_kicker      = '';
    public string $contact_intro_title = '';
    public string $contact_intro_text  = '';
    public string $contact_form_kicker = '';
    public string $contact_form_title  = '';
    public string $contact_form_text   = '';

    /* ════════════════════════════════════════
     |  FLASH
     ════════════════════════════════════════ */
    public string $flashMsg  = '';
    public string $flashType = 'success';

    /* ════════════════════════════════════════
     |  LIFECYCLE
     ════════════════════════════════════════ */
    public function mount(): void
    {
        $s = SiteSetting::all_settings();

        // Contact
        $this->phone         = $s['phone']         ?? '';
        $this->email         = $s['email']         ?? '';
        $this->address       = $s['address']       ?? '';
        $this->working_hours = $s['working_hours'] ?? '';

        // Social
        $this->instagram = $s['instagram'] ?? '';
        $this->twitter   = $s['twitter']   ?? '';
        $this->facebook  = $s['facebook']  ?? '';
        $this->whatsapp  = $s['whatsapp']  ?? '';

        // Branding
        $this->site_name      = $s['site_name']     ?? 'مدارس الندى النموذجية الأهلية';
        $this->site_tagline   = $s['site_tagline']  ?? '';
        $this->currentLogo    = $s['logo_path']     ?? '';
        $this->currentFavicon = $s['favicon_path']  ?? '';

        // SEO
        $this->seo_title_default       = $s['seo_title_default']       ?? '';
        $this->seo_description_default = $s['seo_description_default'] ?? '';
        $this->seo_keywords            = $s['seo_keywords']            ?? '';
        $this->seo_author              = $s['seo_author']              ?? '';

        // Footer
        $this->footer_cta_badge     = $s['footer_cta_badge']     ?? '';
        $this->footer_cta_title     = $s['footer_cta_title']     ?? '';
        $this->footer_cta_desc      = $s['footer_cta_desc']      ?? '';
        $this->footer_cta_btn1      = $s['footer_cta_btn1']      ?? '';
        $this->footer_cta_btn2      = $s['footer_cta_btn2']      ?? '';
        $this->footer_brand_line1   = $s['footer_brand_line1']   ?? '';
        $this->footer_brand_line2   = $s['footer_brand_line2']   ?? '';
        $this->footer_about_desc    = $s['footer_about_desc']    ?? '';
        $this->footer_stat1_label   = $s['footer_stat1_label']   ?? '';
        $this->footer_stat1_value   = $s['footer_stat1_value']   ?? '';
        $this->footer_stat2_label   = $s['footer_stat2_label']   ?? '';
        $this->footer_stat2_value   = $s['footer_stat2_value']   ?? '';
        $this->footer_stat3_label   = $s['footer_stat3_label']   ?? '';
        $this->footer_stat3_value   = $s['footer_stat3_value']   ?? '';
        $this->footer_nav_kicker    = $s['footer_nav_kicker']    ?? '';
        $this->footer_nav_title     = $s['footer_nav_title']     ?? '';
        $this->footer_nav_desc      = $s['footer_nav_desc']      ?? '';
        $this->footer_nav_chip      = $s['footer_nav_chip']      ?? '';
        $this->footer_contact_kicker = $s['footer_contact_kicker'] ?? '';
        $this->footer_contact_title  = $s['footer_contact_title']  ?? '';
        $this->footer_contact_desc   = $s['footer_contact_desc']   ?? '';
        $this->footer_copyright      = $s['footer_copyright']      ?? '';

        // UI strings
        $this->nav_brand_line1   = $s['nav_brand_line1']   ?? '';
        $this->nav_brand_line2   = $s['nav_brand_line2']   ?? '';
        $this->nav_cta_text      = $s['nav_cta_text']      ?? '';
        $this->about_year_label  = $s['about_year_label']  ?? '';
        $this->about_year_sub    = $s['about_year_sub']    ?? '';
        $this->about_badge1_title = $s['about_badge1_title'] ?? '';
        $this->about_badge1_sub   = $s['about_badge1_sub']   ?? '';
        $this->about_badge2_title = $s['about_badge2_title'] ?? '';
        $this->about_badge2_sub   = $s['about_badge2_sub']   ?? '';
        $this->about_cta_text     = $s['about_cta_text']     ?? '';
        $this->testimonials_intro = $s['testimonials_intro'] ?? '';
        $this->why_us_intro       = $s['why_us_intro']       ?? '';
        $this->contact_kicker      = $s['contact_kicker']      ?? '';
        $this->contact_intro_title = $s['contact_intro_title'] ?? '';
        $this->contact_intro_text  = $s['contact_intro_text']  ?? '';
        $this->contact_form_kicker = $s['contact_form_kicker'] ?? '';
        $this->contact_form_title  = $s['contact_form_title']  ?? '';
        $this->contact_form_text   = $s['contact_form_text']   ?? '';
    }

    /* ════════════════════════════════════════
     |  SAVE — CONTACT
     ════════════════════════════════════════ */
    public function saveContact(): void
    {
        $this->validate([
            'phone'         => 'required|string|max:30',
            'email'         => 'required|email|max:100',
            'address'       => 'required|string|max:500',
            'working_hours' => 'required|string|max:200',
            'instagram'     => 'nullable|string|max:100',
            'twitter'       => 'nullable|string|max:100',
            'facebook'      => 'nullable|string|max:100',
            'whatsapp'      => 'nullable|string|max:20',
        ]);

        SiteSetting::setMany([
            'phone'         => $this->phone,
            'email'         => $this->email,
            'address'       => $this->address,
            'working_hours' => $this->working_hours,
            'instagram'     => $this->instagram,
            'twitter'       => $this->twitter,
            'facebook'      => $this->facebook,
            'whatsapp'      => $this->whatsapp,
        ]);

        $this->flash('تم حفظ معلومات التواصل ✓');
    }

    // Keep legacy alias
    public function save(): void
    {
        $this->saveContact();
    }

    /* ════════════════════════════════════════
     |  SAVE — BRANDING (text fields)
     ════════════════════════════════════════ */
    public function saveBranding(): void
    {
        $this->validate([
            'site_name'    => 'nullable|string|max:100',
            'site_tagline' => 'nullable|string|max:200',
        ]);

        SiteSetting::setMany([
            'site_name'    => $this->site_name,
            'site_tagline' => $this->site_tagline,
        ]);

        $this->flash('تم حفظ هوية الموقع ✓');
    }

    /* ════════════════════════════════════════
     |  LOGO / FAVICON UPLOAD
     ════════════════════════════════════════ */
    public function uploadLogo(): void
    {
        $this->validate([
            'logoFile' => 'required|image|max:2048|mimes:png,jpg,jpeg,svg,webp',
        ]);

        $this->deletePreviousFile($this->currentLogo);
        $path = $this->logoFile->store('branding', 'public');
        SiteSetting::set('logo_path', $path);
        $this->currentLogo = $path;
        $this->logoFile    = null;

        $this->flash('تم رفع الشعار ✓');
    }

    public function uploadFavicon(): void
    {
        $this->validate([
            'faviconFile' => 'required|image|max:512|mimes:png,jpg,jpeg,ico,webp',
        ]);

        $this->deletePreviousFile($this->currentFavicon);
        $path = $this->faviconFile->store('branding', 'public');
        SiteSetting::set('favicon_path', $path);
        $this->currentFavicon = $path;
        $this->faviconFile    = null;

        $this->flash('تم رفع الأيقونة ✓');
    }

    public function deleteLogo(): void
    {
        $this->deletePreviousFile($this->currentLogo);
        SiteSetting::set('logo_path', '');
        $this->currentLogo = '';
        $this->flash('تم حذف الشعار، سيُستخدم الافتراضي');
    }

    /* ════════════════════════════════════════
     |  SAVE — SEO
     ════════════════════════════════════════ */
    public function saveSeo(): void
    {
        $this->validate([
            'seo_title_default'       => 'nullable|string|max:150',
            'seo_description_default' => 'nullable|string|max:500',
            'seo_keywords'            => 'nullable|string|max:500',
            'seo_author'              => 'nullable|string|max:100',
        ]);

        SiteSetting::setMany([
            'seo_title_default'       => $this->seo_title_default,
            'seo_description_default' => $this->seo_description_default,
            'seo_keywords'            => $this->seo_keywords,
            'seo_author'              => $this->seo_author,
        ]);

        $this->flash('تم حفظ إعدادات السيو ✓');
    }

    /* ════════════════════════════════════════
     |  SAVE — FOOTER
     ════════════════════════════════════════ */
    public function saveFooter(): void
    {
        $this->validate([
            'footer_cta_badge'   => 'nullable|string|max:200',
            'footer_cta_title'   => 'nullable|string|max:200',
            'footer_cta_desc'    => 'nullable|string|max:1000',
            'footer_cta_btn1'    => 'nullable|string|max:60',
            'footer_cta_btn2'    => 'nullable|string|max:60',
            'footer_brand_line1' => 'nullable|string|max:80',
            'footer_brand_line2' => 'nullable|string|max:80',
            'footer_about_desc'  => 'nullable|string|max:500',
            'footer_stat1_label' => 'nullable|string|max:60',
            'footer_stat1_value' => 'nullable|string|max:60',
            'footer_stat2_label' => 'nullable|string|max:60',
            'footer_stat2_value' => 'nullable|string|max:100',
            'footer_stat3_label' => 'nullable|string|max:60',
            'footer_stat3_value' => 'nullable|string|max:200',
            'footer_nav_kicker'  => 'nullable|string|max:60',
            'footer_nav_title'   => 'nullable|string|max:200',
            'footer_nav_desc'    => 'nullable|string|max:300',
            'footer_nav_chip'    => 'nullable|string|max:60',
            'footer_contact_kicker' => 'nullable|string|max:60',
            'footer_contact_title'  => 'nullable|string|max:200',
            'footer_contact_desc'   => 'nullable|string|max:300',
            'footer_copyright'      => 'nullable|string|max:200',
        ]);

        SiteSetting::setMany([
            'footer_cta_badge'      => $this->footer_cta_badge,
            'footer_cta_title'      => $this->footer_cta_title,
            'footer_cta_desc'       => $this->footer_cta_desc,
            'footer_cta_btn1'       => $this->footer_cta_btn1,
            'footer_cta_btn2'       => $this->footer_cta_btn2,
            'footer_brand_line1'    => $this->footer_brand_line1,
            'footer_brand_line2'    => $this->footer_brand_line2,
            'footer_about_desc'     => $this->footer_about_desc,
            'footer_stat1_label'    => $this->footer_stat1_label,
            'footer_stat1_value'    => $this->footer_stat1_value,
            'footer_stat2_label'    => $this->footer_stat2_label,
            'footer_stat2_value'    => $this->footer_stat2_value,
            'footer_stat3_label'    => $this->footer_stat3_label,
            'footer_stat3_value'    => $this->footer_stat3_value,
            'footer_nav_kicker'     => $this->footer_nav_kicker,
            'footer_nav_title'      => $this->footer_nav_title,
            'footer_nav_desc'       => $this->footer_nav_desc,
            'footer_nav_chip'       => $this->footer_nav_chip,
            'footer_contact_kicker' => $this->footer_contact_kicker,
            'footer_contact_title'  => $this->footer_contact_title,
            'footer_contact_desc'   => $this->footer_contact_desc,
            'footer_copyright'      => $this->footer_copyright,
        ]);

        $this->flash('تم حفظ محتوى التذييل ✓');
    }

    /* ════════════════════════════════════════
     |  SAVE — UI STRINGS
     ════════════════════════════════════════ */
    public function saveUiStrings(): void
    {
        $this->validate([
            'nav_brand_line1'    => 'nullable|string|max:80',
            'nav_brand_line2'    => 'nullable|string|max:80',
            'nav_cta_text'       => 'nullable|string|max:60',
            'about_year_label'   => 'nullable|string|max:60',
            'about_year_sub'     => 'nullable|string|max:200',
            'about_badge1_title' => 'nullable|string|max:60',
            'about_badge1_sub'   => 'nullable|string|max:60',
            'about_badge2_title' => 'nullable|string|max:60',
            'about_badge2_sub'   => 'nullable|string|max:60',
            'about_cta_text'     => 'nullable|string|max:60',
            'testimonials_intro' => 'nullable|string|max:300',
            'why_us_intro'       => 'nullable|string|max:500',
            'contact_kicker'      => 'nullable|string|max:60',
            'contact_intro_title' => 'nullable|string|max:200',
            'contact_intro_text'  => 'nullable|string|max:500',
            'contact_form_kicker' => 'nullable|string|max:60',
            'contact_form_title'  => 'nullable|string|max:100',
            'contact_form_text'   => 'nullable|string|max:300',
        ]);

        SiteSetting::setMany([
            'nav_brand_line1'     => $this->nav_brand_line1,
            'nav_brand_line2'     => $this->nav_brand_line2,
            'nav_cta_text'        => $this->nav_cta_text,
            'about_year_label'    => $this->about_year_label,
            'about_year_sub'      => $this->about_year_sub,
            'about_badge1_title'  => $this->about_badge1_title,
            'about_badge1_sub'    => $this->about_badge1_sub,
            'about_badge2_title'  => $this->about_badge2_title,
            'about_badge2_sub'    => $this->about_badge2_sub,
            'about_cta_text'      => $this->about_cta_text,
            'testimonials_intro'  => $this->testimonials_intro,
            'why_us_intro'        => $this->why_us_intro,
            'contact_kicker'      => $this->contact_kicker,
            'contact_intro_title' => $this->contact_intro_title,
            'contact_intro_text'  => $this->contact_intro_text,
            'contact_form_kicker' => $this->contact_form_kicker,
            'contact_form_title'  => $this->contact_form_title,
            'contact_form_text'   => $this->contact_form_text,
        ]);

        $this->flash('تم حفظ نصوص الواجهة ✓');
    }

    /* ════════════════════════════════════════
     |  HELPERS
     ════════════════════════════════════════ */
    private function deletePreviousFile(string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    private function flash(string $msg, string $type = 'success'): void
    {
        $this->flashMsg  = $msg;
        $this->flashType = $type;
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.admin.settings');
    }
}
