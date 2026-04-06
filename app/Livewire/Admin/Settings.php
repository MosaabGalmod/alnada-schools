<?php

declare(strict_types=1);

namespace App\Livewire\Admin;

use App\Models\SiteSetting;
use Livewire\Component;

class Settings extends Component
{
    /* ── Contact ──────────────────────────────────────── */
    public string $phone         = '';
    public string $email         = '';
    public string $address       = '';
    public string $working_hours = '';

    /* ── Social ───────────────────────────────────────── */
    public string $instagram = '';
    public string $twitter   = '';
    public string $facebook  = '';
    public string $whatsapp  = '';

    /* ── Flash ────────────────────────────────────────── */
    public string $flashMsg  = '';
    public string $flashType = 'success';

    public function mount(): void
    {
        $s = SiteSetting::all_settings();

        $this->phone         = $s['phone']         ?? '';
        $this->email         = $s['email']         ?? '';
        $this->address       = $s['address']       ?? '';
        $this->working_hours = $s['working_hours'] ?? '';
        $this->instagram     = $s['instagram']     ?? '';
        $this->twitter       = $s['twitter']       ?? '';
        $this->facebook      = $s['facebook']      ?? '';
        $this->whatsapp      = $s['whatsapp']      ?? '';
    }

    public function save(): void
    {
        $validated = $this->validate([
            'phone'         => 'required|string|max:30',
            'email'         => 'required|email|max:100',
            'address'       => 'required|string|max:500',
            'working_hours' => 'required|string|max:200',
            'instagram'     => 'nullable|string|max:100',
            'twitter'       => 'nullable|string|max:100',
            'facebook'      => 'nullable|string|max:100',
            'whatsapp'      => 'nullable|string|max:20',
        ]);

        SiteSetting::setMany($validated);

        $this->flashMsg  = 'تم حفظ الإعدادات بنجاح ✓';
        $this->flashType = 'success';
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.admin.settings');
    }
}
