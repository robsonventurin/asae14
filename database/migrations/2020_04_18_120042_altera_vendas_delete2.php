<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlteraVendasDelete2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendas_has_produtos', function(Blueprint $table){
            $table->dropForeign(['id_venda']);
            $table->dropForeign(['id_produto']);
            $table->foreign('id_venda')->references('id')->on('table_vendas')->onDelete('cascade');
            $table->foreign('id_produto')->references('id')->on('produtos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendas_has_produtos', function(Blueprint $table){
            $table->dropForeign(['id_venda']);
            $table->dropForeign(['id_produto']);
            $table->foreign('id_venda')->references('id')->on('table_vendas');
            $table->foreign('id_produto')->references('id')->on('produtos');

        });
    }
}
