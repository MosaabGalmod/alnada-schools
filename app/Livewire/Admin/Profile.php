<?php

declare(strict_types=1);

namespace App\Livewire\Admin;

use Livewire\Component;

class Profile extends Component
{
    public string $current_password          = '';
    public string $new_password              = '';
    public string $new_password_confirmation = '';
    public string $admin_username            = '';

    public string $flashMsg  = '';
    public string $flashType = 'success';

    public function mount(): void
    {
        $this->admin_username = config('admin.username', 'admin');
    }

    public function changePassword(): void
    {
        $this->validate([
            'current_password'          => 'required',
            'new_password'              => 'required|min:8|confirmed',
        ], [
            'current_password.required' => 'أدخل كلمة المرور الحالية',
            'new_password.required'     => 'أدخل كلمة المرور الجديدة',
            'new_password.min'          => 'يجب أن تتكون من 8 أحرف على الأقل',
            'new_password.confirmed'    => 'كلمتا المرور غير متطابقتان',
        ]);

        if ($this->current_password !== config('admin.password')) {
            $this->addError('current_password', 'كلمة المرور الحالية غير صحيحة');
            return;
        }

        $this->updateEnvValue('ADMIN_PASSWORD', $this->new_password);
        \Illuminate\Support\Facades\Artisan::call('config:clear');

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);

        $this->flashMsg  = 'تم تغيير كلمة المرور بنجاح ✓';
        $this->flashType = 'success';
    }

    public function saveUsername(): void
    {
        $this->validate([
            'admin_username' => 'required|string|min:3|max:30|alpha_dash',
        ], [
            'admin_username.required'   => 'أدخل اسم المستخدم',
            'admin_username.min'        => 'اسم المستخدم 3 أحرف على الأقل',
            'admin_username.alpha_dash' => 'يُسمح بالحروف والأرقام والشرطة فقط',
        ]);

        $this->updateEnvValue('ADMIN_USERNAME', $this->admin_username);
        \Illuminate\Support\Facades\Artisan::call('config:clear');

        $this->flashMsg  = 'تم تحديث اسم المستخدم بنجاح ✓';
        $this->flashType = 'success';
    }

    private function updateEnvValue(string $key, string $value): void
    {
        $envPath = base_path('.env');
        $content = file_get_contents($envPath);

        $quotedValue = str_contains($value, ' ') ? '"' . $value . '"' : $value;

        if (preg_match('/^' . $key . '=.*/m', $content)) {
            $content = preg_replace('/^' . $key . '=.*/m', $key . '=' . $quotedValue, $content);
        } else {
            $content .= PHP_EOL . $key . '=' . $quotedValue . PHP_EOL;
        }

        file_put_contents($envPath, $content);
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.admin.profile');
    }
}
