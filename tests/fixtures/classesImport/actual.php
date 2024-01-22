<?php

class TestException extends \Exception
{
    protected string $rules = "\Blumilk\Codestyle\Configuration\Defaults\LaravelPaths";

    public function rules(\Blumilk\Codestyle\Configuration\Defaults\CommonRules $rules): void
    {
        echo 123;
    }
}
