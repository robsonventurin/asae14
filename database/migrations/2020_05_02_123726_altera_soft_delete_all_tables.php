<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlteraSoftDeleteAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('vendas_has_produtos', function(Blueprint $table){
            $table->softDeletes();
        });
        Schema::table('users', function(Blueprint $table){
            $table->softDeletes();
        });
        Schema::table('tipo_produtos', function(Blueprint $table){
            $table->softDeletes();
        });
        Schema::table('table_vendas', function(Blueprint $table){
            $table->softDeletes();
        });
        Schema::table('table_usuarios', function(Blueprint $table){
            $table->softDeletes();
        });
        Schema::table('produtos', function(Blueprint $table){
            $table->softDeletes();
        });
        Schema::table('clientes', function(Blueprint $table){
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('vendas_has_produtos', function(Blueprint $table){
            $table->dropSoftDeletes();
        });
        Schema::table('users', function(Blueprint $table){
            $table->dropSoftDeletes();
        });
        Schema::table('tipo_produtos', function(Blueprint $table){
            $table->dropSoftDeletes();
        });
        Schema::table('table_vendas', function(Blueprint $table){
            $table->dropSoftDeletes();
        });
        Schema::table('table_usuarios', function(Blueprint $table){
            $table->dropSoftDeletes();
        });
        Schema::table('produtos', function(Blueprint $table){
            $table->dropSoftDeletes();
        });
        Schema::table('clientes', function(Blueprint $table){
            $table->dropSoftDeletes();
        });
    }
}
