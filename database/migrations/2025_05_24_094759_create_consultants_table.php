<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('consultants', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('linkedin_url')->nullable();
            $table->string('full_name');
            $table->string('job_title')->nullable();
            $table->string('company')->nullable();
            $table->string('industry')->nullable();
            $table->integer('total_experience')->nullable();
            $table->integer('tenure')->nullable();
            $table->boolean('performance_keywords')->default(false);
            $table->text('achievements')->nullable();
            $table->string('revenue_closed')->nullable();
            $table->boolean('college_degree')->default(false);
            $table->string('location')->nullable();
            $table->float('ai_score')->nullable(); // AI Generated
            $table->string('ranking_level')->nullable(); // AI Ranking
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('consultants');
    }
};
