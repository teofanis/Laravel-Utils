<?php

namespace Teofanis\LaravelUtils\Concerns;

use Illuminate\Support\Facades\App;

trait GenericHelpers {

    function devMode($additonalDevEnvs = []) {
        $additonalDevEnvs = array_merge($additonalDevEnvs, ['local', 'staging', 'testing']);
        return App::environment(...$additonalDevEnvs);
    }
}
