<?php

class UnionTypesExample
{
    public int|string $something;

    public function do(): void
    {
        $i = 1+1;
        json_encode([$i], JSON_THROW_ON_ERROR|JSON_UNESCAPED_SLASHES);
    }
}
