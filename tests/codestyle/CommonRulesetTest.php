<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Tests;

use Exception;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\RequiresPhp;

class CommonRulesetTest extends CodestyleTestCase
{
    /**
     * @throws Exception
     */
    #[DataProvider("providePhp80Fixtures")]
    #[RequiresPhp(">= 8.0")]
    public function testPhp80Fixtures(string $name): void
    {
        $this->testFixture($name);
    }

    /**
     * @throws Exception
     */
    #[DataProvider("providePhp81Fixtures")]
    #[RequiresPhp(">= 8.1")]
    public function testPhp81Fixtures(string $name): void
    {
        $this->testFixture($name);
    }

    /**
     * @throws Exception
     */
    #[DataProvider("providePhp82Fixtures")]
    #[RequiresPhp(">= 8.2")]
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
