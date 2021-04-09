<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Configuration\Defaults;

use Blumilk\Codestyle\Configuration\SkippedRules;
use PhpCsFixer\Fixer\ClassNotation\ClassAttributesSeparationFixer;
use PhpCsFixer\Fixer\Operator\NotOperatorWithSuccessorSpaceFixer;
use PhpCsFixer\Fixer\ReturnNotation\ReturnAssignmentFixer;
use PhpCsFixer\Fixer\StringNotation\SingleQuoteFixer;

class CommonSkippedRules extends Rules implements SkippedRules
{
    protected array $rules = [
        SingleQuoteFixer::class => null,
        ClassAttributesSeparationFixer::class => null,
        NotOperatorWithSuccessorSpaceFixer::class => null,
        ReturnAssignmentFixer::class => null,
    ];
}
