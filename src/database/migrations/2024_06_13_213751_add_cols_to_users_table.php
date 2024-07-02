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
            $table->string('avg_rate_current')->nullable()->comment('Ср бал, за текущий месяц');
            $table->string('month_name_current')->nullable()->comment('Название месяца');

            $table->string('avg_rate_last')->nullable()->comment('Ср бал, за прошлый месяц');
            $table->string('month_name_last')->nullable()->comment('Название месяца');

            $table->unsignedSmallInteger('percent')->nullable();

            $table->string('telegram')->nullable();

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
