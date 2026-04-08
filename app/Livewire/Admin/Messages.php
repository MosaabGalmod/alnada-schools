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
    public bool   $showViewer   = false;
    public array  $selectedIds  = [];
    public bool   $selectAll    = false;

    public function updatedSearch(): void
    {
        $this->resetPage();
        $this->selectedIds = [];
        $this->selectAll   = false;
    }

    public function updatedFilterRead(): void
    {
        $this->selectedIds = [];
        $this->selectAll   = false;
    }

    public function updatedSelectAll(bool $value): void
    {
        if ($value) {
            $this->selectedIds = $this->currentPageIds();
        } else {
            $this->selectedIds = [];
        }
    }

    public function view(int $id): void
    {
        $msg = Message::findOrFail($id);
        if (! $msg->is_read) {
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
        $this->selectedIds = array_filter($this->selectedIds, fn($sid) => $sid !== $id);

        if ($this->viewingId === $id) {
            $this->closeViewer();
        }
    }

    public function deleteSelected(): void
    {
        if (empty($this->selectedIds)) {
            return;
        }

        Message::whereIn('id', $this->selectedIds)->delete();

        if ($this->viewingId && in_array($this->viewingId, $this->selectedIds)) {
            $this->closeViewer();
        }

        $this->selectedIds = [];
        $this->selectAll   = false;
    }

    public function markSelectedRead(): void
    {
        if (empty($this->selectedIds)) {
            return;
        }

        Message::whereIn('id', $this->selectedIds)->update(['is_read' => true]);
        $this->selectedIds = [];
        $this->selectAll   = false;
    }

    public function markAllRead(): void
    {
        Message::where('is_read', false)->update(['is_read' => true]);
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

        $messages = $query->paginate(15);
        $viewing  = $this->viewingId ? Message::find($this->viewingId) : null;

        return view('livewire.admin.messages', compact('messages', 'viewing'));
    }

    private function currentPageIds(): array
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

        return $query->paginate(15)->pluck('id')->map(fn($id) => (int)$id)->toArray();
    }
}
