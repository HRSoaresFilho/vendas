<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venda', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produto_id');
            $table->unsignedBigInteger('local_id');
            $table->decimal('preco', 8, 2);
            $table->unsignedBigInteger('titulo_permissao_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('produto_id')->references('id')->on('produto');
            $table->foreign('local_id')->references('id')->on('local');
            $table->foreign('titulo_permissao_id')->references('id')->on('titulopermissao');
            $table->foreign('user_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venda');
    }
}
