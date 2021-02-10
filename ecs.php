<?php

declare(strict_types=1);

use Blumilk\Codestyle\Config;
use Blumilk\Codestyle\Configuration\Paths;

$paths = new class() implements Paths {
    public function get(): array
    {
        return ["src", "tests"];
    }
};

$config = new Config(
    paths: $paths
);

return $config->config();
