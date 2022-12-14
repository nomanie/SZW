<?php

namespace App\Rules;

trait RuleTrait
{
    public static function getChecksum(string $value, array $weights, int $modulo = 11): int
    {
        $sum = 0;
        $countWeights = count($weights);
        for ($i = 0; $i < $countWeights; $i++) {
            $sum += $weights[$i] * intval($value[$i]);
        }

        return $sum % $modulo;
    }

    public static function clean($value): array|string|null
    {
        return preg_replace('/[\-_]/', "", $value);
    }
}
