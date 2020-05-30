<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOrdemServicoProdutoAddDefaultValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ordem_servico_produto', function (Blueprint $table) {
            $table->decimal('valor_cobrado', 10, 3)->default(0)->change();
            $table->decimal('valor_produto', 10, 3)->default(0)->change();
          
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
            $table->decimal('valor_cobrado', 10, 3)->change();
            $table->decimal('valor_produto', 10, 3)->change();
        });
    }
}
