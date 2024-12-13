<?php

declare(strict_types=1);

class Example
{
    use Castable;

    public const PublicLaravel = "PublicLaravel";
    protected const ProtectedLaravel = "ProtectedLaravel";
    private const PrivateLaravel = "PrivateLaravel";

    public static $staticLaravel = "LaravelPaths";
    protected static $staticClass = Error::class;
    private static $staticVar = "Error";
    public string $laravel = "LaravelPaths";
    protected string $class = Error::class;
    private string $var = "Error";

    public static function testStatic123(): void
    {
    }

    public function test321(): void
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
