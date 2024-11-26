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
            $table->string('cei', 10);
            $table->string('name');
            $table->string('lastname');
            $table->string('phone_number', 10);
            $table->string('email');
            $table->string('address');
            $table->string('neighborhood');
            $table->foreignId('id_semester')
                ->constrained('semesters');
            $table->foreignId('id_grade')
                ->constrained('grades');
            $table->string('daytrip');
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
