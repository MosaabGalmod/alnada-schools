<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value'];

    private const CACHE_KEY = 'site_settings';
    private const CACHE_TTL = 3600;

    // ===== Static helpers =====

    public static function get(string $key, mixed $default = null): mixed
    {
        $settings = Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            return static::all()->pluck('value', 'key')->toArray();
        });

        return $settings[$key] ?? $default;
    }

    public static function set(string $key, mixed $value): static
    {
        $setting = static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        Cache::forget(self::CACHE_KEY);

        return $setting;
    }

    public static function setMany(array $data): void
    {
        foreach ($data as $key => $value) {
            static::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        Cache::forget(self::CACHE_KEY);
    }

    public static function all_settings(): array
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            return static::all()->pluck('value', 'key')->toArray();
        });
    }

    public static function logoUrl(string $default = 'logo.png'): string
    {
        $path = static::get('logo_path', '');
        if ($path && \Illuminate\Support\Facades\Storage::disk('public')->exists($path)) {
            return \Illuminate\Support\Facades\Storage::disk('public')->url($path);
        }

        return asset($default);
    }

    public static function faviconUrl(): string
    {
        $path = static::get('favicon_path', '');
        if ($path && \Illuminate\Support\Facades\Storage::disk('public')->exists($path)) {
            return \Illuminate\Support\Facades\Storage::disk('public')->url($path);
        }

        return asset('logo-sm.png');
    }

    public static function siteName(): string
    {
        return static::get('site_name', 'مدارس الندى النموذجية الأهلية');
    }
}
