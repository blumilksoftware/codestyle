<?php

declare(strict_types=1);

use PhpCsFixer\Console\Application;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\BufferedOutput;

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
     * @requires PHP >= 8.0
     * @throws Exception
     */
    public function testPhp80Fixtures(): void
    {
        $fixtures = [
            "noExtraBlankLines",
            "nullableTypeForDefaultNull",
            "operatorSpacing",
            "singleQuotes",
            "strictTypes",
            "trailingCommas",
            "unionTypes",
            "references",
            "classAttributesSeparation",
            "noUselessParenthesisFixer",
            "laravelMigrations",
            "phpdocs",
        ];

        foreach ($fixtures as $fixture) {
            $this->testFixture($fixture);
        }
    }

    /**
     * @requires PHP >= 8.1
     * @throws Exception
     */
    public function testPhp81Fixtures(): void
    {
        $fixtures = [
            "enums",
            "readonlies",
        ];

        foreach ($fixtures as $fixture) {
            $this->testFixture($fixture);
        }
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
        $result = $application->run(new StringInput("fix ${dryRun} --diff --config ./tests/codestyle/config.php"), $output);

        return $result === 0;
    }

    /**
     * @throws Exception
     */
    protected function testFixture(string $name): void
    {
        copy(__DIR__ . "/fixtures/${name}/actual.php", __DIR__ . "/tmp/${name}.php");

        $this->assertFalse(
            $this->runFixer(),
            "Fixture fixtures/${name} returned invalid true result.",
        );

        $this->assertTrue(
            $this->runFixer(fix: true),
            "Fixture fixtures/${name} was not proceeded properly.",
        );

        $this->assertFileEquals(
            __DIR__ . "/fixtures/${name}/expected.php",
            __DIR__ . "/tmp/${name}.php",
            "Result of proceeded fixture fixtures/${name} is not equal to expected.",
        );
    }

    protected function clearTempDirectory(): void
    {
        $files = glob(__DIR__ . "/tmp/*.php");
        foreach ($files as $file) {
            unlink($file);
        }
    }
}
