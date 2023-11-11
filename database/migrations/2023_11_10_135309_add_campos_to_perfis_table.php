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
        Schema::table('perfis', function (Blueprint $table) {
            $table->string('email')->nullable();
            $table->string('telefone')->nullable();
            $table->string('instagram')->nullable();
            $table->string('curso')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perfis', function (Blueprint $table) {
            $table->dropColumn(['email', 'telefone', 'instagram', 'curso']);
        });
    }
};
