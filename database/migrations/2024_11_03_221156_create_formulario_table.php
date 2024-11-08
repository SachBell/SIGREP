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
        Schema::create('formulario', function (Blueprint $table) {
            $table->id();
            $table->string('cei');
            $table->string('name');
            $table->string('phone_number');
            $table->string('email');
            $table->string('address');
            $table->string('neighborhood');
            $table->string('semester');
            $table->string('grade');
            $table->string('daylitrip');
            $table->foreignId('id_institucion')
                ->nullable()
                ->constrained('instituciones')
                ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formulario');
    }
};
