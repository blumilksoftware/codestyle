<?php

declare(strict_types=1);

use Blumilk\Codestyle\Config;
use Blumilk\Codestyle\Configuration\Defaults\CommonRules;
use Blumilk\Codestyle\Configuration\Utils\Rule;
use Blumilk\Codestyle\Fixers\BinaryOperatorSpacesFixer;
use Blumilk\Codestyle\Fixers\DoubleQuoteFixer;
use Blumilk\Codestyle\Fixers\NoSpacesAfterFunctionNameFixer;
use PHP_CodeSniffer\Standards\PSR12\Sniffs\Operators\OperatorSpacingSniff;
use PhpCsFixer\Fixer\Alias\NoMixedEchoPrintFixer;
use PhpCsFixer\Fixer\CastNotation\CastSpacesFixer;
use PhpCsFixer\Fixer\ControlStructure\TrailingCommaInMultilineFixer;
use PhpCsFixer\Fixer\FunctionNotation\NullableTypeDeclarationForDefaultNullValueFixer;
use PhpCsFixer\Fixer\FunctionNotation\UseArrowFunctionsFixer;
use PhpCsFixer\Fixer\FunctionNotation\VoidReturnFixer;
use PhpCsFixer\Fixer\Import\FullyQualifiedStrictTypesFixer;
use PhpCsFixer\Fixer\Import\OrderedImportsFixer;
use PhpCsFixer\Fixer\Phpdoc\GeneralPhpdocAnnotationRemoveFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocLineSpanFixer;
use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;
use PhpCsFixer\Fixer\StringNotation\HeredocToNowdocFixer;
use PhpCsFixer\Fixer\Whitespace\NoExtraBlankLinesFixer;
use PhpCsFixerCustomFixers\Fixer\ConstructorEmptyBracesFixer;
use PhpCsFixerCustomFixers\Fixer\MultilinePromotedPropertiesFixer;
use PhpCsFixerCustomFixers\Fixer\NoUselessCommentFixer;
use PhpCsFixerCustomFixers\Fixer\PhpdocArrayStyleFixer;
use PhpCsFixerCustomFixers\Fixer\PromotedConstructorPropertyFixer;
use PhpCsFixerCustomFixers\Fixer\SingleSpaceAfterStatementFixer;
use PhpCsFixerCustomFixers\Fixer\SingleSpaceBeforeStatementFixer;
use PhpCsFixerCustomFixers\Fixer\StringableInterfaceFixer;
use PHPUnit\Framework\TestCase;

class AdditionalRulesConfigurationTest extends TestCase
{
    public function testAdditionalRulesConfiguration(): void
    {
        $rules = new CommonRules();
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
                NoExtraBlankLinesFixer::class => [
                    "tokens" => [
                        "extra",
                        "curly_brace_block",
                        "parenthesis_brace_block",
                        "square_brace_block",
                    ],
                ],
                OperatorSpacingSniff::class => null,
                TrailingCommaInMultilineFixer::class => [
                    "elements" => [
                        "arrays",
                        "parameters",
                        "arguments",
                    ],
                ],
                NullableTypeDeclarationForDefaultNullValueFixer::class => null,
                ConstructorEmptyBracesFixer::class => null,
                MultilinePromotedPropertiesFixer::class => null,
                NoUselessCommentFixer::class => null,
                PhpdocArrayStyleFixer::class => null,
                PromotedConstructorPropertyFixer::class => null,
                SingleSpaceAfterStatementFixer::class => null,
                SingleSpaceBeforeStatementFixer::class => null,
                StringableInterfaceFixer::class => null,
            ],
            $config->options()["rules"],
        );
    }

    public function testClearingAdditionalRulesConfiguration(): void
    {
        $rules = new CommonRules();
        $config = new Config(rules: $rules->clear());

        $this->assertSame([], $config->options()["rules"]);
    }

    public function testFilteringAdditionalRulesConfiguration(): void
    {
        $rules = new CommonRules();
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
                NoExtraBlankLinesFixer::class => [
                    "tokens" => [
                        "extra",
                        "curly_brace_block",
                        "parenthesis_brace_block",
                        "square_brace_block",
                    ],
                ],
                OperatorSpacingSniff::class => null,
                TrailingCommaInMultilineFixer::class => [
                    "elements" => [
                        "arrays",
                        "parameters",
                        "arguments",
                    ],
                ],
                NullableTypeDeclarationForDefaultNullValueFixer::class => null,
                ConstructorEmptyBracesFixer::class => null,
                MultilinePromotedPropertiesFixer::class => null,
                NoUselessCommentFixer::class => null,
                PhpdocArrayStyleFixer::class => null,
                PromotedConstructorPropertyFixer::class => null,
                SingleSpaceAfterStatementFixer::class => null,
                SingleSpaceBeforeStatementFixer::class => null,
                StringableInterfaceFixer::class => null,
            ],
            $config->options()["rules"],
        );
    }

    public function testExtendingAdditionalRulesConfiguration(): void
    {
        $rules = new CommonRules();
        $config = new Config(
            rules: $rules->add(new Rule(HeredocToNowdocFixer::class)),
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
                NoExtraBlankLinesFixer::class => [
                    "tokens" => [
                        "extra",
                        "curly_brace_block",
                        "parenthesis_brace_block",
                        "square_brace_block",
                    ],
                ],
                OperatorSpacingSniff::class => null,
                TrailingCommaInMultilineFixer::class => [
                    "elements" => [
                        "arrays",
                        "parameters",
                        "arguments",
                    ],
                ],
                NullableTypeDeclarationForDefaultNullValueFixer::class => null,
                ConstructorEmptyBracesFixer::class => null,
                MultilinePromotedPropertiesFixer::class => null,
                NoUselessCommentFixer::class => null,
                PhpdocArrayStyleFixer::class => null,
                PromotedConstructorPropertyFixer::class => null,
                SingleSpaceAfterStatementFixer::class => null,
                SingleSpaceBeforeStatementFixer::class => null,
                StringableInterfaceFixer::class => null,
                HeredocToNowdocFixer::class => null,
            ],
            $config->options()["rules"],
        );
    }

    public function testExtendingWithOptionsAdditionalRulesConfiguration(): void
    {
        $rules = new CommonRules();
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
                NoExtraBlankLinesFixer::class => [
                    "tokens" => [
                        "extra",
                        "curly_brace_block",
                        "parenthesis_brace_block",
                        "square_brace_block",
                    ],
                ],
                OperatorSpacingSniff::class => null,
                TrailingCommaInMultilineFixer::class => [
                    "elements" => [
                        "arrays",
                        "parameters",
                        "arguments",
                    ],
                ],
                NullableTypeDeclarationForDefaultNullValueFixer::class => null,
                ConstructorEmptyBracesFixer::class => null,
                MultilinePromotedPropertiesFixer::class => null,
                NoUselessCommentFixer::class => null,
                PhpdocArrayStyleFixer::class => null,
                PromotedConstructorPropertyFixer::class => null,
                SingleSpaceAfterStatementFixer::class => null,
                SingleSpaceBeforeStatementFixer::class => null,
                StringableInterfaceFixer::class => null,
                NoMixedEchoPrintFixer::class => [
                    "use" => "echo",
                ],
            ],
            $config->options()["rules"],
        );
    }
}
