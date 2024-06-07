<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbTicketPrioridad extends Model
{
    use HasFactory;
    protected $table = 'tb_ticket_prioridad';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $fillable = ['id','descripcion', 'estado'];
    
}
