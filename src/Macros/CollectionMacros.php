<?php

namespace Teofanis\LaravelUtils\Macros;

use Illuminate\Support\Collection;
use Teofanis\LaravelUtils\Contracts\MacrosContract;

class CollectionMacros implements MacrosContract
{
    public function getBaseClass()
    {
        return Collection::class;
    }

    public function toAssoc()
    {
        return function ($keyName = null) {
            $keyName = $keyName ?? 'id' ?? 0;

            return $this->mapWithKeys(fn ($i) => [is_scalar($i) ? $i : $i[$keyName] => $i]);
        };
    }
}
