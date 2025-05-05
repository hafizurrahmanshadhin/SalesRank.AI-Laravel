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

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->string('phone_number')->unique()->nullable();
            $table->string('linkedin_profile_url')->nullable();
            $table->integer('revenue_generated_year')->nullable();
            $table->decimal('revenue_generated', 15, 2)->nullable();
            $table->float('industry_experience')->nullable();
            $table->float('present_club_experience')->nullable();
            $table->decimal('lead_close_ratio', 10, 2)->nullable();

            $table->string('working_role')->nullable();
            $table->string('country')->nullable();
            $table->text('bio')->nullable();

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
        Schema::dropIfExists('profiles');
    }
};
