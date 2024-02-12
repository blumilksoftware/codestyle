<?php

declare(strict_types=1);

use Blumilk\Codestyle\Configuration\Defaults\CommonRules;
use Blumilk\Codestyle\Configuration\Defaults\LaravelPaths;

class TestException extends Exception
{
    protected string $rules = LaravelPaths::class;

    public function rules(CommonRules $rules): void
    {
        echo 123;
    }
}
