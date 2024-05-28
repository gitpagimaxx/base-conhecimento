<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesquisa extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Palavra',
        'Tela',
    ];

    protected $dates = ['created_at', 'update_at'];

    protected $guarded = ['id'];
    protected $table = 'pesquisa';
}
