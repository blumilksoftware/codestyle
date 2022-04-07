<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Configuration\Defaults;

class LaravelPaths extends Paths
{
    public const LARAVEL_8_PATHS = ["app", "bootstrap/app.php", "config", "database", "public/index.php", "resources/lang", "routes", "tests"];

    public const LARAVEL_9_PATHS = ["app", "bootstrap/app.php", "config", "database", "lang", "public/index.php", "routes", "tests"];

    public function __construct(array $paths = self::LARAVEL_9_PATHS)
    {
        parent::__construct(...$paths);
    }
}
