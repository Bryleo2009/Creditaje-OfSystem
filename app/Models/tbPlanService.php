<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbPlanService extends Model
{
    use HasFactory;
    protected $table = 'tb_plan_services';
    protected $fillable = ['estado', 'id_categ', 'id_service', 'precio', 'descuento', 'renovacion', 'view_precio', 'view_descuento', 'view_renovacion', 'paginas', 'secciones', 'cant_productos', 'cant_correos'];

    public function categoria()
    {
        return $this->belongsTo(tbCategoria::class, 'id_categ');
    }

    public function servicio()
    {
        return $this->belongsTo(tbService::class, 'id_service');
    }
}
