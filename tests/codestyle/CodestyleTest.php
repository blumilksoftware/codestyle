<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class CodestyleTest extends TestCase
{
    /**
     * @requires PHP >= 8.0
     * @throws Exception
     */
    public function testPhp80Fixtures(): void
    {
        $fixtures = [
            "noExtraBlankLines",
            "noExtraBlankLines",
            "nullableTypeForDefaultNull",
            "operatorSpacing",
            "singleQuotes",
            "strictTypes",
            "trailingCommas",
            "unionTypes",
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
        ];

        foreach ($fixtures as $fixture) {
            $this->testFixture($fixture);
        }
    }

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
    protected function runComposerEcsCommand(bool $fix = false): bool
    {
        $command = $fix ? "ecsf-tmp" : "ecs-tmp";
        $result = 0;
        $output = null;

        exec("./vendor/bin/composer " . $command . " 2> /dev/null", $output, $result);

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
