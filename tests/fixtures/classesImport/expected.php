<?php

declare(strict_types=1);

use Blumilk\Codestyle\Configuration\Defaults\CommonRules;
use Blumilk\Codestyle\Configuration\Defaults\Paths;
use PhpCsFixer\Tokenizer\Tokens;

class TestException extends Exception
{
    protected string $var = "Error";
    protected string $class = Error::class;
    protected string $laravel = "LaravelPaths";
    protected string $bar = Tokens::class;
    protected string $foo = Tokens::class;
    protected string $faz = "\Tokens";

    public function rules(CommonRules $rules): void
    {
        echo 123;
    }

    public function test(): void
    {
        $foo = Paths::class;
        $baz = Exception::class;
        $fuz = "Exception";
    }
}
