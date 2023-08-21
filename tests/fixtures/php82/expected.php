<?php

declare(strict_types=1);

readonly class Php82
{
    use Usable;

    public function always(): true
    {
        return true;
    }

    public function never(): false
    {
        return false;
    }

    public function null(): null
    {
        return null;
    }
}

trait Usable
{
    public const X = "x";
}
