<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Configuration\Defaults;

use Blumilk\Codestyle\Configuration\SkippedRules;

class CommonSkippedRules extends Rules implements SkippedRules
{
    protected array $rules = [];
}
