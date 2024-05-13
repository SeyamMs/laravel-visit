<?php

namespace SeyamMs\LaravelVisit\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'sha1',
        'weight',
    ];

    public function visitable()
    {
        return $this->morphTo();
    }
}
