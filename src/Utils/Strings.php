<?php

namespace Menrui\Utils;

class Strings
{
    public static function snakeToPascal(string $s): string
    {
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $s)));
    }
}
