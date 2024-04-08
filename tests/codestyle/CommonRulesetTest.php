<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Tests;

use Exception;

class CommonRulesetTest extends CodestyleTestCase
{
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
            ["blankLineBeforeStatement"],
            ["braces"],
            ["stringVariables"],
            ["lowercaseKeywords"],
            ["noMultilineWhitespaceAroundDoubleArrow"],
            ["compactArray"],
            ["classesImport"],
            ["namedParameters"],
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
}
