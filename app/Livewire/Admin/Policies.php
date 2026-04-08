<?php

namespace App\Livewire\Admin;

use App\Models\SiteSetting;
use Livewire\Component;

class Policies extends Component
{
    public string $privacy_policy = '';
    public string $terms_of_use = '';
    public string $privacyMessage = '';
    public string $termsMessage = '';

    public function mount(): void
    {
        $this->privacy_policy = SiteSetting::get('privacy_policy', '');
        $this->terms_of_use   = SiteSetting::get('terms_of_use', '');
    }

    public function savePrivacy(): void
    {
        SiteSetting::set('privacy_policy', $this->privacy_policy);
        $this->privacyMessage = 'تم حفظ سياسة الخصوصية ✓';
    }

    public function saveTerms(): void
    {
        SiteSetting::set('terms_of_use', $this->terms_of_use);
        $this->termsMessage = 'تم حفظ شروط الاستخدام ✓';
    }

    public function render()
    {
        return view('livewire.admin.policies');
    }
}
