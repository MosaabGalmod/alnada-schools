<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'key', 'type', 'label', 'content', 'style', 'is_visible', 'show_in_nav', 'sort_order',
    ];

    protected $casts = [
        'content'    => 'array',
        'style'      => 'array',
        'is_visible'  => 'boolean',
        'show_in_nav' => 'boolean',
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

    /**
     * Returns inline text color ONLY for dark-background sections.
     * Light sections return '' so CSS dark-mode rules can take over.
     */
    public function textColor(): string
    {
        if ($this->isDark()) {
            return $this->style['text_color'] ?? '#e2f0f7';
        }
        // Light section: only return user-set color (for light mode customisation).
        // Dark mode CSS will override via class selectors since no inline style conflicts.
        return $this->style['text_color'] ?? '';
    }

    /**
     * Returns inline heading color ONLY for dark-background sections.
     * Light sections return '' so CSS dark-mode rules can take over.
     */
    public function headingColor(): string
    {
        if ($this->isDark()) {
            return $this->style['heading_color'] ?? '#ffffff';
        }
        return $this->style['heading_color'] ?? '';
    }

    /**
     * Safe inline style string for heading color.
     * Returns empty string for light sections so dark-mode CSS takes over.
     */
    public function headingColorStyle(): string
    {
        $color = $this->headingColor();
        return $color ? "color: {$color}" : '';
    }

    /**
     * Safe inline style string for body text color.
     * Returns empty string for light sections so dark-mode CSS takes over.
     */
    public function textColorStyle(): string
    {
        $color = $this->textColor();
        return $color ? "color: {$color}" : '';
    }

    /**
     * CSS vars string for sections using CSS-variable approach.
     * Only injects vars that have a non-empty value.
     */
    public function cssVarsStyle(): string
    {
        $vars = [];
        if ($h = $this->headingColor()) {
            $vars[] = "--section-heading-color: {$h}";
        }
        if ($t = $this->textColor()) {
            $vars[] = "--section-text-color: {$t}";
        }
        $vars[] = '--section-accent-color: ' . $this->accentColor();
        return implode('; ', $vars);
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
