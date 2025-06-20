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
            $table->foreignId('application_calls_id')
                ->nullable()
                ->constrained('application_calls')
                ->nullOnDelete();
            $table->foreignId('user_data_id')
                ->nullable()
                ->constrained('user_data')
                ->nullOnDelete();
            $table->foreignId('receiving_entity_id')
                ->nullable()
                ->constrained('receiving_entities')
                ->nullOnDelete();
            $table->enum('status_individual', ['En Progreso', 'Finalizado'])->default('En Progreso');
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
