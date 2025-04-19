<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class News extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\NewsFactory> */
    use HasFactory;

    use InteractsWithMedia;
    use Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'content',
        'weight',
        'status',
        'created_at',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaCollection('featured_image')
            ->singleFile();
    }
}
