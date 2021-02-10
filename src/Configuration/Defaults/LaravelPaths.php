<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Configuration\Defaults;

use Blumilk\Codestyle\Configuration\Paths;

class LaravelPaths implements Paths
{
    protected array $paths = ["app", "config", "database", "resources/lang", "routes"];

    public function get(): array
    {
        return $this->paths;
    }
}
