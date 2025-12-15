<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// **CAMBIAMOS AQUÍ**: Usamos el nombre de la clase explícito
class AddRoleToUsersTable extends Migration 
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Añade una nueva columna 'role'
            $table->string('role')->default('vendedor')->after('email_verified_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Elimina la columna 'role' si se hace rollback
            $table->dropColumn('role');
        });
    }
}