<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Configuration;

interface SkippedRules
{
    public function get(): array;
}
