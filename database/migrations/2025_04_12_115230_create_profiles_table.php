<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            $table->string('phone_number')->unique()->nullable(false);
            $table->string('linkedin_profile_url')->nullable();
            $table->integer('revenue_generated_year')->nullable();
            $table->decimal('revenue_generated', 10, 8)->nullable();
            $table->float('industry_experience')->nullable();
            $table->float('present_club_experience')->nullable();
            $table->decimal('lead_close_ratio', 10, 8)->nullable();

            $table->string('role')->nullable();
            $table->string('country')->nullable();
            $table->text('bio')->nullable();

            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('profiles');
    }
};
