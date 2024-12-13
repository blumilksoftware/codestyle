<?php

class Example {
    private static $staticVar = "Error";
    protected static $staticClass = Error::class;
    public static $staticLaravel = "LaravelPaths";
    private string $var = "Error";
    protected string $class = Error::class;
    public string $laravel = "LaravelPaths";
    public const PublicLaravel = "PublicLaravel";
    protected const ProtectedLaravel = "ProtectedLaravel";
    private const PrivateLaravel = "PrivateLaravel";

    public function test321(): void
    {
    }

    public static function testStatic123(): void
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
