<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancasApontamentos extends Model
{
    use HasFactory;

    protected $fillable = [
        'Descricao',
        'Valor',
        'TipoRegistro',
        'DtHr',
        'UserId',
        'Status',
    ];

    protected $dates = ['created_at', 'update_at'];

    protected $guarded = ['id'];
    protected $table = 'financas_apontamentos';

}
