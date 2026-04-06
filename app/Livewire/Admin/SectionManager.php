<?php

declare(strict_types=1);

namespace App\Livewire\Admin;

use App\Models\Section;
use App\Services\SectionService;
use Livewire\Attributes\On;
use Livewire\Component;

class SectionManager extends Component
{
    /* ── List state ─────────────────────────────────────── */
    public $sections = [];

    /* ── Edit modal state ───────────────────────────────── */
    public bool   $showEditModal  = false;
    public bool   $showStyleModal = false;
    public bool   $showAddModal   = false;

    public ?int   $editingId = null;
    public string $editLabel  = '';
    public array  $editContent = [];
    public array  $editStyle   = [];

    /* ── Add custom section ─────────────────────────────── */
    public string $newLabel = '';

    /* ── Flash message ──────────────────────────────────── */
    public string $flashMsg  = '';
    public string $flashType = 'success'; // success | error

    /* ── Content field definitions per type ─────────────── */
    private array $contentFields = [
        'hero'         => ['badge','title','title_accent','subtitle','cta_primary','cta_secondary'],
        'about'        => ['tag','title','body1','body2','founding_year','vision_title','vision_body','mission_title','mission_body','values_title','values_body','accessibility_note'],
        'programs'     => ['tag','title','subtitle'],
        'stats'        => ['tag','title'],
        'why_us'       => ['tag','title'],
        'news'         => ['tag','title'],
        'testimonials' => ['tag','title'],
        'contact'      => ['tag','title','subtitle'],
        'custom'       => ['tag','title','subtitle','body'],
    ];

    public function mount(): void
    {
        $this->loadSections();
    }

    private function loadSections(): void
    {
        $this->sections = Section::orderBy('sort_order')->get()->toArray();
    }

    /* ── Visibility toggle ──────────────────────────────── */
    public function toggleVisibility(int $id): void
    {
        app(SectionService::class)->toggleVisibility($id);
        $this->loadSections();
        $this->flash('تم تحديث حالة الظهور');
    }

    /* ── Reorder ────────────────────────────────────────── */
    public function moveUp(int $id): void
    {
        app(SectionService::class)->moveUp($id);
        $this->loadSections();
    }

    public function moveDown(int $id): void
    {
        app(SectionService::class)->moveDown($id);
        $this->loadSections();
    }

    /* ── Edit content modal ─────────────────────────────── */
    public function openEditModal(int $id): void
    {
        $section = Section::findOrFail($id);
        $this->editingId  = $id;
        $this->editLabel  = $section->label;
        $this->editContent = $section->content ?? [];
        $this->showEditModal = true;
    }

    public function saveContent(): void
    {
        $this->validate([
            'editLabel' => 'required|string|max:100',
        ]);

        $section = Section::findOrFail($this->editingId);
        $section->update([
            'label'   => $this->editLabel,
            'content' => $this->editContent,
        ]);

        $this->showEditModal = false;
        $this->loadSections();
        $this->flash('تم حفظ المحتوى بنجاح');
    }

    /* ── Style modal ────────────────────────────────────── */
    public function openStyleModal(int $id): void
    {
        $section = Section::findOrFail($id);
        $this->editingId  = $id;
        $this->editLabel  = $section->label;
        $this->editStyle  = array_merge([
            'bg_type'       => 'white',
            'bg_from'       => '#061f2c',
            'bg_to'         => '#1a9dc6',
            'bg_color'      => '#ffffff',
            'heading_color' => '#111827',
            'text_color'    => '#374151',
            'accent_color'  => '#1a9dc6',
            'font_size'     => 'normal',
        ], $section->style ?? []);
        $this->showStyleModal = true;
    }

    public function saveStyle(): void
    {
        app(SectionService::class)->updateStyle($this->editingId, $this->editStyle);
        $this->showStyleModal = false;
        $this->loadSections();
        $this->flash('تم حفظ الأنماط بنجاح');
    }

    /* ── Add custom section ─────────────────────────────── */
    public function openAddModal(): void
    {
        $this->newLabel   = '';
        $this->showAddModal = true;
    }

    public function createSection(): void
    {
        $this->validate(['newLabel' => 'required|string|max:100']);
        app(SectionService::class)->createCustom($this->newLabel);
        $this->showAddModal = false;
        $this->loadSections();
        $this->flash('تم إضافة القسم الجديد');
    }

    /* ── Delete custom section ──────────────────────────── */
    public function deleteSection(int $id): void
    {
        try {
            app(SectionService::class)->delete($id);
            $this->loadSections();
            $this->flash('تم حذف القسم');
        } catch (\RuntimeException $e) {
            $this->flash($e->getMessage(), 'error');
        }
    }

    /* ── Helpers ────────────────────────────────────────── */
    public function getFieldsForType(string $type): array
    {
        return $this->contentFields[$type] ?? $this->contentFields['custom'];
    }

    private function flash(string $msg, string $type = 'success'): void
    {
        $this->flashMsg  = $msg;
        $this->flashType = $type;
        $this->dispatch('flash-shown');
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.admin.section-manager');
    }
}
