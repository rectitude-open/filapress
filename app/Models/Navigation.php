<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SolutionForest\FilamentTree\Concern\ModelTree;

class Navigation extends Model
{
    /** @use HasFactory<\Database\Factories\NavigationFactory> */
    use HasFactory;
    use ModelTree;

    protected $fillable = ['title', 'parent_id', 'weight'];
}
