<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendasHasProdutos extends Model
{
    use SoftDeletes;
    
    protected $table = "vendas_has_produtos";
    protected $primaryKey = "id";
}
