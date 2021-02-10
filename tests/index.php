<?php

declare(strict_types=1);

require __DIR__ . "/../vendor/autoload.php";

use Blumilk\Codestyle\Config;
use Blumilk\Codestyle\Configuration\Defaults\LaravelPaths;

$paths = new class extends LaravelPaths {
    protected array $paths = ["app"];
};

$config = new Config(paths: $paths);
var_dump($config->config());
