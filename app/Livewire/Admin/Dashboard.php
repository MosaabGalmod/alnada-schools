<?php

declare(strict_types=1);

namespace App\Livewire\Admin;

use App\Models\Announcement;
use App\Models\Message;
use App\Models\Section;
use Livewire\Component;

class Dashboard extends Component
{
    public int $totalAnnouncements;
    public int $publishedAnnouncements;
    public int $unreadMessages;
    public int $totalMessages;
    public int $visibleSections;

    public function mount(): void
    {
        $this->totalAnnouncements    = Announcement::count();
        $this->publishedAnnouncements = Announcement::published()->count();
        $this->unreadMessages        = Message::unread()->count();
        $this->totalMessages         = Message::count();
        $this->visibleSections       = Section::where('is_visible', true)->count();
    }

    public function render(): \Illuminate\View\View
    {
        $recent = Message::latestFirst()->take(5)->get();
        $latestAnnouncements = Announcement::latestFirst()->take(3)->get();

        return view('livewire.admin.dashboard', compact('recent', 'latestAnnouncements'));
    }
}
