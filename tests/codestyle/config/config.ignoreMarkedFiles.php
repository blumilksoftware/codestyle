<?php

declare(strict_types=1);

use Blumilk\Codestyle\Config;
use Blumilk\Codestyle\Configuration\Defaults\CommonRules;
use Blumilk\Codestyle\Configuration\Defaults\Paths;
use PhpCsFixer\Fixer\Basic\PsrAutoloadingFixer;

$paths = new Paths("tests/codestyle/tmp");
$rules = new CommonRules();

$config = new Config(
    paths: $paths,
    rules: $rules->filter(PsrAutoloadingFixer::class),
);

return $config->ignoreMarkedFiles()->config();
