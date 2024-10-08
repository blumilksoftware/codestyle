<?php

class Example {
    private string $var = "Error";
    protected string $class = Error::class;
    public string $laravel = "LaravelPaths";

    public function test(): void
    {
    }

    public static function testStatic(): void
    {
    }

    use Castable;

    public function test2(): void
    {
    }

    protected function test3(): void
    {
    }

    private function test4(): void
    {
    }

    protected static function test5(): void
    {
    }

    private static function test6(): void
    {
    }
}
