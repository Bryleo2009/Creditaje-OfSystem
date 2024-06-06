<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbFrmContacto extends Model
{
    use HasFactory;

    protected $table = 'tb_frm_contacto';

    protected $fillable = [
        'id',
        'nombre',
        'email',
        'servicio',
        'estado',
        'estado_correo',
        'fecha_lectura'
    ];

    public function estado_corre()
    {
        return $this->belongsTo(TbEstadoCorreo::class, 'estado_correo');
    }
}
