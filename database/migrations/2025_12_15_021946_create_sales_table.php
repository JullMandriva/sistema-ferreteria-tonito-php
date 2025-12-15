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
Schema::create('ventas', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained('users'); // ID del Vendedor que realiza la venta
    $table->string('cliente_nombre')->nullable();
    $table->string('documento_tipo', 50)->default('Boleta'); // Boleta, Factura, Ticket
    $table->string('documento_numero', 50)->nullable();
    $table->decimal('total', 10, 2);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
