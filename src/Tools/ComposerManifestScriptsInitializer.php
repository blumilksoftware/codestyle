<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Tools;

class ComposerManifestScriptsInitializer
{
    public function run(string $root): void
    {
        $composerManifestFile = "{$root}/composer.json";

        $hasComposerFileChanged = false;
        $composer = json_decode(file_get_contents($composerManifestFile), associative: true);
        $scripts = [
            "cs" => "./vendor/bin/php-cs-fixer fix --dry-run --diff --config codestyle.php",
            "csf" => "./vendor/bin/php-cs-fixer fix --diff --config codestyle.php",
        ];

        foreach ($scripts as $command => $script) {
            if (isset($composer["scripts"][$command])) {
                fwrite(STDOUT, "Script {$command} is already declared.\n");
            } else {
                $composer["scripts"][$command] = $script;
                fwrite(STDOUT, "Script {$command} has been added to composer.json file.\n");
                $hasComposerFileChanged = true;
            }
        }

        if ($hasComposerFileChanged) {
            $content = json_encode($composer, flags: JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            $content = str_replace("    ", "  ", $content);
            file_put_contents($composerManifestFile, $content);
        }
    }
}
