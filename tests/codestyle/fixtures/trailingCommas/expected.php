<?php

declare(strict_types=1);

class TrailingCommasExample
{
    public function testArguments(): string
    {
        return $this->testParameters(
            "a",
            "b",
        );
    }

    public function testParameters(
        string $a,
        string $b,
    ): string {
        return "${a}-${b}";
    }

    public function testArrays(): array
    {
        return [
            1,
            2,
            3,
        ];
    }

    public function match(int $i): int
    {
        return match ($i) {
            1 => 1,
            2 => 3,
            default => 0,
        };
    }
}
