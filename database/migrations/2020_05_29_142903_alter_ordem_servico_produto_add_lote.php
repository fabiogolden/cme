<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOrdemServicoProdutoAddLote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ordem_servico_produto', function (Blueprint $table) {
            
            $table->string('lote') // Nome da coluna
                    ->nullable() ;// Preenchimento não obrigatório
                    
            $table->string('autoclave') // Nome da coluna
                    ->nullable(); // Preenchimento não obrigatório
                   // ->after('password'); // Ordenado após a coluna "password"
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ordem_servico_produto', function (Blueprint $table) {
            $table->dropColumn('lote');
            $table->dropColumn('autoclave');
        });
    }
}
