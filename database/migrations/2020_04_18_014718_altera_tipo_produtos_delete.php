<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlteraTipoProdutosDelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produtos', function(Blueprint $table){
            $table->dropForeign(['id_tipo_produtos']);
            $table->foreign('id_tipo_produtos')->references('id')->on('tipo_produtos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produtos', function(Blueprint $table){
            $table->dropForeign(['id_tipo_produtos']);
            $table->foreign('id_tipo_produtos')->references('id')->on('tipo_produtos');
        });
    }
}
