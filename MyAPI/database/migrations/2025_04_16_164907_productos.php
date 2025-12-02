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
        Schema::create('api_beeweb', function (Blueprint $table) {
            $table->id();
            $table->string('nombreProducto');
            $table->float('costoProducto', precision: 53);
            $table->integer('cantidadProducto');
            $table->longText('descripcionProducto');
            //$table->foreignId('categoria_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_beeweb');
    }
};
