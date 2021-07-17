<?php

declare(strict_types=1);

use Blumilk\Codestyle\Config;
use Blumilk\Codestyle\Configuration\Defaults\LaravelPaths;
use PHPUnit\Framework\TestCase;

class LaravelPathsConfigurationTest extends TestCase
{
    public function testLaravelPathsConfiguration(): void
    {
        $paths = new LaravelPaths();
        $config = new Config(paths: $paths);

        $this->assertSame(
            ["app", "config", "database", "resources/lang", "routes", "tests"],
            $config->options()["paths"]
        );
    }

    public function testFilteredLaravelPathsConfiguration(): void
    {
        $paths = new LaravelPaths();
        $config = new Config(paths: $paths->filter("resources/lang"));

        $this->assertSame(
            ["app", "config", "database", "routes", "tests"],
            $config->options()["paths"]
        );
    }

    public function testClearedLaravelPathsConfiguration(): void
    {
        $paths = new LaravelPaths();
        $config = new Config(paths: $paths->clear()->add("src"));

        $this->assertSame(["src"], $config->options()["paths"]);
    }
}
