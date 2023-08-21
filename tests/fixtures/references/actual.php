<?php

declare(strict_types=1);

class ReferencedMethodParameter
{
    protected function test(array & $param): void
    {
    }
}
