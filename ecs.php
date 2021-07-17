<?php

declare(strict_types=1);

use Blumilk\Codestyle\Config;
use Blumilk\Codestyle\Configuration\Defaults\Paths;

$config = new Config(
    paths: new Paths("src", "tests/unit", "tests/codestyle/CodestyleTest.php")
);

return $config->config();
