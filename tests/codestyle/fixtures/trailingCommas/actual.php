<?php

class TrailingCommasExample
{
    public function testArguments(): string
    {
        return $this->testParameters(
            "a",
            "b"
        );
    }

    public function testParameters(
        string $a,
        string $b
    ): string {
        return "${a}-${b}";
    }

    public function testArrays(): array
    {
        return [
            1,
            2,
            3
        ];
    }

    public function testMatchCase(int $integer): int
    {
        return match($integer) {
            1 => 2,
            2 => 4,
            default => null
        };
    }
}
