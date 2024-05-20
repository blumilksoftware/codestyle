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
            ["app", "bootstrap/app.php", "bootstrap/providers.php", "config", "database", "lang", "public/index.php", "routes", "tests"],
            $config->options()["paths"],
        );
    }

    public function testLaravel8PathsConfiguration(): void
    {
        $paths = new LaravelPaths(LaravelPaths::LARAVEL_8_PATHS);
        $config = new Config(paths: $paths);

        $this->assertSame(
            ["app", "bootstrap/app.php", "config", "database", "public/index.php", "resources/lang", "routes", "tests"],
            $config->options()["paths"],
        );
    }

    public function testLaravel9And10PathsConfiguration(): void
    {
        $paths = new LaravelPaths(LaravelPaths::LARAVEL_10_PATHS);
        $config = new Config(paths: $paths);

        $this->assertSame(
            ["app", "bootstrap/app.php", "config", "database", "lang", "public/index.php", "routes", "tests"],
            $config->options()["paths"],
        );
    }

    public function testFilteredLaravelPathsConfiguration(): void
    {
        $paths = new LaravelPaths();
        $config = new Config(paths: $paths->filter("lang"));

        $this->assertSame(
            ["app", "bootstrap/app.php", "bootstrap/providers.php", "config", "database", "public/index.php", "routes", "tests"],
            $config->options()["paths"],
        );
    }

    public function testClearedLaravelPathsConfiguration(): void
    {
        $paths = new LaravelPaths();
        $config = new Config(paths: $paths->clear()->add("src"));

        $this->assertSame(["src"], $config->options()["paths"]);
    }
}
