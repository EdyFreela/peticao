<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeticaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peticaos', function (Blueprint $table) {
           $table->increments('id');

           $table->string('title');
           $table->string('slug');
           $table->longText('descricao');
           $table->longText('conteudo');
           $table->longText('peticao');
           $table->string('twitterhashtags');

           $table->string('ativo_es');
           $table->string('redirecionar_es');
           $table->string('redirecionar_url_es');
           $table->string('title_es');
           $table->string('slug_es');
           $table->longText('descricao_es');
           $table->longText('conteudo_es');
           $table->longText('peticao_es');
           $table->string('twitterhashtags_es');

           $table->string('ativo_it');
           $table->string('redirecionar_it');
           $table->string('redirecionar_url_it');
           $table->string('title_it');
           $table->string('slug_it');
           $table->longText('descricao_it');
           $table->longText('conteudo_it');
           $table->longText('peticao_it');
           $table->string('twitterhashtags_it');           

           $table->string('ativo_en');
           $table->string('redirecionar_en');
           $table->string('redirecionar_url_en');
           $table->string('title_en');
           $table->string('slug_en');
           $table->longText('descricao_en');
           $table->longText('conteudo_en');
           $table->longText('peticao_en');
           $table->string('twitterhashtags_en');

           $table->string('imagem');
           $table->string('objetivo');
           $table->string('assinaturas_fisica');
           $table->string('mostrar_progresso');
           $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("peticaos");
    }
}
