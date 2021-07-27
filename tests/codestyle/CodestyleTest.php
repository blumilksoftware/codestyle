<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class CodestyleTest extends TestCase
{
    protected function setUp(): void
    {
        $this->clearTempDirectory();
    }

    protected function tearDown(): void
    {
        $this->clearTempDirectory();
    }

    /**
     * @throws Exception
     */
    public function testFixtures(): void
    {
        $fixtures = scandir(__DIR__ . "/fixtures");
        $fixtures = array_filter($fixtures, fn(string $dir): bool => !str_contains($dir, "."));

        foreach ($fixtures as $fixture) {
            $this->testFixture($fixture);
        }
    }

    /**
     * @throws Exception
     */
    protected function runComposerEcsCommand(bool $fix = false): bool
    {
        $command = $fix ? "ecsf-tmp" : "ecs-tmp";
        $result = 0;
        $output = null;

        exec("./vendor/bin/composer " . $command, $output, $result);

        return $result === 0;
    }

    /**
     * @throws Exception
     */
    protected function testFixture(string $name): void
    {
        copy(__DIR__ . "/fixtures/${name}/actual.php", __DIR__ . "/tmp/${name}.php");
        $this->assertFalse($this->runComposerEcsCommand());
        $this->assertTrue($this->runComposerEcsCommand(true));
        $this->assertFileEquals(__DIR__ . "/fixtures/${name}/expected.php", __DIR__ . "/tmp/${name}.php");
    }

    protected function clearTempDirectory(): void
    {
        $files = glob(__DIR__ . "/tmp/*.php");
        foreach ($files as $file) {
            unlink($file);
        }
    }
}
