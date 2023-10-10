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
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Chave Estrangeira para o autor
            $table->string('tipo_entidade_curtida'); // Tipo da Entidade Curtida (post ou comment)
            $table->unsignedBigInteger('entidade_curtida_id'); // ID da Entidade Curtida (ID do Post ou ID do Comentário)
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};

//tipo_entidade_curtida:
//O campo likeable_type é uma forma de implementar polimorfismo em um banco de dados relacional. 
//No contexto da tabela de Curtidas (Likes), ele serve para indicar o tipo da entidade que está sendo curtida. Neste caso, pode ser 
//"post" ou "comment". Isso significa que uma curtida pode ser associada a um post ou a um comentário.
//Usando likeable_type, você pode diferenciar entre diferentes tipos de entidades que podem ser curtidas sem ter que criar tabelas 
//separadas para cada tipo.

//entidade_curtida_id:
//O campo likeable_id é o identificador único da entidade que está sendo curtida. Dependendo do valor em likeable_type, 
//ele pode referenciar um post ou um comentário.
//Por exemplo, se likeable_type for "post", então likeable_id se refere ao id do post que está sendo curtido. Se likeable_type for
// "comment", então likeable_id se refere ao id do comentário que está sendo curtido.
//Essa abordagem permite que uma única tabela (no caso, a tabela likes) seja usada para rastrear curtidas em 
//diferentes tipos de entidades (posts e comentários, por exemplo). Dessa forma, você pode manter um registro de todas as atividades de 
//curtidas em um único lugar.





