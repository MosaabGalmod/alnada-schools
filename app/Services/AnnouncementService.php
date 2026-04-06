<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Announcement;
use Illuminate\Pagination\LengthAwarePaginator;

final class AnnouncementService
{
    public function getPublished(int $limit = 6): \Illuminate\Database\Eloquent\Collection
    {
        return Announcement::published()->latestFirst()->take($limit)->get();
    }

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Announcement::latestFirst()->paginate($perPage);
    }

    public function create(array $data): Announcement
    {
        if ($data['is_published'] ?? false) {
            $data['published_at'] = now();
        }

        return Announcement::create($data);
    }

    public function update(Announcement $announcement, array $data): bool
    {
        if (($data['is_published'] ?? false) && ! $announcement->is_published) {
            $data['published_at'] = now();
        }

        return $announcement->update($data);
    }

    public function delete(Announcement $announcement): bool
    {
        return $announcement->delete();
    }

    public function togglePublish(Announcement $announcement): bool
    {
        return $announcement->update([
            'is_published' => ! $announcement->is_published,
            'published_at' => ! $announcement->is_published ? now() : null,
        ]);
    }
}
