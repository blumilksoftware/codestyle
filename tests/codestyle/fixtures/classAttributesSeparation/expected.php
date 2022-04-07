<?php

declare(strict_types=1);

class classAttributesSeparationExample
{
    use ExampleTraitOne;
    use ExampleTraitTwo;

    protected string $exampleA;
    protected string $exampleB;

    public function testFunctionA(string $a): string
    {
        return $a;
    }

    public function testFunctionB(string $b): string
    {
        return $b;
    }
}
