<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Reemplazamos 'return new class' por la clase nombrada 'CreateProductsTable'
class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Esto creará una tabla llamada 'productos'
        Schema::create('productos', function (Blueprint $table) {
            $table->id(); // ID autoincrementable (llave primaria)
            
            // Campos que definen su producto
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();
            $table->decimal('precio', 8, 2);
            $table->integer('cantidad');
            $table->string('codigo_sku', 50)->unique(); // Código único
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
}