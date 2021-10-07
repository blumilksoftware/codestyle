<?php

declare(strict_types=1);

$a = [
    1,
    2,
];

function b(): int
{
    $a = 1;

    return $a;
}

function c(int $a, int $b, int $c): int
{
    return $a + $b + $c;
}

$d = c(
    1,
    2,
    3,
);
