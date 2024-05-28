<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analytics extends Model
{
    use HasFactory;

    protected $fillable = [
        'IP',
        'Page',
        'UserTypeAccess'
    ];

    protected $dates = ['created_at'];

    protected $guarded = ['id', 'created_at', 'update_at'];
    protected $table = 'analytics';
}
