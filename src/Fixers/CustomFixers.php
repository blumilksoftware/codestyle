<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Fixers;

use DirectoryIterator;
use Generator;
use IteratorAggregate;

class CustomFixers implements IteratorAggregate
{
    public function getIterator(): Generator
    {
        $classNames = [];
        foreach (new DirectoryIterator(__DIR__) as $fileInfo) {
            $fileName = $fileInfo->getBasename('.php');
            if (in_array($fileName, ['.', '..', "FixerWorkaround", "CustomFixers"], true)) {
                continue;
            }
            $classNames[] = __NAMESPACE__ . '\\' . $fileName;
        };

        foreach ($classNames as $fixer) {
            yield new $fixer();
        }
    }
}
