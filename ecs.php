<?php

declare(strict_types=1);

use Blumilk\Codestyle\Config;
use Blumilk\Codestyle\Configuration\Defaults\Paths;

$config = new Config(
    paths: new Paths("ecs.php", "src", "tests/unit", "tests/codestyle/CodestyleTest.php", "tests/codestyle/config.php")
);

return $config->config();
