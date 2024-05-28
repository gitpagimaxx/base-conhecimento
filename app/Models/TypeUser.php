<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name',
        'Status',
    ];

    protected $guarded = ['id', 'created_at', 'update_at'];
    protected $table = 'type_user';

}
