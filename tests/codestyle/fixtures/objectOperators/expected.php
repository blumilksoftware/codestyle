<?php

declare(strict_types=1);

class ObjectOperatorTest
{
    protected array $array = [];
    protected ?int $nullable = null;

    public function get(): void
    {
        $array = $this->array;

        if ($this->nullable) {
            unset($array);
        }
    }
}
