<?php

namespace Teofanis\LaravelUtils\Commands;

use Illuminate\Console\Command;

class LaravelUtilsCommand extends Command
{
    public $signature = 'laravel-utils';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
