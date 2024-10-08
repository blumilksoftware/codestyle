<?php

declare(strict_types=1);

class Example
{
    use Castable;

    public string $laravel = "LaravelPaths";
    protected string $class = Error::class;
    private string $var = "Error";

    public static function testStatic(): void
    {
    }

    public function test(): void
    {
    }

    public function test2(): void
    {
    }

    protected static function test5(): void
    {
    }

    protected function test3(): void
    {
    }

    private static function test6(): void
    {
    }

    private function test4(): void
    {
    }
}
