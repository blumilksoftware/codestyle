<?php

declare(strict_types=1);

use Blumilk\Codestyle\Config;
use Blumilk\Codestyle\Configuration\Defaults\CommonAdditionalRules;
use Blumilk\Codestyle\Configuration\Utils\Rule;
use Blumilk\Codestyle\Fixers\BinaryOperatorSpacesFixer;
use Blumilk\Codestyle\Fixers\DoubleQuoteFixer;
use Blumilk\Codestyle\Fixers\NoSpacesAfterFunctionNameFixer;
use PhpCsFixer\Fixer\Alias\NoMixedEchoPrintFixer;
use PhpCsFixer\Fixer\CastNotation\CastSpacesFixer;
use PhpCsFixer\Fixer\FunctionNotation\UseArrowFunctionsFixer;
use PhpCsFixer\Fixer\FunctionNotation\VoidReturnFixer;
use PhpCsFixer\Fixer\Import\FullyQualifiedStrictTypesFixer;
use PhpCsFixer\Fixer\Import\OrderedImportsFixer;
use PhpCsFixer\Fixer\Phpdoc\GeneralPhpdocAnnotationRemoveFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocLineSpanFixer;
use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;
use PhpCsFixer\Fixer\StringNotation\HeredocToNowdocFixer;
use PhpCsFixer\Fixer\Whitespace\NoExtraBlankLinesFixer;
use PHPUnit\Framework\TestCase;

class AdditionalRulesConfigurationTest extends TestCase
{
    public function testAdditionalRulesConfiguration(): void
    {
        $rules = new CommonAdditionalRules();
        $config = new Config(rules: $rules);

        $this->assertSame(
            [
                DeclareStrictTypesFixer::class => null,
                CastSpacesFixer::class => [
                    "space" => "none",
                ],
                DoubleQuoteFixer::class => null,
                VoidReturnFixer::class => null,
                UseArrowFunctionsFixer::class => null,
                NoSpacesAfterFunctionNameFixer::class => null,
                FullyQualifiedStrictTypesFixer::class => null,
                OrderedImportsFixer::class => null,
                BinaryOperatorSpacesFixer::class => null,
                PhpdocLineSpanFixer::class => [
                    "const" => "single",
                    "property" => "single",
                ],
                GeneralPhpdocAnnotationRemoveFixer::class => [
                    "annotations" => [
                        "package",
                        "author",
                    ],
                ],
                NoExtraBlankLinesFixer::class => null,
            ],
            $config->options()["rules"]
        );
    }

    public function testClearingAdditionalRulesConfiguration(): void
    {
        $rules = new CommonAdditionalRules();
        $config = new Config(rules: $rules->clear());

        $this->assertSame([], $config->options()["rules"]);
    }

    public function testFilteringAdditionalRulesConfiguration(): void
    {
        $rules = new CommonAdditionalRules();
        $config = new Config(rules: $rules->filter(CastSpacesFixer::class));

        $this->assertSame(
            [
                DeclareStrictTypesFixer::class => null,
                DoubleQuoteFixer::class => null,
                VoidReturnFixer::class => null,
                UseArrowFunctionsFixer::class => null,
                NoSpacesAfterFunctionNameFixer::class => null,
                FullyQualifiedStrictTypesFixer::class => null,
                OrderedImportsFixer::class => null,
                BinaryOperatorSpacesFixer::class => null,
                PhpdocLineSpanFixer::class => [
                    "const" => "single",
                    "property" => "single",
                ],
                GeneralPhpdocAnnotationRemoveFixer::class => [
                    "annotations" => [
                        "package",
                        "author",
                    ],
                ],
                NoExtraBlankLinesFixer::class => null,
            ],
            $config->options()["rules"]
        );
    }

    public function testExtendingAdditionalRulesConfiguration(): void
    {
        $rules = new CommonAdditionalRules();
        $config = new Config(
            rules: $rules->add(new Rule(HeredocToNowdocFixer::class))
        );

        $this->assertSame(
            [
                DeclareStrictTypesFixer::class => null,
                CastSpacesFixer::class => [
                    "space" => "none",
                ],
                DoubleQuoteFixer::class => null,
                VoidReturnFixer::class => null,
                UseArrowFunctionsFixer::class => null,
                NoSpacesAfterFunctionNameFixer::class => null,
                FullyQualifiedStrictTypesFixer::class => null,
                OrderedImportsFixer::class => null,
                BinaryOperatorSpacesFixer::class => null,
                PhpdocLineSpanFixer::class => [
                    "const" => "single",
                    "property" => "single",
                ],
                GeneralPhpdocAnnotationRemoveFixer::class => [
                    "annotations" => [
                        "package",
                        "author",
                    ],
                ],
                NoExtraBlankLinesFixer::class => null,
                HeredocToNowdocFixer::class => null,
            ],
            $config->options()["rules"]
        );
    }

    public function testExtendingWithOptionsAdditionalRulesConfiguration(): void
    {
        $rules = new CommonAdditionalRules();
        $rule = new Rule(
            NoMixedEchoPrintFixer::class, [
            "use" => "echo",
        ]
        );

        $config = new Config(
            rules: $rules->add($rule)
        );

        $this->assertSame(
            [
                DeclareStrictTypesFixer::class => null,
                CastSpacesFixer::class => [
                    "space" => "none",
                ],
                DoubleQuoteFixer::class => null,
                VoidReturnFixer::class => null,
                UseArrowFunctionsFixer::class => null,
                NoSpacesAfterFunctionNameFixer::class => null,
                FullyQualifiedStrictTypesFixer::class => null,
                OrderedImportsFixer::class => null,
                BinaryOperatorSpacesFixer::class => null,
                PhpdocLineSpanFixer::class => [
                    "const" => "single",
                    "property" => "single",
                ],
                GeneralPhpdocAnnotationRemoveFixer::class => [
                    "annotations" => [
                        "package",
                        "author",
                    ],
                ],
                NoExtraBlankLinesFixer::class => null,
                NoMixedEchoPrintFixer::class => [
                    "use" => "echo",
                ],
            ],
            $config->options()["rules"]
        );
    }
}
