<?php

namespace Teofanis\LaravelUtils\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Teofanis\LaravelUtils\LaravelUtils
 */
class Utils extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'utilities';
    }
}
