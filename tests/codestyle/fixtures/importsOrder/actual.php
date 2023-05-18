<?php

declare(strict_types=1);

use function array_merge;
use function assert;
use Something\Api;
use Something\Paths;
use const Something\CONSTANT;
use Whatever\File;

use Whatever\SpecificationFile;
use Whatever\Reader;

class Merge
{
    public function do(array $a, array $b): void
    {
        $merge = array_merge($a, $b);

        $reader = new Reader(new SpecificationFile(new File()), new Paths());
        $result = $reader->merge($merge, new Api(), flag: CONSTANT);

        assert($result);
    }
}
