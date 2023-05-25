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
        Schema::create('exemplos', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->require();
            $table->integer('quantidade')->nullable();
            $table->date('dt_exemplo')->nullable();
            $table->float('valor_real')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exemplos');
    }
};
