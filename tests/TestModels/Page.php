<?php

namespace SeyamMs\LaravelVisit\Tests\TestModels;

use Illuminate\Database\Eloquent\Model;
use SeyamMs\LaravelVisit\Traits\Visitable;

class Page extends Model
{
    use Visitable;

    protected $fillable = [
        'title',
    ];

    public $timestamps = false;
}
