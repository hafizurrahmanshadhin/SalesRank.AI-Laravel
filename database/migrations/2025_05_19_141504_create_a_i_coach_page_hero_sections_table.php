<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('a_i_coach_page_hero_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(false);
            $table->string('image')->nullable();
            $table->text('description')->nullable(false);
            $table->string('banner')->nullable();
            $table->string('sub_title')->nullable(false);
            $table->text('sub_description')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('a_i_coach_page_hero_sections');
    }
};
