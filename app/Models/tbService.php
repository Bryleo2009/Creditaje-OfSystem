<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbService extends Model
{
    use HasFactory;
    protected $table = 'tb_services';
    protected $fillable = ['nombre_es', 'descripcion_es', 'nombre_en', 'descripcion_en', 'estado'];
}
