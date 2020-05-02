<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    protected $table = "produtos";
    protected $primaryKey = "id";

    function vendas(){
    	return $this->belongsToMany('App\Venda', 'vendas_has_produtos', 'id_produto', 'id_venda')->withPivot(['quantidade', 'subtotal'])->withTimestamps();
    }

    function tipo(){
    	return $this->belongsTo('App\TipoProdutos', 'id_tipo_produtos', 'id');
    }
}
