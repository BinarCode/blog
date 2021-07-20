<?php

namespace App\Models;

use App\Models\Concerns\WithCreator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Blog
 * @property int $user_id
 * @property string $slug
 * @property string $title
 * @property string $content
 * @property string $image
 * @property  array $tags
 *
 * @package App\Models
 */
class Blog extends Model
{
    use HasFactory;
    use WithCreator;

    protected $table = 'blogs';

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'image',
        'tags',
        'slug',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'id', 'blog_id');
    }
}
