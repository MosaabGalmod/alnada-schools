<?php

declare(strict_types=1);

namespace App\Livewire\Admin;

use App\Models\Announcement;
use Livewire\Component;
use Livewire\WithPagination;

class Announcements extends Component
{
    use WithPagination;

    // ── List/Filter ──────────────────────────────────────────
    public string $search      = '';
    public string $filterStatus = '';
    public string $filterCategory = '';

    // ── Modal state ──────────────────────────────────────────
    public bool $showModal = false;
    public bool $isEditing = false;
    public ?int $editingId  = null;

    // ── Form fields ──────────────────────────────────────────
    public string $title        = '';
    public string $body         = '';
    public string $category     = 'عام';
    public string $badge_color  = 'green';
    public bool   $is_published = false;

    protected function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'max:200'],
            'body'        => ['required', 'string'],
            'category'    => ['required', 'string', 'max:50'],
            'badge_color' => ['required', 'in:green,gold,blue,red,purple'],
            'is_published'=> ['boolean'],
        ];
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedFilterStatus(): void
    {
        $this->resetPage();
    }

    public function openCreate(): void
    {
        $this->resetForm();
        $this->isEditing = false;
        $this->showModal = true;
    }

    public function openEdit(int $id): void
    {
        $ann = Announcement::findOrFail($id);
        $this->editingId    = $id;
        $this->title        = $ann->title;
        $this->body         = $ann->body;
        $this->category     = $ann->category;
        $this->badge_color  = $ann->badge_color;
        $this->is_published = $ann->is_published;
        $this->isEditing    = true;
        $this->showModal    = true;
    }

    public function save(): void
    {
        $this->validate();

        $data = [
            'title'        => $this->title,
            'body'         => $this->body,
            'category'     => $this->category,
            'badge_color'  => $this->badge_color,
            'is_published' => $this->is_published,
            'published_at' => $this->is_published ? now() : null,
        ];

        if ($this->isEditing && $this->editingId) {
            Announcement::findOrFail($this->editingId)->update($data);
        } else {
            Announcement::create($data);
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function togglePublish(int $id): void
    {
        $ann = Announcement::findOrFail($id);
        $ann->update([
            'is_published' => !$ann->is_published,
            'published_at' => !$ann->is_published ? now() : $ann->published_at,
        ]);
    }

    public function delete(int $id): void
    {
        Announcement::findOrFail($id)->delete();
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->resetForm();
    }

    private function resetForm(): void
    {
        $this->editingId    = null;
        $this->title        = '';
        $this->body         = '';
        $this->category     = 'عام';
        $this->badge_color  = 'green';
        $this->is_published = false;
        $this->resetValidation();
    }

    public function render(): \Illuminate\View\View
    {
        $query = Announcement::latestFirst();

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        if ($this->filterStatus === 'published') {
            $query->where('is_published', true);
        } elseif ($this->filterStatus === 'draft') {
            $query->where('is_published', false);
        }

        if ($this->filterCategory) {
            $query->where('category', $this->filterCategory);
        }

        $announcements = $query->paginate(10);
        $categories    = Announcement::select('category')->distinct()->pluck('category');

        return view('livewire.admin.announcements', compact('announcements', 'categories'));
    }
}
