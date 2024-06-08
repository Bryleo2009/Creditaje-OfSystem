<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbUserCliente extends Model
{
    use HasFactory;
    protected $table = 'tb_user_cliente';
    protected $fillable = ['id_user', 'id_cliente'];
}
