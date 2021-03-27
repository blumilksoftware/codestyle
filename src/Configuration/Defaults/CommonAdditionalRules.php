<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Configuration\Defaults;

use Blumilk\Codestyle\Configuration\AdditionalRules;
use Blumilk\Codestyle\Fixers\DoubleQuoteFixer;
use PhpCsFixer\Fixer\CastNotation\CastSpacesFixer;
use PhpCsFixer\Fixer\FunctionNotation\NoSpacesAfterFunctionNameFixer;
use PhpCsFixer\Fixer\FunctionNotation\UseArrowFunctionsFixer;
use PhpCsFixer\Fixer\FunctionNotation\VoidReturnFixer;
use PhpCsFixer\Fixer\Import\FullyQualifiedStrictTypesFixer;
use PhpCsFixer\Fixer\Import\OrderedImportsFixer;
use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;

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
    ];
}
