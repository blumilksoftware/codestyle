<?php

declare(strict_types=1);

use Blumilk\Codestyle\Config;
use Blumilk\Codestyle\Configuration\Defaults\CommonSkippedRules;
use Blumilk\Codestyle\Configuration\Utils\Rule;
use Blumilk\Codestyle\Fixers\DoubleQuoteFixer;
use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use PhpCsFixer\Fixer\ArrayNotation\NoWhitespaceBeforeCommaInArrayFixer;
use PHPUnit\Framework\TestCase;

class SkippedRulesConfigurationTest extends TestCase
{
    public function testSkippedRulesConfiguration(): void
    {
        $skipped = new class() extends CommonSkippedRules {
            protected array $rules = [
                DoubleQuoteFixer::class => null,
            ];
        };

        $config = new Config(skipped: $skipped);

        $this->assertSame(
            [
                "Blumilk/double_quote" => true
            ],
            $config->options()["skipped"],
        );
    }

    public function testClearingSkippedRulesConfiguration(): void
    {
        $skipped = new class() extends CommonSkippedRules {
            protected array $rules = [
                DoubleQuoteFixer::class => null,
            ];
        };
        $config = new Config(skipped: $skipped->clear());

        $this->assertSame([], $config->options()["skipped"]);
    }

    public function testFilteringSkippedRulesConfiguration(): void
    {
        $skipped = new class() extends CommonSkippedRules {
            protected array $rules = [
                DoubleQuoteFixer::class => null,
                NoWhitespaceBeforeCommaInArrayFixer::class => true,
            ];
        };

        $config = new Config(skipped: $skipped->filter(NoWhitespaceBeforeCommaInArrayFixer::class));

        $this->assertSame(
            [
                "Blumilk/double_quote" => true
            ],
            $config->options()["skipped"],
        );
    }

    public function testExtendingSkippedRulesConfiguration(): void
    {
        $skipped = new class() extends CommonSkippedRules {
            protected array $rules = [
                DoubleQuoteFixer::class => null,
            ];
        };
        $config = new Config(
            skipped: $skipped->add(new Rule(NoWhitespaceBeforeCommaInArrayFixer::class)),
        );

        $this->assertSame(
            [
                "Blumilk/double_quote" => true,
                "no_whitespace_before_comma_in_array" => true,
            ],
            $config->options()["skipped"],
        );
    }

    public function testExtendingWithOptionsSkippedRulesConfiguration(): void
    {
        $skipped = new class() extends CommonSkippedRules {
            protected array $rules = [
                DoubleQuoteFixer::class => null,
            ];
        };
        $config = new Config(
            skipped: $skipped->add(new Rule(ArraySyntaxFixer::class, ["syntax" => "short"])),
        );

        $this->assertSame(
            [
                "Blumilk/double_quote" => true,
                "array_syntax" => ["syntax" => "short"],
            ],
            $config->options()["skipped"],
        );
    }
}
