<?php

declare(strict_types=1);

use Something\Api;
use Something\Paths;
use Whatever\File;
use Whatever\Reader;
use Whatever\SpecificationFile;

use function array_merge;
use function assert;

use const Something\CONSTANT;

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
