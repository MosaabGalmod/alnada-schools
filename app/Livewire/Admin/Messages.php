<?php

declare(strict_types=1);

namespace App\Livewire\Admin;

use App\Models\Message;
use Livewire\Component;
use Livewire\WithPagination;

class Messages extends Component
{
    use WithPagination;

    public string $search       = '';
    public string $filterRead   = '';
    public ?int   $viewingId    = null;
    public bool   $showViewer  = false;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function view(int $id): void
    {
        $msg = Message::findOrFail($id);
        if (!$msg->is_read) {
            $msg->markAsRead();
        }
        $this->viewingId  = $id;
        $this->showViewer = true;
    }

    public function closeViewer(): void
    {
        $this->showViewer = false;
        $this->viewingId  = null;
    }

    public function markRead(int $id): void
    {
        Message::findOrFail($id)->markAsRead();
    }

    public function delete(int $id): void
    {
        Message::findOrFail($id)->delete();
        if ($this->viewingId === $id) {
            $this->closeViewer();
        }
    }

    public function render(): \Illuminate\View\View
    {
        $query = Message::latestFirst();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('subject', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->filterRead === 'unread') {
            $query->where('is_read', false);
        } elseif ($this->filterRead === 'read') {
            $query->where('is_read', true);
        }

        $messages   = $query->paginate(15);
        $viewing    = $this->viewingId ? Message::find($this->viewingId) : null;

        return view('livewire.admin.messages', compact('messages', 'viewing'));
    }
}
