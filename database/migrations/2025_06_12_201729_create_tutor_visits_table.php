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
        Schema::create('tutor_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tutor_student_id')
            ->nullable()
            ->constrained('tutor_students')
            ->nullOnDelete();
            $table->date('date');
            $table->text('observation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutor_visits');
    }
};
