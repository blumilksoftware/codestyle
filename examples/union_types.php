<?php

declare(strict_types=1);

class Whatever
{
    public int|string $something;

    /**
     * @throws JsonException
     */
    public function do(): void
    {
        $i = 1 + 1;
        json_encode([$i], JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES);
    }
}
