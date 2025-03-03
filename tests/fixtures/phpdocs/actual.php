<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 01.01.70
 * Time: 12:00
 */

declare(strict_types=1);

/**
 * @author John Kowalski
 */
class Stub
{
    protected int $i = 0;

    public function fly(): void
    {
        // $this->changePosition();
        dd($this);
    }

    /**
     * @param int $i
     * @param int $j
     */
    public function add(int $i): void
    {
        $this->i = $this->i + $i;
    }

    /**
     * @param  int  $i
     */
    public function remove($i): void
    {
        $this->i = $this->i - $i;
    }
}
