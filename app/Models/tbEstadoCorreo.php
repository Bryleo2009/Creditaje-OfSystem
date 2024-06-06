<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbEstadoCorreo extends Model
{
    use HasFactory;
    
    protected $table = 'tb_estado_correo';
    protected $keyType = 'string';
    protected $fillable = ['id', 'descripcion', 'estado'];
}
