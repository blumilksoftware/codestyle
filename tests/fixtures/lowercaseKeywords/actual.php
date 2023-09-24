<?php

declare(strict_types=1);

Class LowercaseKeywordsTest Extends ObjectOperatorTest
{
    PUBLIC function test(): int
    {
        Foreach (range(1, 5) as $item) {
            IF ($item > 3) {
                Return 0;
            }
        }

        RETURN 5;
    }

    public function testAnonymousClass(): void
    {
        new Class() EXTENDS LowercaseKeywordsTest {};
    }
}
