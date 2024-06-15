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
            $table->foreignId('role_id');
            $table->string('phone')->nullable();
            $table->enum('lang', ['en','cn','es'])->nullable();
            $table->json('target')->nullable();
            $table->json('avg_rate')->nullable()->comment('Ср бал, Май, апрель..');
            $table->unsignedSmallInteger('percent')->nullable();
            $table->string('main_course')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
