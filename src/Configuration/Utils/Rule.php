<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Configuration\Utils;

class Rule
{
    protected string $fixer;
    protected ?array $options;

    public function __construct(string $fixer, ?array $options = null)
    {
        $this->fixer = $fixer;
        $this->options = $options;
    }

    public function getFixerClassName(): string
    {
        return $this->fixer;
    }

    public function getOptions(): ?array
    {
        return $this->options;
    }
}
