<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseTag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'BaseId',
        'TagId',
        'Status',
    ];

    protected $guarded = ['id', 'created_at', 'update_at'];
    protected $table = 'base_tag';

    public function baseTags()
    {
        return $this->hasMany(Tag::class, 'id', 'TagId');
    }
}
