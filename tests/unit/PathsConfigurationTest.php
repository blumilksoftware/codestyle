<?php

declare(strict_types=1);

use Blumilk\Codestyle\Config;
use Blumilk\Codestyle\Configuration\Defaults\Paths;
use PHPUnit\Framework\TestCase;

class PathsConfigurationTest extends TestCase
{
    public function testEmptyPathsConfiguration(): void
    {
        $paths = new Paths();
        $config = new Config(paths: $paths);

        $this->assertSame([], $config->options()["paths"]);
    }

    public function testPathsCustomizedByConstructorConfiguration(): void
    {
        $paths = new Paths("src", "tests");
        $config = new Config(paths: $paths);

        $this->assertSame(["src", "tests"], $config->options()["paths"]);
    }

    public function testPathsCustomizedByMethodsConfiguration(): void
    {
        $paths = new Paths();
        $config = new Config(paths: $paths->add("src", "tests"));

        $this->assertSame(["src", "tests"], $config->options()["paths"]);
    }

    public function testRepeatedPathsConfiguration(): void
    {
        $paths = new Paths("src");
        $config = new Config(paths: $paths->add("src"));

        $this->assertSame(["src"], $config->options()["paths"]);
    }

    public function testFilteringNonExistingPathsConfiguration(): void
    {
        $paths = new Paths("src");
        $config = new Config(paths: $paths->filter("tests"));

        $this->assertSame(["src"], $config->options()["paths"]);
    }
}
