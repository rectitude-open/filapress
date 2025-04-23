<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SolutionForest\FilamentTree\Concern\ModelTree;

class NewsCategory extends Model
{
    /** @use HasFactory<\Database\Factories\NewsCategoryFactory> */
    use HasFactory;

    use ModelTree;

    protected $fillable = ['title', 'parent_id', 'weight'];
}
