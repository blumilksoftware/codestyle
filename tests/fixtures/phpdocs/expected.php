<?php

declare(strict_types=1);

class Stub
{
    protected int $i = 0;

    public function fly(): void
    {
    }

    public function add(int $i): void
    {
        $this->i = $this->i + $i;
    }

    /**
     * @param int $i
     */
    public function remove($i): void
    {
        $this->i = $this->i - $i;
    }
}
