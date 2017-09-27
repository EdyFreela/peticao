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
           $table->longText('conteudo');
           $table->longText('peticao');
           $table->longText('conteudomail');
           $table->longText('mailpeticao');
           $table->string('twitterhashtags');
           $table->string('imagem');
           $table->string('objetivo');
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