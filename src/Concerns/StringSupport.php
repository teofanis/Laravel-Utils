<?php

namespace Teofanis\LaravelUtils\Concerns;

trait StringSupport
{
    public function startsWith($needle, $haystack)
    {
        $len = strlen($needle);

        return (substr($haystack, 0, $len) === $needle);
    }

    public function endsWith($needle, $haystack)
    {
        $len = strlen($needle);

        return (substr($haystack, -$len) === $needle);
    }

    public function getToken($haystack, $position, $delimiter = ".")
    {
        $tokens = explode($delimiter, $haystack);
        if ($tokens && (count($tokens) >= $position)) {
            return $tokens[$position - 1] ?? "";
        } elseif ($tokens && (count($tokens) < $position)) {
            return "";
        } else {
            return $haystack;
        }
    }

    public function unPrefix($prefix, $string)
    {
        if (! $string) {
            return "";
        }
        if (! $prefix) {
            return $string;
        }
        $prefixLength = strlen($prefix);
        $stringLength = strlen($string);
        $result = strtolower(substr($string, 0, $prefixLength));

        return ($result == strtolower($prefix)) ? substr($string, $prefixLength, $stringLength) : $string;
    }

    public function unPostfix($postfix, $string)
    {
        if (! $string) {
            return "";
        }
        if (! $postfix) {
            return $string;
        }
        $postfixLength = strlen($postfix);
        $stringLength = strlen($string);
        $result = strtolower(substr($string, -$postfixLength, $postfixLength));

        return ($result == strtolower($postfix)) ? substr($string, 0, $stringLength - $postfixLength) : $string;
    }

    public function countTokens($haystack, $delimiter = ".")
    {
        return count(explode($delimiter, $haystack));
    }

    public function left($value, $length = 1)
    {
        return substr($value, 0, $length);
    }

    public function right($value, $length = 1)
    {
        return substr($value, -$length, $length);
    }

    public function stringContains($needle, $haystack)
    {
        return ! (stripos($haystack, $needle) === false);
    }

    public function removeLeading($needle, $haystack)
    {
        return $this->startsWith($needle, $haystack) ? substr($haystack, strlen($needle)) : $haystack;
    }

    public function removeTrailing($needle, $haystack)
    {
        return $this->endsWith($needle, $haystack) ? substr($haystack, 0, -strlen($needle)) : $haystack;
    }

    public function random_str($length = 32)
    {
        $length = $length <= 0 ? 32 : $length;
        $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $tokens = [];
        $max = mb_strlen($characters, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $tokens[] = $characters[random_int(0, $max)];
        }

        return implode('', $tokens);
    }

    // function extractFirstToken(&$haystack, $delimiter = ".")
    // {
    //     $token = $this->getToken($haystack, 1, $delimiter);
    //     $string = $this->unPrefix($token, $haystack);
    //     $haystack = $this->unPrefix($delimiter, $string);
    //     return $token;
    // }
}
