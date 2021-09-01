<?php

namespace App\Models;

use Binaryk\LaravelRestify\Contracts\Sanctumable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * Class User
 * @property string $first_name
 * @property string $last_name
 * @property string $avatar
 * @property string $password
 * @property string $email
 * @property int $id
 * @package App\Models
 */
class User extends Authenticatable implements Sanctumable, CanResetPassword, HasMedia
{
    use HasFactory;
    use Notifiable;
    use HasApiTokens;
    use InteractsWithMedia;

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

    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function deleteAvatar(): self
    {
        $this->avatar = null;
        $this->save();

        return $this;
    }
}
