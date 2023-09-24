<?php

declare(strict_types=1);

class LowercaseKeywordsTest extends ObjectOperatorTest
{
    public function test(): int
    {
        foreach (range(1, 5) as $item) {
            if ($item > 3) {
                return 0;
            }
        }

        return 5;
    }

    public function testAnonymousClass(): void
    {
        new class() extends LowercaseKeywordsTest {};
    }
}
