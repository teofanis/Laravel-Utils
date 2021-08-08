<?php

use Illuminate\Support\Facades\Log;
use Teofanis\LaravelUtils\AliasRegistry;

$aliases = config('utils.aliases');
$notRegistered = [];
foreach($aliases as $class => $alias) {
    if (!function_exists($class)) {
        AliasRegistry::add($alias, function (... $args) use ($class){
            return new $class(...$args);
        });
        continue;
    }
    $notRegistered[] = $alias;
}
try {
    eval(AliasRegistry::make());
}catch(\Exception $e) {
    Log::error("Failed to register class aliases \n" . $e->getMessage);
}

if(!empty($notRegistered)) {
    $notRegistered = implode(',', $notRegistered);
    Log::warning("Note the following helper functions were not registered as they already exist.\n
    Specify a different name in the packages' config aliases array. \n
    {$notRegistered}");
}

