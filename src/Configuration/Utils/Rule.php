<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Configuration\Utils;

class Rule
{
    public function __construct(
        protected string $fixer,
        protected ?array $options = null,
    ) {}

    public function getFixerClassName(): string
    {
        return $this->fixer;
    }

    public function getOptions(): ?array
    {
        return $this->options;
    }
}
