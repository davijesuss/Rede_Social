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
        Schema::create('perfis', function (Blueprint $table) {
            $table->id();
            $table->text('biografia')->nullable();
            $table->string('semestre')->nullable();
            $table->string('imagem_perfil', 255)->nullable(); 
            $table->unsignedBigInteger('user_id')->nullable(); // Adicionando a coluna user_id
            $table->foreign('user_id')->references('id')->on('users'); // Criando a chave estrangeira
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perfis', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Removendo a chave estrangeira
            $table->dropColumn('user_id'); // Removendo a coluna user_id
        });
        Schema::dropIfExists('perfis');
    }
};
