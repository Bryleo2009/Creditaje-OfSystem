<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbTicketEstado extends Model
{
    use HasFactory;
    protected $table = 'tb_ticket_estado';
    protected $fillable = ['id','descripcion', 'estado'];
    protected $primaryKey = 'id';
    protected $keyType = 'int';
}
