<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\DB;
use Spatie\Tags\Tag as BaseTag;

class Tag extends BaseTag
{
    public function news(): MorphToMany
    {
        return $this->morphedByMany(News::class, 'taggable');
    }

    public function scopeQueryWith(Builder $query, string $name)
    {
        return $query->whereHas($name);
    }

    protected static function booted()
    {
        static::deleted(function ($tag) {
            DB::table('taggables')
                ->where('tag_id', $tag->id)
                ->delete();
        });
    }
}
