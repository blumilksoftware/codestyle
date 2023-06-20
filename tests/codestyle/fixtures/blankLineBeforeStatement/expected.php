<?php

declare(strict_types=1);

class BlankLine
{
    /**
     * @throws Exception
     */
    public function getFoo(int $foo): int
    {
        $bar = $foo;

        try {
            while ($bar > 0) {
                $bar++;
            }

            for ($i = 0; $i < 5; $i++) {
                echo $i;
            }
        } catch (Exception $exception) {
            $value = "error";

            throw new Exception(message: $value);
        }

        return $bar;
    }

    protected function getBar(int $number): void
    {
        if ($number === 1) {
            return;
        }
    }
}
