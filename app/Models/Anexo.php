<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anexo extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'BaseId', 
        'NomeAnexo', 
        'Anexo', 
        'TipoAnexo', 
        'Descricao', 
        'UserId', 
        'Status' ];
    
    protected $guarded = ['id', 'created_at', 'update_at'];
    protected $table = 'anexo';
    
}
