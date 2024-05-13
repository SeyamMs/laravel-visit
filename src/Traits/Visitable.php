<?php

namespace SeyamMs\LaravelVisit\Traits;

use SeyamMs\LaravelVisit\Models\Visit;
use SeyamMs\LaravelVisit\Facades\LaravelVisit;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Visitable
{
    public function vzt()
    {
        return LaravelVisit::setModel($this);
    }

    public function relation(): MorphMany
    {
        return $this->morphMany(Visit::class, 'visitable');
    }
}
