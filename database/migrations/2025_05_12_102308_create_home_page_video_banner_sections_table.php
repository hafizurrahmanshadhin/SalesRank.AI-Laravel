<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('home_page_video_banner_sections', function (Blueprint $table) {
            $table->id();

            $table->string('title')->nullable(false);
            $table->text('description')->nullable(false);
            $table->string('video')->nullable();
            $table->string('video_thumbnail')->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('home_page_video_banner_sections');
    }
};
