<?php

class classAttributesSeparationExample
{
    use ExampleTraitOne;

    use ExampleTraitTwo;

    public const EXAMPLE_CONST_A = "A";
    public const EXAMPLE_CONST_B = "B";
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
