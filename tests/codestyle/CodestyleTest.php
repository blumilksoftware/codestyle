<?php

declare(strict_types=1);

use Composer\Console\Application;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\ArrayInput;

class CodestyleTest extends TestCase
{
    protected const FIXTURES = [
        "singleQuotes",
        "strictTypes",
        "unionTypes",
    ];

    protected Application $application;

    protected function setUp(): void
    {
        $this->bootstrapComposer();
    }

    /**
     * @throws Exception
     */
    public function testFixtures(): void
    {
        $this->clearTempDirectory();

        foreach (static::FIXTURES as $fixture) {
            $this->testFixture($fixture);
        }

        $this->clearTempDirectory();
    }

    protected function bootstrapComposer(): void
    {
        $this->application = new Application();
        $this->application->setAutoExit(false);
    }

    /**
     * @throws Exception
     */
    protected function runComposerEcsCommand(bool $fix = false): bool
    {
        $command = $fix ? "ecsf-tmp" : "ecs-tmp";
        $input = [
            "command" => $command,
        ];

        return $this->application->run(new ArrayInput($input)) === 0;
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
