<?php

declare(strict_types=1);

use Blumilk\Codestyle\Config;
use Blumilk\Codestyle\Configuration\Defaults\Paths;

$paths = new Paths();

$config = new Config(
    paths: $paths->add("src", "tests")
);

return $config->config();
