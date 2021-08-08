<?php

namespace Teofanis\LaravelUtils;

use Teofanis\LaravelUtils\Macros\CollectionMacros;

class MacrosRegistry
{
    public function macros()
    {
        return [
            CollectionMacros::class,
        ];
    }
}
