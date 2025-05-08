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
        Schema::create('receiving_entities', function (Blueprint $table) {
            $table->id();
            $table->string('entity_name');
            $table->string('entity_address');
            $table->string('user_limit', 10);
            $table->string('productive_sector');
            $table->foreignId('id_principal')
                ->nullable()
                ->constrained('principal_data')
                ->nullOnDelete();
            $table->string('observations');
            $table->date('convenant_start_date');
            $table->date('convenant_end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receiving_entities');
    }
};
