<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
	/*nome da tabela*/
    protected $table    =   "produtos";
    
    /*nome da chave primaria da tabela*/
    protected $primaryKey = 'id';

    /*nome dos atributos que poderão ser alterados*/
    protected $fillable = [
        'nome', 'precoCompra', 'dataEntrada'
    ];
}
