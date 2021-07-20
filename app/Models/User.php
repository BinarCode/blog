<?php

namespace App\Models;

use Binaryk\LaravelRestify\Contracts\Sanctumable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * @property string $first_name
 * @property string $last_name
 * @property string $avatar
 * @property string $email
 * @package App\Models
 */
class User extends Authenticatable implements Sanctumable, CanResetPassword
{
    use HasFactory;
    use Notifiable;
    use HasApiTokens;

    protected $fillable = [
        'first_name',
        'last_name',
        'avatar',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
