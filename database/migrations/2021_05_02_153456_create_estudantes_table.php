<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudantes', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->date('data_nascimento');
            $table->integer('serie_ingresso');
            $table->unsignedBigInteger('endereco_id');
            $table->unsignedBigInteger('encarregado_id');
            $table->foreign('endereco_id')->references('id')->on('enderecos')->onDelete('cascade');
            $table->foreign('encarregado_id')->references('id')->on('encarregados')->onDelete('cascade');
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
        Schema::dropIfExists('estudantes');
    }
}
