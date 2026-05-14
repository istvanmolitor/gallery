<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gallery_images', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('gallery_id')->constrained()->onDelete('cascade');
            $blueprint->string('image_url');
            $blueprint->string('title')->nullable();
            $blueprint->integer('order')->default(0);
            $blueprint->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery_images');
    }
};
