<?php

namespace App\Models;

use App\Models\Concerns\WithCreator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

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
    use HasSlug;


    protected $table = 'blogs';

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'image',
        'tags',
        'slug',
        'views',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'blog_id', 'id');
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function addViews(): self
    {
        $this->views++;
        $this->timestamps = false;
        $this->save();

        return $this;
    }
}
