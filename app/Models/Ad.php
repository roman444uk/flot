<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $user_id
 * @property string $title
 * @property string $slug
 */
class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
    ];

    /**
     * @return HasMany
     */
    public function photos(): HasMany
    {
        return $this->hasMany(AdPhoto::class, 'ad_id');
    }

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
