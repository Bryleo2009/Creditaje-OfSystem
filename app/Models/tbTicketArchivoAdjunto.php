<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbTicketArchivoAdjunto extends Model
{
    use HasFactory;

    protected $table = 'tb_ticket_archivo_adjunto';

    protected $fillable = [
        'ticket_id',
        'ruta',
        'estado',
        'fecha_registro',
        'nombre',
    ];

    public function ticket()
    {
        return $this->belongsTo(TbTicket::class, 'ticket_id');
    }
}
