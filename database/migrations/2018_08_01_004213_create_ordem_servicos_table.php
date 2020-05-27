<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdemServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordem_servicos', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('fechada')->default(false);
            $table->integer('departamento_id')->unsigned();
            $table->decimal('valor_total', 10, 3);
            $table->integer('atendente_id')->unsigned();
            $table->text('obs')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('departamento_id')->references('id')->on('departamentos');
            $table->foreign('atendente_id')->references('id')->on('atendentes');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('ordem_servicos');
    }
}
