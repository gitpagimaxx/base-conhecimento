<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancasBase extends Model
{
    use HasFactory;

    protected $fillable = [
        'Detalhamento',
        'TetoGasto',
        'GastoRealizado',
        'MesVigencia',
        'UserId',
        'Status',
    ];

    protected $dates = ['created_at', 'update_at'];

    protected $guarded = ['id'];
    protected $table = 'financas_base';
}
