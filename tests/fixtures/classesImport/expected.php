<?php

declare(strict_types=1);

use Blumilk\Codestyle\Configuration\Defaults\CommonRules;

class TestException extends Exception
{
    protected string $var = "Error";
    protected string $class = \Error::class;
    protected string $laravel = "LaravelPaths";
    protected string $bar = \PhpCsFixer\Tokenizer\Tokens::class;
    protected string $foo = \PhpCsFixer\Tokenizer\Tokens::class;
    protected string $faz = "\Tokens";

    public function rules(CommonRules $rules): void
    {
        echo 123;
    }

    public function test(): void
    {
        $foo = \Blumilk\Codestyle\Configuration\Defaults\Paths::class;
        $baz = \Exception::class;
        $fuz = "Exception";
    }
}
