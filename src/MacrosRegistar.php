<?php

namespace Teofanis\LaravelUtils;

use Teofanis\LaravelUtils\Macros\CollectionMacros;

class MacrosRegistar
{
    public function macros()
    {
        return [
            CollectionMacros::class,
        ];
    }
}
