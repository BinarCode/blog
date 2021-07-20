<?php

namespace App\Models\Concerns;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

/**
 * Trait WithCreator
 * @mixin Model
 * @package App\Models\Concerns
 */
trait WithCreator
{
    protected static function bootWithCreator()
    {
        self::creating(function (Model $model) {
            if (Auth::check()) {
                $model->setAttribute('user_id', $model->getAttribute('user_id') ?? Auth::id());
            }
        });
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeCreator($query, User $user)
    {
        $query->where('user_id', $user->id);
    }
}
