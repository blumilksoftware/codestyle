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
}
