<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\View\View;

class PolicyController extends Controller
{
    public function privacy(): View
    {
        return view('pages.privacy', [
            'content' => SiteSetting::get('privacy_policy', 'سيتم نشر سياسة الخصوصية قريبًا.'),
        ]);
    }

    public function terms(): View
    {
        return view('pages.terms', [
            'content' => SiteSetting::get('terms_of_use', 'سيتم نشر شروط الاستخدام قريبًا.'),
        ]);
    }
}
