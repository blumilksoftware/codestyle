<?php

declare(strict_types=1);

use Blumilk\Codestyle\Config;
use Blumilk\Codestyle\Configuration\Defaults\Paths;

$config = new Config(
    paths: new Paths(
        "codestyle.php",
        "bin",
        "src",
        "tests/unit",
        "tests/codestyle",
    ),
);

return $config->config();
