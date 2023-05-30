<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Tests;

use Exception;
use PhpCsFixer\Console\Application;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\BufferedOutput;

abstract class CodestyleTestCase extends TestCase
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
     * @dataProvider providePhp80Fixtures
     * @throws Exception
     */
    protected function testFixture(string $name): void
    {
        copy(__DIR__ . "/fixtures/{$name}/actual.php", __DIR__ . "/tmp/{$name}.php");

        $this->assertFalse(
            $this->runFixer(),
            "Fixture fixtures/{$name} returned invalid true result.",
        );

        $this->assertTrue(
            $this->runFixer(fix: true),
            "Fixture fixtures/{$name} was not proceeded properly.",
        );

        $this->assertFileEquals(
            __DIR__ . "/fixtures/{$name}/expected.php",
            __DIR__ . "/tmp/{$name}.php",
            "Result of proceeded fixture fixtures/{$name} is not equal to expected.",
        );
    }

    /**
     * @throws Exception
     */
    protected function runFixer(bool $fix = false): bool
    {
        $dryRun = $fix ? "" : "--dry-run";

        $application = new Application();
        $application->setAutoExit(false);

        $output = new BufferedOutput();
        $config = $this->getConfigPath();
        $result = $application->run(new StringInput("fix {$dryRun} --diff --config $config"), $output);

        return $result === 0;
    }

    protected function clearTempDirectory(): void
    {
        $files = glob(__DIR__ . "/tmp/*.php");
        foreach ($files as $file) {
            unlink($file);
        }
    }

    protected function getConfigPath(): string
    {
        return "./tests/codestyle/config/config.php";
    }
}
