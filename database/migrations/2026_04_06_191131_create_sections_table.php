<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sections', function (Blueprint $table): void {
            $table->id();
            $table->string('key')->unique();          // 'hero', 'about', 'custom_1'…
            $table->string('type');                   // hero|about|programs|stats|why_us|news|testimonials|contact|custom
            $table->string('label');                  // Arabic admin label
            $table->json('content')->nullable();      // section-specific text/data
            $table->json('style')->nullable();        // bg_type, colors, font_size
            $table->boolean('is_visible')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
