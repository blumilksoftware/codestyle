<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Configuration\Defaults;

use Blumilk\Codestyle\Configuration\AdditionalRules;
use Blumilk\Codestyle\Fixers\BinaryOperatorSpacesFixer;
use Blumilk\Codestyle\Fixers\DoubleQuoteFixer;
use Blumilk\Codestyle\Fixers\NoSpacesAfterFunctionNameFixer;
use PHP_CodeSniffer\Standards\PSR12\Sniffs\Operators\OperatorSpacingSniff;
use PhpCsFixer\Fixer\CastNotation\CastSpacesFixer;
use PhpCsFixer\Fixer\ControlStructure\TrailingCommaInMultilineFixer;
use PhpCsFixer\Fixer\FunctionNotation\UseArrowFunctionsFixer;
use PhpCsFixer\Fixer\FunctionNotation\VoidReturnFixer;
use PhpCsFixer\Fixer\Import\FullyQualifiedStrictTypesFixer;
use PhpCsFixer\Fixer\Import\OrderedImportsFixer;
use PhpCsFixer\Fixer\Phpdoc\GeneralPhpdocAnnotationRemoveFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocLineSpanFixer;
use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;
use PhpCsFixer\Fixer\Whitespace\NoExtraBlankLinesFixer;

class CommonAdditionalRules extends Rules implements AdditionalRules
{
    protected array $rules = [
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
    ];
}
