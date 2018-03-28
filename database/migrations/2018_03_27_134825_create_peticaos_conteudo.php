<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PeticaosConteudo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peticaos_conteudos', function (Blueprint $table) {
           $table->increments('id');

           $table->integer('peticao_id');
           $table->string('idioma');
           $table->longText('descricao');
           $table->longText('conteudo');
           $table->longText('peticao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("peticaos_conteudos");
    }
}
