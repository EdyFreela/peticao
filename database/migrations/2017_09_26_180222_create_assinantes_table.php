<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssinantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assinantes', function (Blueprint $table) {
           $table->increments('id'); 
           $table->string('peticao_id');
           $table->string('nome');
           $table->string('sobrenome');
           $table->string('email');
           $table->string('cidade');
           $table->string('estado');
           $table->string('ip');
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
        Schema::drop("assinantes");
    }
}
