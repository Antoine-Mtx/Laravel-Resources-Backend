<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $table = 'resource';

    protected $fillable = [
        'name',
        'description',
        'image',
        'id_category',
        'id_user',
        'visibility',
        'archived',
        'published_at',
        'archived_at',
        'validated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
