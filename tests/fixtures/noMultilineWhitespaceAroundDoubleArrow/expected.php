<?php

declare(strict_types=1);

class EmptyArray
{
    public function getArray1(): array
    {
        return [];
    }

    public function getArray2(): array
    {
        return [1 => 2];
    }

    public function getClosure(): Closure
    {
        return fn() => [];
    }
}
