<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    protected $fillable = [
        'name',
        'description',
        'image',
        'icon',
        'archived',
        'archived_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    #region RELATIONS
    public function ressources(): HasMany
    {
        return $this->hasMany(Resource::class, 'id_category');
    }
    #endregion
}
