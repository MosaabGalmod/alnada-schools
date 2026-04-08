<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'key', 'type', 'label', 'content', 'style', 'is_visible', 'sort_order',
    ];

    protected $casts = [
        'content'    => 'array',
        'style'      => 'array',
        'is_visible' => 'boolean',
        'sort_order' => 'integer',
    ];

    /* ── Scopes ─────────────────────────────────────────── */

    public function scopeVisible(Builder $q): Builder
    {
        return $q->where('is_visible', true);
    }

    public function scopeOrdered(Builder $q): Builder
    {
        return $q->orderBy('sort_order');
    }

    /* ── Style helpers ───────────────────────────────────── */

    public function bgCss(): string
    {
        $s = $this->style ?? [];
        return match ($s['bg_type'] ?? 'white') {
            'gradient' => sprintf(
                'background: linear-gradient(150deg, %s 0%%, %s 100%%);',
                $s['bg_from'] ?? '#061f2c',
                $s['bg_to']   ?? '#1a9dc6',
            ),
            'solid' => 'background-color: ' . ($s['bg_color'] ?? '#ffffff') . ';',
            'wave'  => sprintf(
                'background: linear-gradient(135deg, %s 0%%, %s 100%%);',
                $s['bg_from'] ?? '#f0f9fd',
                $s['bg_to']   ?? '#daf1fa',
            ),
            'dark'  => 'background: linear-gradient(150deg,#061f2c 0%,#0d4858 100%);',
            default => '',
        };
    }

    public function isDark(): bool
    {
        $type = $this->style['bg_type'] ?? 'white';
        if (in_array($type, ['gradient', 'dark'], true)) {
            return true;
        }
        if ($type === 'solid' && ($this->style['is_dark'] ?? false)) {
            return true;
        }
        if ($type === 'wave') {
            // detect if bg_from is dark (luminance check via hex)
            $from = ltrim($this->style['bg_from'] ?? '#f0f9fd', '#');
            if (strlen($from) === 6) {
                $r = hexdec(substr($from, 0, 2));
                $g = hexdec(substr($from, 2, 2));
                $b = hexdec(substr($from, 4, 2));
                $lum = 0.299 * $r + 0.587 * $g + 0.114 * $b;
                return $lum < 80;
            }
        }
        return false;
    }

    public function textColor(): string
    {
        return $this->style['text_color'] ?? ($this->isDark() ? '#e2f0f7' : '#374151');
    }

    public function headingColor(): string
    {
        return $this->style['heading_color'] ?? ($this->isDark() ? '#ffffff' : '#111827');
    }

    public function accentColor(): string
    {
        return $this->style['accent_color'] ?? '#1a9dc6';
    }

    public function fontSizeClass(): string
    {
        return match ($this->style['font_size'] ?? 'normal') {
            'large' => 'text-lg',
            'small' => 'text-sm',
            default => 'text-base',
        };
    }
}
