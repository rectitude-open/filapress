<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Spatie\Tags\Tag as BaseTag;

class Tag extends BaseTag
{
    protected static function booted()
    {
        static::deleted(function ($tag) {
            DB::table('taggables')
                ->where('tag_id', $tag->id)
                ->delete();
        });
    }
}
