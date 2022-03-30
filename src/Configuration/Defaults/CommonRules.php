<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Configuration\Defaults;

use Blumilk\Codestyle\Configuration\Rules as RulesContract;
use Blumilk\Codestyle\Fixers\DoubleQuoteFixer;
use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use PhpCsFixer\Fixer\ArrayNotation\NoTrailingCommaInSinglelineArrayFixer;
use PhpCsFixer\Fixer\ArrayNotation\NoWhitespaceBeforeCommaInArrayFixer;
use PhpCsFixer\Fixer\ArrayNotation\TrimArraySpacesFixer;
use PhpCsFixer\Fixer\ArrayNotation\WhitespaceAfterCommaInArrayFixer;
use PhpCsFixer\Fixer\Casing\LowercaseStaticReferenceFixer;
use PhpCsFixer\Fixer\Casing\MagicConstantCasingFixer;
use PhpCsFixer\Fixer\CastNotation\CastSpacesFixer;
use PhpCsFixer\Fixer\CastNotation\LowercaseCastFixer;
use PhpCsFixer\Fixer\CastNotation\ShortScalarCastFixer;
use PhpCsFixer\Fixer\ClassNotation\ClassDefinitionFixer;
use PhpCsFixer\Fixer\ClassNotation\NoBlankLinesAfterClassOpeningFixer;
use PhpCsFixer\Fixer\ClassNotation\OrderedClassElementsFixer;
use PhpCsFixer\Fixer\ClassNotation\SelfAccessorFixer;
use PhpCsFixer\Fixer\ClassNotation\SingleClassElementPerStatementFixer;
use PhpCsFixer\Fixer\ClassNotation\SingleTraitInsertPerStatementFixer;
use PhpCsFixer\Fixer\ClassNotation\VisibilityRequiredFixer;
use PhpCsFixer\Fixer\Comment\NoTrailingWhitespaceInCommentFixer;
use PhpCsFixer\Fixer\ControlStructure\NoUnneededControlParenthesesFixer;
use PhpCsFixer\Fixer\ControlStructure\NoUnneededCurlyBracesFixer;
use PhpCsFixer\Fixer\ControlStructure\NoUselessElseFixer;
use PhpCsFixer\Fixer\ControlStructure\TrailingCommaInMultilineFixer;
use PhpCsFixer\Fixer\FunctionNotation\FunctionTypehintSpaceFixer;
use PhpCsFixer\Fixer\FunctionNotation\MethodArgumentSpaceFixer;
use PhpCsFixer\Fixer\FunctionNotation\NullableTypeDeclarationForDefaultNullValueFixer;
use PhpCsFixer\Fixer\FunctionNotation\ReturnTypeDeclarationFixer;
use PhpCsFixer\Fixer\FunctionNotation\UseArrowFunctionsFixer;
use PhpCsFixer\Fixer\FunctionNotation\VoidReturnFixer;
use PhpCsFixer\Fixer\Import\FullyQualifiedStrictTypesFixer;
use PhpCsFixer\Fixer\Import\NoLeadingImportSlashFixer;
use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use PhpCsFixer\Fixer\Import\OrderedImportsFixer;
use PhpCsFixer\Fixer\LanguageConstruct\DeclareEqualNormalizeFixer;
use PhpCsFixer\Fixer\LanguageConstruct\ExplicitIndirectVariableFixer;
use PhpCsFixer\Fixer\LanguageConstruct\FunctionToConstantFixer;
use PhpCsFixer\Fixer\LanguageConstruct\IsNullFixer;
use PhpCsFixer\Fixer\NamespaceNotation\CleanNamespaceFixer;
use PhpCsFixer\Fixer\NamespaceNotation\NoLeadingNamespaceWhitespaceFixer;
use PhpCsFixer\Fixer\NamespaceNotation\SingleBlankLineBeforeNamespaceFixer;
use PhpCsFixer\Fixer\Operator\BinaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\ConcatSpaceFixer;
use PhpCsFixer\Fixer\Operator\NewWithBracesFixer;
use PhpCsFixer\Fixer\Operator\StandardizeIncrementFixer;
use PhpCsFixer\Fixer\Operator\TernaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\UnaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Phpdoc\GeneralPhpdocAnnotationRemoveFixer;
use PhpCsFixer\Fixer\Phpdoc\NoEmptyPhpdocFixer;
use PhpCsFixer\Fixer\Phpdoc\NoSuperfluousPhpdocTagsFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocIndentFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocLineSpanFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoEmptyReturnFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocReturnSelfReferenceFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocSingleLineVarSpacingFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocTrimConsecutiveBlankLineSeparationFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocTrimFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocTypesFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocVarWithoutNameFixer;
use PhpCsFixer\Fixer\PhpTag\BlankLineAfterOpeningTagFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitMethodCasingFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitSetUpTearDownVisibilityFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitTestAnnotationFixer;
use PhpCsFixer\Fixer\Semicolon\NoEmptyStatementFixer;
use PhpCsFixer\Fixer\Semicolon\NoSinglelineWhitespaceBeforeSemicolonsFixer;
use PhpCsFixer\Fixer\Semicolon\SpaceAfterSemicolonFixer;
use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;
use PhpCsFixer\Fixer\Strict\StrictComparisonFixer;
use PhpCsFixer\Fixer\Strict\StrictParamFixer;
use PhpCsFixer\Fixer\StringNotation\ExplicitStringVariableFixer;
use PhpCsFixer\Fixer\Whitespace\ArrayIndentationFixer;
use PhpCsFixer\Fixer\Whitespace\CompactNullableTypehintFixer;
use PhpCsFixer\Fixer\Whitespace\MethodChainingIndentationFixer;
use PhpCsFixer\Fixer\Whitespace\NoExtraBlankLinesFixer;
use PhpCsFixer\Fixer\Whitespace\NoSpacesAroundOffsetFixer;
use PhpCsFixer\Fixer\Whitespace\NoWhitespaceInBlankLineFixer;
use PhpCsFixerCustomFixers\Fixer\ConstructorEmptyBracesFixer;
use PhpCsFixerCustomFixers\Fixer\MultilinePromotedPropertiesFixer;
use PhpCsFixerCustomFixers\Fixer\NoUselessCommentFixer;
use PhpCsFixerCustomFixers\Fixer\PhpdocArrayStyleFixer;
use PhpCsFixerCustomFixers\Fixer\PromotedConstructorPropertyFixer;
use PhpCsFixerCustomFixers\Fixer\SingleSpaceAfterStatementFixer;
use PhpCsFixerCustomFixers\Fixer\SingleSpaceBeforeStatementFixer;
use PhpCsFixerCustomFixers\Fixer\StringableInterfaceFixer;

class CommonRules extends Rules implements RulesContract
{
    protected array $rules = [
        NoWhitespaceBeforeCommaInArrayFixer::class => true,
        ArrayIndentationFixer::class => true,
        TrimArraySpacesFixer::class => true,
        WhitespaceAfterCommaInArrayFixer::class => true,
        NoTrailingCommaInSinglelineArrayFixer::class => true,
        ArraySyntaxFixer::class => ["syntax" => "short"],
        PhpUnitMethodCasingFixer::class => true,
        FunctionToConstantFixer::class => true,
        ExplicitStringVariableFixer::class => true,
        ExplicitIndirectVariableFixer::class => true,
        SingleClassElementPerStatementFixer::class => ["elements" => ["const", "property"]],
        NewWithBracesFixer::class => true,
        ClassDefinitionFixer::class => ["single_line" => true],
        StandardizeIncrementFixer::class => true,
        SelfAccessorFixer::class => true,
        MagicConstantCasingFixer::class => true,
        NoUselessElseFixer::class => true,
        OrderedClassElementsFixer::class => true,
        NoTrailingWhitespaceInCommentFixer::class => true,
        PhpdocTrimConsecutiveBlankLineSeparationFixer::class => true,
        PhpdocTrimFixer::class => true,
        NoEmptyPhpdocFixer::class => true,
        PhpdocNoEmptyReturnFixer::class => true,
        PhpdocIndentFixer::class => true,
        PhpdocTypesFixer::class => true,
        PhpdocReturnSelfReferenceFixer::class => true,
        PhpdocVarWithoutNameFixer::class => true,
        NoSuperfluousPhpdocTagsFixer::class => ["remove_inheritdoc" => true, "allow_mixed" => true],
        SingleBlankLineBeforeNamespaceFixer::class => true,
        PhpUnitTestAnnotationFixer::class => true,
        PhpUnitSetUpTearDownVisibilityFixer::class => true,
        BlankLineAfterOpeningTagFixer::class => true,
        MethodChainingIndentationFixer::class => true,
        ConcatSpaceFixer::class => ["spacing" => "one"],
        BinaryOperatorSpacesFixer::class => ["operators" => ["=>" => "single_space", "=" => "single_space", "&" => "no_space"]],
        SingleTraitInsertPerStatementFixer::class => true,
        FunctionTypehintSpaceFixer::class => true,
        NoBlankLinesAfterClassOpeningFixer::class => true,
        NoSinglelineWhitespaceBeforeSemicolonsFixer::class => true,
        PhpdocSingleLineVarSpacingFixer::class => true,
        NoLeadingNamespaceWhitespaceFixer::class => true,
        NoSpacesAroundOffsetFixer::class => true,
        NoWhitespaceInBlankLineFixer::class => true,
        ReturnTypeDeclarationFixer::class => true,
        SpaceAfterSemicolonFixer::class => true,
        TernaryOperatorSpacesFixer::class => true,
        MethodArgumentSpaceFixer::class => true,
        StrictComparisonFixer::class => true,
        IsNullFixer::class => true,
        StrictParamFixer::class => true,
        NoUnusedImportsFixer::class => null,
        NoEmptyStatementFixer::class => null,
        NoUnneededControlParenthesesFixer::class => null,
        NoUnneededCurlyBracesFixer::class => null,
        DeclareStrictTypesFixer::class => null,
        CastSpacesFixer::class => [
            "space" => "none",
        ],
        DoubleQuoteFixer::class => null,
        VoidReturnFixer::class => null,
        UseArrowFunctionsFixer::class => null,
        FullyQualifiedStrictTypesFixer::class => null,
        OrderedImportsFixer::class => null,
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
        VisibilityRequiredFixer::class => null,
        NoLeadingImportSlashFixer::class => null,
        LowercaseCastFixer::class => null,
        LowercaseStaticReferenceFixer::class => null,
        CompactNullableTypehintFixer::class => null,
        DeclareEqualNormalizeFixer::class => null,
        ShortScalarCastFixer::class => null,
        CleanNamespaceFixer::class => null,
        UnaryOperatorSpacesFixer::class => null,
    ];
}