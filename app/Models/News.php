<?php

declare(strict_types=1);

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Overtrue\LaravelVersionable\Versionable;
use Overtrue\LaravelVersionable\VersionStrategy;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Tags\HasTags;

class News extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\NewsFactory> */
    use HasFactory;

    use HasTags;
    use InteractsWithMedia;
    use Sluggable;
    use SoftDeletes;
    use Versionable;

    protected $fillable = ['title', 'slug', 'summary', 'content', 'weight', 'status', 'created_at'];

    protected $versionable = ['title', 'slug', 'summary', 'content', 'weight', 'status'];

    protected $versionStrategy = VersionStrategy::SNAPSHOT;

    public function categories()
    {
        return $this->belongsToMany(NewsCategory::class, 'pivot_news_categories', 'news_id', 'category_id');
    }

    protected static function booted()
    {
        static::forceDeleted(function ($news) {
            $news->categories()->detach();
        });
    }

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
