<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Configuration;

interface Rules
{
    public function get(): array;
}
