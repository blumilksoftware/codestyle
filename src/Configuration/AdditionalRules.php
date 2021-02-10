<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Configuration;

interface AdditionalRules
{
    public function get(): array;
}
