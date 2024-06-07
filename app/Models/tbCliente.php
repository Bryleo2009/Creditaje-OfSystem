<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbCliente extends Model
{
    use HasFactory;
    protected $table = 'tb_cliente';
    protected $fillable = ['id','nombre', 'email', 'estado','codigo'];

}
