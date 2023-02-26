<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Resource extends Model
{
    use HasFactory;

    protected $table = 'resource';

    protected $fillable = [
        'name',
        'description',
        'type',
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

    #region RELATIONS
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'id_category' );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user' );
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'id_resource');
    }

    public function information(): HasOne
    {
        return $this->hasOne(Information::class, 'id_resource');
    }

    public function tutorial(): HasOne
    {
        return $this->hasOne(Tutorial::class, 'id_resource');
    }
    #endregion
}
