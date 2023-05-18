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
     * @dataProvider providePhp80Fixtures
     * @requires PHP >= 8.0
     * @throws Exception
     */
    public function testPhp80Fixtures(string $name): void
    {
        $this->testFixture($name);
    }

    /**
     * @dataProvider providePhp81Fixtures
     * @requires PHP >= 8.1
     * @throws Exception
     */
    public function testPhp81Fixtures(string $name): void
    {
        $this->testFixture($name);
    }

    /**
     * @dataProvider providePhp82Fixtures
     * @requires PHP >= 8.2
     * @throws Exception
     */
    public function testPhp82Fixtures(string $name): void
    {
        $this->testFixture($name);
    }

    public static function providePhp80Fixtures(): array
    {
        return [
            ["noExtraBlankLines"],
            ["nullableTypeForDefaultNull"],
            ["operatorSpacing"],
            ["singleQuotes"],
            ["strictTypes"],
            ["trailingCommas"],
            ["unionTypes"],
            ["references"],
            ["classAttributesSeparation"],
            ["uselessParenthesis"],
            ["laravelMigrations"],
            ["phpdocs"],
            ["yodaStyle"],
            ["objectOperators"],
            ["anonymousFunctions"],
            ["namespaces"],
            ["emptyLines"],
            ["importsOrder"],
        ];
    }

    public static function providePhp81Fixtures(): array
    {
        return [
            ["enums"],
            ["readonlies"],
        ];
    }

    public static function providePhp82Fixtures(): array
    {
        return [
            ["php82"],
        ];
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
        $result = $application->run(new StringInput("fix {$dryRun} --diff --config ./tests/codestyle/config.php"), $output);

        return $result === 0;
    }

    protected function clearTempDirectory(): void
    {
        $files = glob(__DIR__ . "/tmp/*.php");
        foreach ($files as $file) {
            unlink($file);
        }
    }
}
