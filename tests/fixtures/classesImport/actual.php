<?php

class TestException extends \Exception
{
    protected string $var = "Error";
    protected string $class = "\Error";
    protected string $laravel = "LaravelPaths";
    protected string $bar = "\PhpCsFixer\Tokenizer\Tokens";
    protected string $foo = "PhpCsFixer\Tokenizer\Tokens";
    protected string $faz = "\Tokens";

    public function rules(\Blumilk\Codestyle\Configuration\Defaults\CommonRules $rules): void
    {
        echo 123;
    }

    public function test(): void
    {
        $foo = 'Blumilk\Codestyle\Configuration\Defaults\Paths';
        $baz = "\Exception";
        $fuz = "Exception";
    }
}
