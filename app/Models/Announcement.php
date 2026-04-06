<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;

class Announcement extends Model
{
    protected $fillable = [
        'title',
        'body',
        'category',
        'badge_color',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    // ===== Scopes =====

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeLatestFirst(Builder $query): Builder
    {
        return $query->orderByDesc('created_at');
    }

    // ===== Accessors =====

    public function getBadgeLabelAttribute(): string
    {
        return match ($this->badge_color) {
            'green'  => 'badge-green',
            'gold'   => 'badge-gold',
            'blue'   => 'badge-blue',
            'red'    => 'badge-red',
            'purple' => 'badge-purple',
            default  => 'badge-green',
        };
    }
}
