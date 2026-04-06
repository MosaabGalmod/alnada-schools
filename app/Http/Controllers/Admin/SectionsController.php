<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\View\View;

class SectionsController extends Controller
{
    public function index(): View
    {
        return view('admin.sections', [
            'unreadCount' => Message::unread()->count(),
        ]);
    }
}
