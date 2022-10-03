<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Tools;

class CodestyleFileInitializer
{
    public function run(string $root, string $filename = "codestyle.php"): void
    {
        $codestyleFilePath = "{$root}/{$filename}";

        if (file_exists($codestyleFilePath)) {
            fwrite(STDERR, "File codestyle.php already exists.\n");
        } else {
            copy(__DIR__ . "/../../bin/codestyle.stub", $codestyleFilePath);
            fwrite(STDOUT, "File codestyle.php has been created.\n");
        }
    }
}
