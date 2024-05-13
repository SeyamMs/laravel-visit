<?php

namespace SeyamMs\LaravelVisit\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SeyamMs\LaravelVisit\LaravelVisit
 */
class LaravelVisit extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'LaravelVisit';
    }
}
