<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoProdutos extends Model
{
    use SoftDeletes;
    
    protected $table = "tipo_produtos";
    protected $primaryKey = "id";
}
