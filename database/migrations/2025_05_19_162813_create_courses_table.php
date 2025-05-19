<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            $table->string('title')->nullable(false);
            $table->text('description')->nullable(false);
            $table->string('conduct_by')->nullable(false);
            $table->integer('course_duration')->nullable(false);
            $table->enum('course_level', ['beginner', 'intermediate', 'advanced'])->nullable(false);
            $table->string('image')->nullable();

            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('courses');
    }
};
