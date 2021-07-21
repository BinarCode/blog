<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends \Spatie\MediaLibrary\MediaCollections\Models\Media
{
    use HasFactory;

    protected $appends = [
        'path',
        'human_readable_size',
    ];

    public function getPathAttribute(): string
    {
        try {
            return $this->getTemporaryUrl(now()->addDay()); //s3
        } catch (\Exception $exception) {
            return $this->getUrl();// public
        }
    }
}
