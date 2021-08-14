<?php

namespace Teofanis\LaravelUtils\Concerns;

trait ArraySupport
{

function replaceKeys($oldKey, $newKey, array $input)
{
    $return = array();
    foreach ($input as $key => $value) {
        if ($key === $oldKey) {
            $key = $newKey;
        }
        if (is_array($value)) {
            $value = $this->replaceKeys($oldKey, $newKey, $value);
        }
        $return[$key] = $value;
    }
    return $return;
}


function replaceMultipleKeys($arrayKeys, array $input)
{
    foreach ($arrayKeys as $oldKey => $newKey) {
        $input = $this->replaceKeys($oldKey, $newKey, $input);
    }
    return $input;
}

function prefixKeys($prefix, array $dataset, $deep = false)
{
    return collect($dataset)->mapWithKeys(function ($value, $key) use ($prefix, $deep) {
        if($deep && is_array($value)) {
            $value = $this->prefixKeys($prefix, $value, $deep);
        }
        return ["{$prefix}{$key}" => $value];
    })->toArray();
}

function removeKeyPrefixes($prefix, $dataset, $deep = false)
{
    return collect($dataset)->mapWithKeys(function ($value, $key) use ($prefix, $deep) {
        $newKey = array_values(array_filter(explode($prefix, $key)))[0];
        if($deep && is_array($value)) {
            $value = $this->removeKeyPrefixes($prefix, $value, $deep);
        }
        return ["{$newKey}" => $value];
    })->toArray();
}

}
