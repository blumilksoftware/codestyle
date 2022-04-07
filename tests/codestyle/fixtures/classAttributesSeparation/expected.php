<?php

declare(strict_types=1);

class classAttributesSeparationExample
{
    public function testFunctionA(string $a): string
    {
        return $a;
    }

    public function testFunctionB(string $b): string
    {
        return $b;
    }
}
