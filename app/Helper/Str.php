<?php

declare(strict_types=1);

namespace App\Helper;

final class Str
{
    public static function multiExplode(array $delimiters, string $string, string $special = '|||'): array
    {
        if (!empty($delimiters)) {
            foreach ($delimiters as $delimiter) {
                $string = \Illuminate\Support\Str::replace($delimiter, $special, $string);
            }
        }

        return explode($special, $string);
    }

    public static function clean(string $str): string
    {
        $str = \Illuminate\Support\Str::replace(' ', '', $str);
        $str = \Illuminate\Support\Str::replace(" ", " ", $str);

        return trim($str);
    }

    public static function cleanAllString(string $str): string
    {
        $str = preg_replace("/\s+/", "", $str);
        $str = \Illuminate\Support\Str::replace(" ", " ", $str);

        return trim($str);
    }
}
