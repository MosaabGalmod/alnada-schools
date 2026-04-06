<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\View\View;

class AnnouncementsController extends Controller
{
    public function index(): View
    {
        return view('admin.announcements', [
            'unreadCount' => Message::unread()->count(),
        ]);
    }
}
