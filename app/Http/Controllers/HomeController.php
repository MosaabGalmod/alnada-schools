<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\AnnouncementService;
use App\Services\SectionService;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        private readonly AnnouncementService $announcementService,
        private readonly SectionService $sectionService,
    ) {}

    public function index(): View
    {
        return view('home', [
            'sections'      => $this->sectionService->getVisible(),
            'announcements' => $this->announcementService->getPublished(6),
        ]);
    }
}
