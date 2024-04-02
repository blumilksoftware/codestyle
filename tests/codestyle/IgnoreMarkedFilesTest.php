<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Tests;

use Exception;

class IgnoreMarkedFilesTest extends CodestyleTestCase
{
    /**
     * @throws Exception
     */
    public function testIgnoreMarkedFiles(): void
    {
        $this->testFixture("ignoreMarkedFiles");
    }

    protected function getConfigPath(): string
    {
        return "./tests/codestyle/config/config.ignoreMarkedFiles.php";
    }

    /**
     * @dataProvider providePhp80Fixtures
     * @throws Exception
     */
    protected function testFixture(string $name): void
    {
        copy(__DIR__ . "/../fixtures/{$name}/actual.php", __DIR__ . "/tmp/{$name}.php");

        $this->assertTrue(
            $this->runFixer(fix: true),
            "Fixture fixtures/{$name} was not proceeded properly.",
        );

        $this->assertFileEquals(
            __DIR__ . "/../fixtures/{$name}/expected.php",
            __DIR__ . "/tmp/{$name}.php",
            "Result of proceeded fixture fixtures/{$name} is not equal to expected.",
        );
    }
}
