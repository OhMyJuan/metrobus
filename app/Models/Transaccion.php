<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaccion extends Model
{
    use HasFactory;

    protected $table = 'transacciones';
    protected $fillable = ['codigo_tarjeta', 'id_operador', 'tipo_transaccion', 'monto'];
}
