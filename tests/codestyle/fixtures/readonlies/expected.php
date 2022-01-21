<?php

declare(strict_types=1);

class ReadonlyThing
{
    protected readonly bool $true;

    public function __construct(
        protected readonly string $string,
        protected readonly ?bool $nullable = null,
        protected readonly ?bool $initializedNullable = null,
    ) {
    }
}
