<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Configuration\Defaults;

use Blumilk\Codestyle\Fixers\ClassKeywordFixer;
use Blumilk\Codestyle\Fixers\CompactEmptyArrayFixer;
use Blumilk\Codestyle\Fixers\DoubleQuoteFixer;
use Blumilk\Codestyle\Fixers\NamedArgumentFixer;
use Blumilk\Codestyle\Fixers\NoLaravelMigrationsGeneratedCommentFixer;
use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use PhpCsFixer\Fixer\ArrayNotation\NoMultilineWhitespaceAroundDoubleArrowFixer;
use PhpCsFixer\Fixer\ArrayNotation\NoWhitespaceBeforeCommaInArrayFixer;
use PhpCsFixer\Fixer\ArrayNotation\TrimArraySpacesFixer;
use PhpCsFixer\Fixer\ArrayNotation\WhitespaceAfterCommaInArrayFixer;
use PhpCsFixer\Fixer\Basic\BracesPositionFixer;
use PhpCsFixer\Fixer\Basic\NoMultipleStatementsPerLineFixer;
use PhpCsFixer\Fixer\Basic\NoTrailingCommaInSinglelineFixer;
use PhpCsFixer\Fixer\Basic\PsrAutoloadingFixer;
use PhpCsFixer\Fixer\Casing\ConstantCaseFixer;
use PhpCsFixer\Fixer\Casing\LowercaseKeywordsFixer;
use PhpCsFixer\Fixer\Casing\LowercaseStaticReferenceFixer;
use PhpCsFixer\Fixer\Casing\MagicConstantCasingFixer;
use PhpCsFixer\Fixer\Casing\MagicMethodCasingFixer;
use PhpCsFixer\Fixer\Casing\NativeFunctionCasingFixer;
use PhpCsFixer\Fixer\CastNotation\CastSpacesFixer;
use PhpCsFixer\Fixer\CastNotation\LowercaseCastFixer;
use PhpCsFixer\Fixer\CastNotation\ShortScalarCastFixer;
use PhpCsFixer\Fixer\ClassNotation\ClassAttributesSeparationFixer;
use PhpCsFixer\Fixer\ClassNotation\ClassDefinitionFixer;
use PhpCsFixer\Fixer\ClassNotation\NoBlankLinesAfterClassOpeningFixer;
use PhpCsFixer\Fixer\ClassNotation\OrderedClassElementsFixer;
use PhpCsFixer\Fixer\ClassNotation\SelfAccessorFixer;
use PhpCsFixer\Fixer\ClassNotation\SingleClassElementPerStatementFixer;
use PhpCsFixer\Fixer\ClassNotation\SingleTraitInsertPerStatementFixer;
use PhpCsFixer\Fixer\ClassNotation\VisibilityRequiredFixer;
use PhpCsFixer\Fixer\Comment\NoEmptyCommentFixer;
use PhpCsFixer\Fixer\Comment\NoTrailingWhitespaceInCommentFixer;
use PhpCsFixer\Fixer\Comment\SingleLineCommentSpacingFixer;
use PhpCsFixer\Fixer\ControlStructure\ControlStructureBracesFixer;
use PhpCsFixer\Fixer\ControlStructure\ControlStructureContinuationPositionFixer;
use PhpCsFixer\Fixer\ControlStructure\NoUnneededBracesFixer;
use PhpCsFixer\Fixer\ControlStructure\NoUnneededControlParenthesesFixer;
use PhpCsFixer\Fixer\ControlStructure\NoUselessElseFixer;
use PhpCsFixer\Fixer\ControlStructure\TrailingCommaInMultilineFixer;
use PhpCsFixer\Fixer\ControlStructure\YodaStyleFixer;
use PhpCsFixer\Fixer\FunctionNotation\FunctionDeclarationFixer;
use PhpCsFixer\Fixer\FunctionNotation\LambdaNotUsedImportFixer;
use PhpCsFixer\Fixer\FunctionNotation\MethodArgumentSpaceFixer;
use PhpCsFixer\Fixer\FunctionNotation\NullableTypeDeclarationForDefaultNullValueFixer;
use PhpCsFixer\Fixer\FunctionNotation\ReturnTypeDeclarationFixer;
use PhpCsFixer\Fixer\FunctionNotation\UseArrowFunctionsFixer;
use PhpCsFixer\Fixer\FunctionNotation\VoidReturnFixer;
use PhpCsFixer\Fixer\Import\FullyQualifiedStrictTypesFixer;
use PhpCsFixer\Fixer\Import\NoLeadingImportSlashFixer;
use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use PhpCsFixer\Fixer\Import\OrderedImportsFixer;
use PhpCsFixer\Fixer\Import\SingleLineAfterImportsFixer;
use PhpCsFixer\Fixer\LanguageConstruct\DeclareEqualNormalizeFixer;
use PhpCsFixer\Fixer\LanguageConstruct\ExplicitIndirectVariableFixer;
use PhpCsFixer\Fixer\LanguageConstruct\FunctionToConstantFixer;
use PhpCsFixer\Fixer\LanguageConstruct\IsNullFixer;
use PhpCsFixer\Fixer\NamespaceNotation\BlankLineAfterNamespaceFixer;
use PhpCsFixer\Fixer\NamespaceNotation\BlankLinesBeforeNamespaceFixer;
use PhpCsFixer\Fixer\NamespaceNotation\CleanNamespaceFixer;
use PhpCsFixer\Fixer\NamespaceNotation\NoLeadingNamespaceWhitespaceFixer;
use PhpCsFixer\Fixer\Naming\NoHomoglyphNamesFixer;
use PhpCsFixer\Fixer\Operator\AssignNullCoalescingToCoalesceEqualFixer;
use PhpCsFixer\Fixer\Operator\BinaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\ConcatSpaceFixer;
use PhpCsFixer\Fixer\Operator\NewWithParenthesesFixer;
use PhpCsFixer\Fixer\Operator\NoUselessNullsafeOperatorFixer;
use PhpCsFixer\Fixer\Operator\ObjectOperatorWithoutWhitespaceFixer;
use PhpCsFixer\Fixer\Operator\StandardizeIncrementFixer;
use PhpCsFixer\Fixer\Operator\TernaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\UnaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Phpdoc\GeneralPhpdocAnnotationRemoveFixer;
use PhpCsFixer\Fixer\Phpdoc\NoBlankLinesAfterPhpdocFixer;
use PhpCsFixer\Fixer\Phpdoc\NoEmptyPhpdocFixer;
use PhpCsFixer\Fixer\Phpdoc\NoSuperfluousPhpdocTagsFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocAlignFixer;
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
use PhpCsFixer\Fixer\PhpUnit\PhpUnitAttributesFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitMethodCasingFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitSetUpTearDownVisibilityFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitTestAnnotationFixer;
use PhpCsFixer\Fixer\ReturnNotation\NoUselessReturnFixer;
use PhpCsFixer\Fixer\ReturnNotation\SimplifiedNullReturnFixer;
use PhpCsFixer\Fixer\Semicolon\MultilineWhitespaceBeforeSemicolonsFixer;
use PhpCsFixer\Fixer\Semicolon\NoEmptyStatementFixer;
use PhpCsFixer\Fixer\Semicolon\NoSinglelineWhitespaceBeforeSemicolonsFixer;
use PhpCsFixer\Fixer\Semicolon\SpaceAfterSemicolonFixer;
use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;
use PhpCsFixer\Fixer\Strict\StrictComparisonFixer;
use PhpCsFixer\Fixer\Strict\StrictParamFixer;
use PhpCsFixer\Fixer\StringNotation\SimpleToComplexStringVariableFixer;
use PhpCsFixer\Fixer\Whitespace\ArrayIndentationFixer;
use PhpCsFixer\Fixer\Whitespace\BlankLineBeforeStatementFixer;
use PhpCsFixer\Fixer\Whitespace\BlankLineBetweenImportGroupsFixer;
use PhpCsFixer\Fixer\Whitespace\CompactNullableTypeDeclarationFixer;
use PhpCsFixer\Fixer\Whitespace\LineEndingFixer;
use PhpCsFixer\Fixer\Whitespace\MethodChainingIndentationFixer;
use PhpCsFixer\Fixer\Whitespace\NoExtraBlankLinesFixer;
use PhpCsFixer\Fixer\Whitespace\NoSpacesAroundOffsetFixer;
use PhpCsFixer\Fixer\Whitespace\NoWhitespaceInBlankLineFixer;
use PhpCsFixer\Fixer\Whitespace\SingleBlankLineAtEofFixer;
use PhpCsFixer\Fixer\Whitespace\SpacesInsideParenthesesFixer;
use PhpCsFixer\Fixer\Whitespace\StatementIndentationFixer;
use PhpCsFixer\Fixer\Whitespace\TypeDeclarationSpacesFixer;
use PhpCsFixerCustomFixers\Fixer\CommentedOutFunctionFixer;
use PhpCsFixerCustomFixers\Fixer\ConstructorEmptyBracesFixer;
use PhpCsFixerCustomFixers\Fixer\MultilinePromotedPropertiesFixer;
use PhpCsFixerCustomFixers\Fixer\NoCommentedOutCodeFixer;
use PhpCsFixerCustomFixers\Fixer\NoPhpStormGeneratedCommentFixer;
use PhpCsFixerCustomFixers\Fixer\NoUselessCommentFixer;
use PhpCsFixerCustomFixers\Fixer\NoUselessParenthesisFixer;
use PhpCsFixerCustomFixers\Fixer\PhpdocArrayStyleFixer;
use PhpCsFixerCustomFixers\Fixer\PhpdocNoIncorrectVarAnnotationFixer;
use PhpCsFixerCustomFixers\Fixer\PhpdocNoSuperfluousParamFixer;
use PhpCsFixerCustomFixers\Fixer\PromotedConstructorPropertyFixer;
use PhpCsFixerCustomFixers\Fixer\SingleSpaceAfterStatementFixer;
use PhpCsFixerCustomFixers\Fixer\SingleSpaceBeforeStatementFixer;
use PhpCsFixerCustomFixers\Fixer\StringableInterfaceFixer;

class CommonRules extends Rules
{
    protected array $rules = [
        NoWhitespaceBeforeCommaInArrayFixer::class => true,
        ArrayIndentationFixer::class => true,
        TrimArraySpacesFixer::class => true,
        WhitespaceAfterCommaInArrayFixer::class => true,
        ArraySyntaxFixer::class => [
            "syntax" => "short",
        ],
        PhpUnitMethodCasingFixer::class => true,
        FunctionToConstantFixer::class => true,
        ExplicitIndirectVariableFixer::class => true,
        SingleClassElementPerStatementFixer::class => [
            "elements" => ["const", "property"],
        ],
        NewWithParenthesesFixer::class => true,
        ClassDefinitionFixer::class => [
            "single_line" => true,
        ],
        StandardizeIncrementFixer::class => true,
        SelfAccessorFixer::class => true,
        MagicConstantCasingFixer::class => true,
        NoUselessElseFixer::class => true,
        OrderedClassElementsFixer::class => [
            "order" => [
                "use_trait",
                "case",
                "constant_public",
                "constant_protected",
                "constant_private",
                "property_public_static",
                "property_protected_static",
                "property_private_static",
                "property_public",
                "property_protected",
                "property_private",
                "construct",
                "destruct",
                "magic",
                "phpunit",
                "method_public_static",
                "method_public",
                "method_protected_static",
                "method_protected",
                "method_private_static",
                "method_private",
            ],
        ],
        NoTrailingWhitespaceInCommentFixer::class => true,
        PhpdocTrimConsecutiveBlankLineSeparationFixer::class => true,
        PhpdocTrimFixer::class => true,
        NoEmptyPhpdocFixer::class => true,
        PhpdocNoEmptyReturnFixer::class => true,
        PhpdocIndentFixer::class => true,
        PhpdocTypesFixer::class => true,
        PhpdocReturnSelfReferenceFixer::class => true,
        PhpdocVarWithoutNameFixer::class => true,
        NoSuperfluousPhpdocTagsFixer::class => [
            "remove_inheritdoc" => true,
            "allow_mixed" => true,
        ],
        PhpUnitTestAnnotationFixer::class => true,
        PhpUnitSetUpTearDownVisibilityFixer::class => true,
        BlankLineAfterOpeningTagFixer::class => true,
        MethodChainingIndentationFixer::class => true,
        ConcatSpaceFixer::class => [
            "spacing" => "one",
        ],
        BinaryOperatorSpacesFixer::class => [
            "operators" => [
                "=>" => "single_space",
                "=" => "single_space",
                "&" => "no_space",
            ],
        ],
        SingleTraitInsertPerStatementFixer::class => true,
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
        NoUnusedImportsFixer::class => true,
        NoEmptyStatementFixer::class => true,
        NoUnneededControlParenthesesFixer::class => true,
        NoUnneededBracesFixer::class => true,
        DeclareStrictTypesFixer::class => true,
        CastSpacesFixer::class => [
            "space" => "none",
        ],
        DoubleQuoteFixer::class => true,
        VoidReturnFixer::class => true,
        UseArrowFunctionsFixer::class => true,
        FullyQualifiedStrictTypesFixer::class => [
            "import_symbols" => true,
        ],
        OrderedImportsFixer::class => [
            "sort_algorithm" => "alpha",
            "imports_order" => ["class", "function", "const"],
        ],
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
                "attribute",
                "break",
                "case",
                "continue",
                "curly_brace_block",
                "default",
                "extra",
                "parenthesis_brace_block",
                "return",
                "square_brace_block",
                "switch",
                "throw",
                "use",
            ],
        ],
        TrailingCommaInMultilineFixer::class => [
            "elements" => [
                "arrays",
                "parameters",
                "arguments",
                "match",
            ],
        ],
        NullableTypeDeclarationForDefaultNullValueFixer::class => true,
        ConstructorEmptyBracesFixer::class => true,
        MultilinePromotedPropertiesFixer::class => true,
        NoUselessCommentFixer::class => true,
        PhpdocArrayStyleFixer::class => true,
        PromotedConstructorPropertyFixer::class => true,
        SingleSpaceAfterStatementFixer::class => true,
        SingleSpaceBeforeStatementFixer::class => true,
        StringableInterfaceFixer::class => true,
        VisibilityRequiredFixer::class => true,
        NoLeadingImportSlashFixer::class => true,
        LowercaseCastFixer::class => true,
        LowercaseStaticReferenceFixer::class => true,
        CompactNullableTypeDeclarationFixer::class => true,
        DeclareEqualNormalizeFixer::class => true,
        ShortScalarCastFixer::class => true,
        CleanNamespaceFixer::class => true,
        UnaryOperatorSpacesFixer::class => true,
        ClassAttributesSeparationFixer::class => [
            "elements" => [
                "property" => "none",
                "const" => "none",
                "method" => "one",
                "trait_import" => "none",
                "case" => "none",
            ],
        ],
        NoUselessParenthesisFixer::class => true,
        SingleBlankLineAtEofFixer::class => true,
        NoLaravelMigrationsGeneratedCommentFixer::class => true,
        CommentedOutFunctionFixer::class => [
            "functions" => ["print_r", "var_dump", "var_export", "dd"],
        ],
        NoCommentedOutCodeFixer::class => true,
        NoPhpStormGeneratedCommentFixer::class => true,
        PhpdocNoIncorrectVarAnnotationFixer::class => true,
        PhpdocNoSuperfluousParamFixer::class => true,
        YodaStyleFixer::class => [
            "equal" => false,
            "identical" => false,
            "less_and_greater" => false,
        ],
        ObjectOperatorWithoutWhitespaceFixer::class => true,
        FunctionDeclarationFixer::class => [
            "closure_function_spacing" => "none",
            "closure_fn_spacing" => "none",
        ],
        SingleLineAfterImportsFixer::class => true,
        SingleLineCommentSpacingFixer::class => true,
        BlankLineAfterNamespaceFixer::class => true,
        SimpleToComplexStringVariableFixer::class => true,
        NoEmptyCommentFixer::class => true,
        NoTrailingCommaInSinglelineFixer::class => true,
        MagicMethodCasingFixer::class => true,
        NativeFunctionCasingFixer::class => true,
        LambdaNotUsedImportFixer::class => true,
        NoHomoglyphNamesFixer::class => true,
        AssignNullCoalescingToCoalesceEqualFixer::class => true,
        NoUselessNullsafeOperatorFixer::class => true,
        NoUselessReturnFixer::class => true,
        SimplifiedNullReturnFixer::class => true,
        MultilineWhitespaceBeforeSemicolonsFixer::class => true,
        LineEndingFixer::class => true,
        StatementIndentationFixer::class => true,
        BlankLineBetweenImportGroupsFixer::class => true,
        BlankLineBeforeStatementFixer::class => [
            "statements" => [
                "break",
                "continue",
                "declare",
                "return",
                "throw",
                "try",
                "if",
                "do",
                "for",
                "foreach",
                "while",
            ],
        ],
        NoMultipleStatementsPerLineFixer::class => true,
        BlankLinesBeforeNamespaceFixer::class => true,
        PsrAutoloadingFixer::class => true,
        TypeDeclarationSpacesFixer::class => true,
        ControlStructureBracesFixer::class => true,
        ControlStructureContinuationPositionFixer::class => true,
        BracesPositionFixer::class => [
            "anonymous_functions_opening_brace" => "same_line",
        ],
        LowercaseKeywordsFixer::class => true,
        NoMultilineWhitespaceAroundDoubleArrowFixer::class => true,
        CompactEmptyArrayFixer::class => true,
        ClassKeywordFixer::class => true,
        NamedArgumentFixer::class => true,
        NoBlankLinesAfterPhpdocFixer::class => true,
        ConstantCaseFixer::class => true,
        PhpUnitAttributesFixer::class => true,
        SpacesInsideParenthesesFixer::class => true,
        PhpdocAlignFixer::class => ["align" => "left"],
    ];
}
