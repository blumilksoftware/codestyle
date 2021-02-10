<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Configuration\Defaults;

use Blumilk\Codestyle\Configuration\AdditionalRules;
use Blumilk\Codestyle\Fixers\DoubleQuoteFixer;
use PhpCsFixer\Fixer\CastNotation\CastSpacesFixer;
use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;

class CommonAdditionalRules implements AdditionalRules
{
    protected array $rules = [
        DeclareStrictTypesFixer::class => null,
        CastSpacesFixer::class => [
            "space" => "none",
        ],
        DoubleQuoteFixer::class => null,
    ];

    public function get(): array
    {
        return $this->rules;
    }
}
