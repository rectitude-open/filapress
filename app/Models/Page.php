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

class Page extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\PageFactory> */
    use HasFactory;

    use InteractsWithMedia;
    use Sluggable;
    use SoftDeletes;
    use Versionable;

    protected $fillable = ['title', 'slug', 'content', 'status', 'created_at', 'updated_at'];

    protected $versionable = ['title', 'slug', 'content', 'status'];

    protected $versionStrategy = VersionStrategy::SNAPSHOT;

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
        $this->addMediaCollection('files');
    }
}
