<?php

namespace Teofanis\LaravelUtils;

use Illuminate\Support\Traits\Macroable;
use Teofanis\LaravelUtils\Concerns\ArraySupport;
use Teofanis\LaravelUtils\Concerns\GenericHelpers;
use Teofanis\LaravelUtils\Concerns\StringSupport;

class Utilities
{
    use StringSupport;
    use ArraySupport;
    use GenericHelpers;
    use Macroable;
}
