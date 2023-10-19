<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artigos', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['ativo', 'inativo'])->default('ativo');
            $table->string('titulo');
            $table->longText('resumo');
            $table->longText('conteudo');
            $table->string('url');
            $table->integer('id_categoria');
            $table->integer('id_autor');
            $table->datetime('data_postagem');
            $table->string('foto');

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
        Schema::dropIfExists('artigos');
    }
};
