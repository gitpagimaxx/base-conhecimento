<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Tag',
        'UrlAmigavel',
        'UserId',
        'Status',
    ];

    protected $dates = ['created_at', 'updated_at'];

    protected $guarded = ['id'];
    protected $table = 'tag';
}
