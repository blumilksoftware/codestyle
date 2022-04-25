<?php

declare(strict_types=1);

namespace Blumilk\Codestyle;

use Blumilk\Codestyle\Configuration\Defaults\CommonRules;
use Blumilk\Codestyle\Configuration\Defaults\LaravelPaths;
use Blumilk\Codestyle\Configuration\Paths;
use Blumilk\Codestyle\Configuration\Rules;
use Blumilk\Codestyle\Fixers\DoubleQuoteFixer;
use Blumilk\Codestyle\Fixers\NoLaravelMigrationsGeneratedCommentFixer;
use JetBrains\PhpStorm\ArrayShape;
use PhpCsFixer\Config as PhpCsFixerConfig;
use PhpCsFixer\Finder;
use PhpCsFixerCustomFixers\Fixers as PhpCsFixerCustomFixers;

class Config
{
    protected Paths $paths;
    protected Rules $rules;
    protected string $rootPath;

    public function __construct(
        ?Paths $paths = null,
        ?Rules $rules = null,
        ?Rules $rootPath = null,
    ) {
        $this->paths = $paths ?? new LaravelPaths();
        $this->rules = $rules ?? new CommonRules();
        $this->rootPath = $rootPath ?? getcwd();
    }

    public function config(): PhpCsFixerConfig
    {
        list("paths" => $paths, "rules" => $rules) = $this->options();

        $files = [];
        foreach ($paths as $path) {
            $directory = $this->rootPath . "/" . $path;
            $this->getAllFiles($files, $directory);
        }

        $finder = Finder::create()->directories()->append($files);

        $config = new PhpCsFixerConfig("Blumilk codestyle standard");
        return $config->setFinder($finder)
            ->setUsingCache(false)
            ->registerCustomFixers(new PhpCsFixerCustomFixers())
            ->registerCustomFixers($this->getCustomFixers())
            ->setRiskyAllowed(true)
            ->setRules($rules);
    }

    #[ArrayShape(["paths" => "array", "rules" => "array"])]
    public function options(): array
    {
        return [
            "paths" => $this->paths->get(),
            "rules" => $this->rules->get(),
        ];
    }

    protected function getAllFiles(array &$paths, string $path): void
    {
        if (is_file($path) || !is_dir($path)) {
            if (str_ends_with($path, ".php")) {
                $paths[] = $path;
            }
            return;
        }

        $files = array_diff(scandir($path), [".", ".."]);

        foreach ($files as $file) {
            $directory = $path . "/" . $file;
            $this->getAllFiles($paths, $directory);
        }
    }

    protected function getCustomFixers(): array
    {
        return [
            new DoubleQuoteFixer(),
            new NoLaravelMigrationsGeneratedCommentFixer(),
        ];
    }
}
