<?php

declare(strict_types=1);

use Blumilk\Codestyle\Config;
use Blumilk\Codestyle\Configuration\Defaults\Paths;

$config = new Config(
    paths: new Paths(
        "codestyle.php",
        "src",
//        "tests/unit",
//        "tests/codestyle/CodestyleTest.php",
//        "tests/codestyle/config.php",
//        "tests/codestyle/fixtures/noExtraBlankLines/actual.php",
//        "tests/codestyle/fixtures/enums/actual.php",
    ),
);

return $config->config();
