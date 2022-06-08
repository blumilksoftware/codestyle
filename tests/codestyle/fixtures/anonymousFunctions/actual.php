<?php

declare(strict_types=1);

class Filter
{
    public static function even(array $array): array
    {
        return array_filter($array, fn (int $i): bool => $i % 2 === 0);
    }
}
