<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $connection = 'oracle2';
    
    use HasFactory;

    const TABLE = 'tab_pedido';
    const SEQUENCE = 'seq_pedido';
    const COD_PEDIDO = 'cod_pedido';
    const NUM_PROTOCOLO = 'num_protocolo';
    const COD_SOLICITANTE = 'cod_solicitante';

    protected $table = self::TABLE;
    public $primaryKey = self::COD_PEDIDO;
    public $sequence = self::SEQUENCE;
    public $timestamps = false;

    public $fillable = [
        self::COD_PEDIDO,
        self::NUM_PROTOCOLO,
        self::COD_SOLICITANTE,
    ];

    
}
