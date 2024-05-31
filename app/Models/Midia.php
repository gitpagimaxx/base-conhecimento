<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Midia extends Model
{
    use HasFactory;

    protected $fillable = [
        'TipoMidiaId',
        'OrigemMidiaId',
        'Titulo',
        'Resenha',
        'AnexoId',
        'Avaliacao',
        'Data',
        'UserId',
        'Status',
    ];

    protected $dates = ['created_at', 'update_at'];

    protected $guarded = ['id'];
    protected $table = 'midia';
}