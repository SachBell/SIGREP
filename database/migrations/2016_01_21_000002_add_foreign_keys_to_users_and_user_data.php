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
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('user_data_id')
                ->references('id')
                ->on('user_data')
                ->nullOnDelete();
        });

        Schema::table('user_data', function (Blueprint $table) {
            $table->foreign('id_user')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['user_data_id']);
        });

        Schema::table('user_data', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
        });
    }
};
