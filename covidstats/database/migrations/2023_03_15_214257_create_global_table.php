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
        Schema::create('globalData', function (Blueprint $table) {
            $table->timestamp('Date') -> primary();
            $table->decimal('NewConfirmed');
            $table->decimal('NewDeaths');
            $table->decimal('NewRecovered');
            $table->decimal('TotalConfirmed');
            $table->decimal('TotalDeaths');
            $table->decimal('TotalRecovered');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('global');
    }
};
