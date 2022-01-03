<?php

class ReadonlyThing
{
    protected readonly bool $true;

    public function __construct(protected readonly string $string)
    {
    }
}
