<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Configuration\Defaults;

use Blumilk\Codestyle\Configuration\SetLists;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

class CommonSetLists implements SetLists
{
    protected array $setLists = [
        SetList::CLEAN_CODE,
        SetList::PSR_12,
        SetList::COMMON,
    ];

    public function get(): array
    {
        return $this->setLists;
    }

    public function add(string ...$setLists): self
    {
        foreach ($setLists as $setList) {
            if (!in_array($setList, $this->setLists, true)) {
                $this->setLists[] = $setList;
            }
        }

        return $this;
    }

    public function clear(): self
    {
        $this->setLists = [];

        return $this;
    }

    public function filter(string ...$setLists): self
    {
        foreach ($this->setLists as $index => $setList) {
            if (in_array($setList, $setLists, true)) {
                unset($this->setLists[$index]);
            }
        }

        $this->setLists = array_values($this->setLists);

        return $this;
    }
}
