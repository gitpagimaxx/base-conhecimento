<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseConhecimento extends Model
{
    protected $fillable = [
        'Titulo',
        'Resumo',
        'Detalhamento',
        'UserId',
        'Status',
    ];

    protected $dates = ['created_at', 'update_at'];

    protected $guarded = ['id'];
    protected $table = 'base_conhecimento';

    public function baseTags()
    {
        return $this->hasMany(BaseTag::class, 'BaseId', 'id');
    }

}
