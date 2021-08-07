<?php

namespace Teofanis\LaravelUtils\Traits;

trait StringSupport {

    function startsWith($needle, $haystack)
    {
        $len = strlen($needle);
        return (substr($haystack, 0, $len) === $needle);
    }

    function endsWith($needle, $haystack)
    {
        $len = strlen($needle);
        return (substr($haystack, -$len) === $needle);
    }

    function getToken($haystack, $position, $delimiter = ".")
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

    function unPrefix($prefix, $string)
    {
        if(!$string) return "";
        if(!$prefix) return $string;
        $prefixLength = strlen($prefix);
        $stringLength = strlen($string);
        $result = strtolower(substr($string, 0, $prefixLength));
        return ($result == strtolower($prefix)) ? substr($string, $prefixLength, $stringLength) : $string;
    }

    function unPostfix($postfix, $string)
    {
        if(!$string) return "";
        if(!$postfix) return $string;
        $postfixLength = strlen($postfix);
        $stringLength = strlen($string);
        $result = strtolower(substr($string, -$postfixLength, $postfixLength));
        return ($result == strtolower($postfix)) ? substr($string, 0, $stringLength - $postfixLength) : $string;
    }

    function countTokens($haystack, $delimiter = ".")
    {
        return count(explode($delimiter, $haystack));
    }

    function left($value, $length = 1)
    {
        return substr($value, 0, $length);
    }

    function right($value, $length = 1)
    {
        return substr($value, -$length, $length);
    }

    function stringContains($needle, $haystack)
    {
        return !(stripos($haystack, $needle) === false);
    }

    function removeLeading($needle, $haystack)
    {
        return $this->startsWith($needle, $haystack) ? substr($haystack, strlen($needle)) : $haystack;
    }

    function removeTrailing($needle, $haystack)
    {
        return $this->endsWith($needle, $haystack) ? substr($haystack, 0, -strlen($needle)) : $haystack;
    }

    // function extractFirstToken(&$haystack, $delimiter = ".")
    // {
    //     $token = $this->getToken($haystack, 1, $delimiter);
    //     $string = $this->unPrefix($token, $haystack);
    //     $haystack = $this->unPrefix($delimiter, $string);
    //     return $token;
    // }
}
