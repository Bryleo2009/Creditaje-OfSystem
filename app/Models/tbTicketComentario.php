<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbTicketComentario extends Model
{
    use HasFactory;

    protected $table = 'tb_ticket_comentario';

    protected $fillable = [
        'ticket_id',
        'comentario',
        'cliente_id',
        'estado',
        'fecha_registro'
    ];

    public function ticket()
    {
        return $this->belongsTo(TbTicket::class, 'ticket_id');
    }

    public function cliente()
    {
        return $this->belongsTo(TbCliente::class, 'cliente_id');
    }
}
