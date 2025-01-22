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
            $table->unsignedBigInteger('id_user')->nullable();
            $table->string('cei', 10)->unique();
            $table->string('name');
            $table->string('lastname');
            $table->string('phone_number', 10)->unique();
            $table->string('address');
            $table->string('neighborhood');
            $table->foreignId('id_semester')
                ->nullable()
                ->constrained('semesters')
                ->nullOnDelete();
            $table->foreignId('id_grade')
                ->nullable()
                ->constrained('grades')
                ->nullOnDelete();
            $table->string('daytrip');
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
