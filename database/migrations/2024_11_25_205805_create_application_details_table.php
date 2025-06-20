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
        Schema::create('application_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_application_calls')
                ->nullable()
                ->constrained('application_calls')
                ->nullOnDelete();
            $table->foreignId('id_user_data')
                ->nullable()
                ->constrained('user_data')
                ->nullOnDelete();
            $table->foreignId('id_institutes')
                ->nullable()
                ->constrained('receiving_entities')
                ->nullOnDelete();
            $table->enum('status_individual', ['Pendiente', 'En Proceso', 'Finalizado', 'Retirado'])->default('Pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_details');
    }
};
