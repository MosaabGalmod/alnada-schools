<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLoginForm(): View|RedirectResponse
    {
        if (session()->get('admin_authenticated')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $validUsername = config('admin.username', 'admin');
        $validPassword = config('admin.password', 'alnada2024');

        if ($request->username === $validUsername && $request->password === $validPassword) {
            $request->session()->regenerate();
            session(['admin_authenticated' => true]);

            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'مرحباً بك في لوحة التحكم');
        }

        return back()->with('error', 'اسم المستخدم أو كلمة المرور غير صحيحة');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget('admin_authenticated');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'تم تسجيل الخروج بنجاح');
    }
}
