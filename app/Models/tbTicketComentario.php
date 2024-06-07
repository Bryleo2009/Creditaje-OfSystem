<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbTicketComentario extends Model
{
    use HasFactory;

    protected $table = 'tb_ticket_comentario';
    protected $primaryKey = 'id';
    protected $keyType = 'int';

    protected $fillable = [
        'id',
        'ticket_id',
        'comentario',
        'cliente_id',
        'estado',
        'created_at'
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
