<?php

namespace App\Models;

use App\Models\Concerns\WithCreator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;
    use WithCreator;

    protected $table = 'comments';

    protected $fillable = [
        'user_id',
        'blog_id',
        'body',
    ];

    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class);
    }
}
