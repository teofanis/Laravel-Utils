<?php

namespace Teofanis\LaravelUtils\Concerns;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;

trait GenericHelpers
{
    public function devMode($additonalDevEnvs = [])
    {
        $additonalDevEnvs = array_merge($additonalDevEnvs, ['local', 'staging', 'testing']);

        return App::environment(...$additonalDevEnvs);
    }

    public function bladeCompile($someRandomViewName, array $args = [])
    {
        $compiled = Blade::compileString($someRandomViewName);
        ob_start() and extract($args, EXTR_SKIP);

        try {
            eval('?>' . $compiled);
        } catch (\Exception $e) {
            ob_get_clean();

            throw $e;
        }
        $content = ob_get_clean();

        return $content;
    }

    public function hydrateAndCompile($subject, $context = [])
    {
        $matches = [];
        $new = $subject;
        $count = preg_match_all('/\{\$(.*)\}/U', $subject, $matches);
        if ($count && $matches && $context) {
            $matchText = $matches[0];
            $matchVar = $matches[1];
            for ($i = 0; $i < $count; $i++) {
                $txt = $matchText[$i];
                $var = $matchVar[$i];
                $val = $context[$var] ?? '';
                $new = str_replace($txt, $val, $new);
            }
        }

        return $this->bladeCompile($new, $context);
    }

    public function dumpToString(...$args)
    {
        $orgVarDumperValue = $_SERVER['VAR_DUMPER_FORMAT'] ?? null;
        $_SERVER['VAR_DUMPER_FORMAT'] = 'html';

        ob_start();
        dump(...$args);
        $content = ob_get_contents();
        ob_get_clean();

        if ($orgVarDumperValue === null) {
            unset($_SERVER['VAR_DUMPER_FORMAT']);
        } else {
            $_SERVER['VAR_DUMPER_FORMAT'] = $orgVarDumperValue;
        }

        return $content;
    }
}
