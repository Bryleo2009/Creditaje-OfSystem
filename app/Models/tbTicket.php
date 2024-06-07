<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbTicket extends Model
{
    use HasFactory;

    protected $table = 'tb_ticket';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'cliente_id',
        'asunto',
        'descripcion',
        'prioridad',
        'categoria',
        'estado'
    ];

    public function cliente()
    {
        return $this->belongsTo(TbCliente::class, 'cliente_id');
    }

    public function prioridad()
    {
        return $this->belongsTo(TbTicketPrioridad::class, 'prioridad');
    }

    public function getPrioridadObjAttribute()
    {
        return TbTicketPrioridad::find($this->prioridad);
    }

    public function categoria()
    {
        return $this->belongsTo(TbTicketCategoria::class, 'categoria');
    }

    public function estado()
    {
        return $this->belongsTo(TbTicketEstado::class, 'estado');
    }
}
