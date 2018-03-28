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
           $table->string('twitterhashtags');

           $table->string('ativo_es');
           $table->string('redirecionar_es');
           $table->string('redirecionar_url_es');
           $table->string('title_es');
           $table->string('slug_es');
           $table->string('twitterhashtags_es');

           $table->string('ativo_it');
           $table->string('redirecionar_it');
           $table->string('redirecionar_url_it');
           $table->string('title_it');
           $table->string('slug_it');
           $table->string('twitterhashtags_it');           

           $table->string('ativo_en');
           $table->string('redirecionar_en');
           $table->string('redirecionar_url_en');
           $table->string('title_en');
           $table->string('slug_en');
           $table->string('twitterhashtags_en');

           $table->string('ativo_fr');
           $table->string('redirecionar_fr');
           $table->string('redirecionar_url_fr');
           $table->string('title_fr');
           $table->string('slug_fr');
           $table->string('twitterhashtags_fr');

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
