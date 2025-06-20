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
            $table->string('name');
            $table->string('address');
            $table->string('user_limit', 10);
            $table->enum('productive_sector', ['Publico', 'Privado']);
            $table->foreignId('principal_data_id')
                ->constrained('principal_data');
            $table->string('observations')
                ->nullable();
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
