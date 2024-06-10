<?php

declare(strict_types=1);

namespace Blumilk\Codestyle;

use Blumilk\Codestyle\Configuration\Defaults\CommonRules;
use Blumilk\Codestyle\Configuration\Defaults\LaravelPaths;
use Blumilk\Codestyle\Configuration\Paths;
use Blumilk\Codestyle\Configuration\Rules;
use Blumilk\Codestyle\Configuration\Utils\Rule;
use Blumilk\Codestyle\Fixers\CompactEmptyArrayFixer;
use Blumilk\Codestyle\Fixers\DoubleQuoteFixer;
use Blumilk\Codestyle\Fixers\NamedArgumentFixer;
use Blumilk\Codestyle\Fixers\NoCommentFixer;
use Blumilk\Codestyle\Fixers\NoLaravelMigrationsGeneratedCommentFixer;
use JetBrains\PhpStorm\ArrayShape;
use PhpCsFixer\Config as PhpCsFixerConfig;
use PhpCsFixer\Finder;
use PhpCsFixer\Runner\Parallel\ParallelConfig;
use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;
use PhpCsFixerCustomFixers\Fixers as PhpCsFixerCustomFixers;

class Config
{
    protected const IGNORE_TAG = "php-cs-fixer:ignore-file";

    protected Paths $paths;
    protected Rules $rules;
    protected string $rootPath;
    protected bool $withRiskyFixers = true;
    protected bool $withCache = true;
    protected bool $withParallelRun = true;
    protected ?ParallelConfig $customParallelRunConfig = null;
    protected bool $ignoreMarkedFiles = false;

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

        $filteredFiles = $this->ignoreMarkedFiles
            ? array_filter($files, fn(string $file): bool => !str_contains(file_get_contents($file), self::IGNORE_TAG))
            : $files;

        $finder = Finder::create()->directories()->append($filteredFiles);
        $config = new PhpCsFixerConfig("Blumilk codestyle standard");

        $config = $config->setFinder($finder)
            ->setUsingCache($this->withCache)
            ->registerCustomFixers(new PhpCsFixerCustomFixers())
            ->registerCustomFixers($this->getCustomFixers())
            ->setRiskyAllowed($this->withRiskyFixers)
            ->setRules($rules);

        if ($this->withParallelRun) {
            $config = $config->setParallelConfig($this->withCustomParallelRunConfig ?? ParallelConfigFactory::detect());
        }

        return $config;
    }

    #[ArrayShape(["paths" => "array", "rules" => "array"])]
    public function options(): array
    {
        return [
            "paths" => $this->paths->get(),
            "rules" => $this->rules->get(),
        ];
    }

    public function purgeMode(bool $purgeDocComments = true): static
    {
        $this->rules->add(new Rule(NoCommentFixer::class, ["doc_comment" => $purgeDocComments]));

        return $this;
    }

    public function withRiskyFixers(): static
    {
        $this->withRiskyFixers = true;

        return $this;
    }

    public function withoutRiskyFixers(): static
    {
        $this->withRiskyFixers = false;

        return $this;
    }

    public function withCache(): static
    {
        $this->withCache = true;

        return $this;
    }

    public function withoutCache(): static
    {
        $this->withCache = false;

        return $this;
    }

    public function withParallelRun(): static
    {
        $this->withParallelRun = true;

        return $this;
    }

    public function withoutParallelRun(): static
    {
        $this->withParallelRun = false;

        return $this;
    }

    public function withCustomParallelRunConfig(ParallelConfig $config): static
    {
        $this->withParallelRun();
        $this->customParallelRunConfig = $config;

        return $this;
    }

    public function ignoreMarkedFiles(): static
    {
        $this->ignoreMarkedFiles = true;

        return $this;
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
            new NoCommentFixer(),
            new CompactEmptyArrayFixer(),
            new NamedArgumentFixer(),
        ];
    }
}
