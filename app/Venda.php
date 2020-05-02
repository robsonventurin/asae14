<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venda extends Model
{
    use SoftDeletes;
    
    //
    protected $table = "table_vendas";
    protected $primaryKey = "id";
    
    function cliente(){
    	return $this->belongsTo('App\Cliente', 'id_cliente', 'id');
    }

    function produtos(){
    	return $this->belongsToMany('App\Produtos', 'vendas_has_produtos', 'id_venda', 'id_produto')->withPivot(['id', 'quantidade', 'subtotal'])->withTimestamps();
    }
}
