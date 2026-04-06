<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Message;
use Illuminate\Pagination\LengthAwarePaginator;

final class MessageService
{
    public function store(array $data): Message
    {
        return Message::create($data);
    }

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return Message::latestFirst()->paginate($perPage);
    }

    public function markRead(Message $message): bool
    {
        return $message->markAsRead();
    }

    public function markAllRead(): int
    {
        return Message::unread()->update(['is_read' => true]);
    }

    public function delete(Message $message): bool
    {
        return $message->delete();
    }

    public function unreadCount(): int
    {
        return Message::unread()->count();
    }
}
