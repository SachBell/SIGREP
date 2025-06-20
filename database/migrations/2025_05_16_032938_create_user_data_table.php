<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')
                ->nullable()
                ->constrained('user_profiles')
                ->nullOnDelete();
            $table->foreignId('career_id')
                ->nullable()
                ->constrained('careers')
                ->nullOnDelete();
            $table->foreignId('semester_id')
                ->nullable()
                ->constrained('semesters')
                ->nullOnDelete();
            $table->foreignId('grade_id')
                ->nullable()
                ->constrained('grades')
                ->nullOnDelete();
            $table->enum('daytrip', ['Vespertina', 'Nocturna']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_data');
    }
};
