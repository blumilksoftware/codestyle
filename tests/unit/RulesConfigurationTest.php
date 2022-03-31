<?php

declare(strict_types=1);

use Blumilk\Codestyle\Config;
use Blumilk\Codestyle\Configuration\Defaults\Rules;
use Blumilk\Codestyle\Configuration\Utils\Rule;
use PhpCsFixer\Fixer\Alias\NoMixedEchoPrintFixer;
use PhpCsFixer\Fixer\ArrayNotation\NoWhitespaceBeforeCommaInArrayFixer;
use PhpCsFixer\Fixer\ArrayNotation\TrimArraySpacesFixer;
use PhpCsFixer\Fixer\Whitespace\ArrayIndentationFixer;
use PHPUnit\Framework\TestCase;

class RulesConfigurationTest extends TestCase
{
    public function testRulesConfiguration(): void
    {
        $rules = new class() extends Rules {
            protected array $rules = [
                NoWhitespaceBeforeCommaInArrayFixer::class => true,
                ArrayIndentationFixer::class => true,
            ];
        };
        $config = new Config(rules: $rules);

        $this->assertSame(
            [
                "no_whitespace_before_comma_in_array" => true,
                "array_indentation" => true,
            ],
            $config->options()["rules"],
        );
    }

    public function testClearingRulesConfiguration(): void
    {
        $rules = new class() extends Rules {
            protected array $rules = [
                NoWhitespaceBeforeCommaInArrayFixer::class => true,
                ArrayIndentationFixer::class => true,
            ];
        };
        $config = new Config(rules: $rules->clear());

        $this->assertSame([], $config->options()["rules"]);
    }

    public function testFilteringRulesConfiguration(): void
    {
        $rules = new class() extends Rules {
            protected array $rules = [
                NoWhitespaceBeforeCommaInArrayFixer::class => true,
                ArrayIndentationFixer::class => true,
            ];
        };
        $config = new Config(rules: $rules->filter(NoWhitespaceBeforeCommaInArrayFixer::class));

        $this->assertSame(
            [
                "array_indentation" => true,
            ],
            $config->options()["rules"],
        );
    }

    public function testExtendingRulesConfiguration(): void
    {
        $rules = new class() extends Rules {
            protected array $rules = [
                NoWhitespaceBeforeCommaInArrayFixer::class => true,
                ArrayIndentationFixer::class => true,
            ];
        };

        $config = new Config(
            rules: $rules->add(new Rule(TrimArraySpacesFixer::class)),
        );

        $this->assertSame(
            [
                "no_whitespace_before_comma_in_array" => true,
                "array_indentation" => true,
                "trim_array_spaces" => true,
            ],
            $config->options()["rules"],
        );
    }

    public function testExtendingWithOptionsRulesConfiguration(): void
    {
        $rules = new class() extends Rules {
            protected array $rules = [
                NoWhitespaceBeforeCommaInArrayFixer::class => true,
                ArrayIndentationFixer::class => true,
            ];
        };
        $rule = new Rule(
            NoMixedEchoPrintFixer::class,
            [
                "use" => "echo",
            ],
        );

        $config = new Config(
            rules: $rules->add($rule),
        );

        $this->assertSame(
            [
                "no_whitespace_before_comma_in_array" => true,
                "array_indentation" => true,
                "no_mixed_echo_print" => [
                    "use" => "echo",
                ],
            ],
            $config->options()["rules"],
        );
    }
}
