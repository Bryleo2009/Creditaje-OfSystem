<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbCategoria extends Model
{
    use HasFactory;
    protected $table = 'tb_categoria';
    protected $fillable = ['nombre_es', 'descripcion_es', 'nombre_en', 'descripcion_en', 'icono', 'estado'];
}
