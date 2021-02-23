<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Configuration\Defaults;

class LaravelPaths extends Paths
{
    protected array $paths = ["app", "config", "database", "resources/lang", "routes", "tests"];
}
