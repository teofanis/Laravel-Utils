<?php

namespace Teofanis\LaravelUtils\Traits;

trait ArraySupport
{
    public function replaceKeys($oldKey, $newKey, array $array)
    {
        $result = [];
        foreach ($array as $key => $value) {
            if ($key === $oldKey) {
                $key = $newKey;
            }
            if (is_array($value)) {
                $value = $this->replaceKeys($oldKey, $newKey, $value);
            }

            return $result[$key] = $value;
        }

        return $result;
    }
}
