<?php

declare(strict_types=1);

namespace Blumilk\Codestyle;

use Blumilk\Codestyle\Configuration\Defaults\CommonRules;
use Blumilk\Codestyle\Configuration\Defaults\CommonSkippedRules;
use Blumilk\Codestyle\Configuration\Defaults\LaravelPaths;
use Blumilk\Codestyle\Configuration\Paths;
use Blumilk\Codestyle\Configuration\Rules;
use Blumilk\Codestyle\Configuration\SkippedRules;
use Blumilk\Codestyle\Fixers\DoubleQuoteFixer;
use JetBrains\PhpStorm\ArrayShape;
use PhpCsFixer\Config as PhpCsFixerConfig;
use PhpCsFixer\Finder;
use PhpCsFixerCustomFixers\Fixers as PhpCsFixerCustomFixers;

class Config
{
    protected Paths $paths;
    protected SkippedRules $skipped;
    protected Rules $rules;

    public function __construct(
        ?Paths $paths = null,
        ?Rules $rules = null,
        ?SkippedRules $skipped = null,
    ) {
        $this->paths = $paths ?? new LaravelPaths();
        $this->rules = $rules ?? new CommonRules();
        $this->skipped = $skipped ?? new CommonSkippedRules();
    }

    public function config(): PhpCsFixerConfig
    {
        list("paths" => $paths, "skipped" => $skipped, "rules" => $rules) = $this->options();

        $finder = Finder::create()->directories()->append($paths);

        foreach ($skipped as $rule) {
            unset($rules[$rule]);
        }

        $config = new PhpCsFixerConfig("Blumilk codestyle standard");
        return $config->setFinder($finder)
            ->setUsingCache(false)
            ->registerCustomFixers(new PhpCsFixerCustomFixers())
            ->registerCustomFixers([new DoubleQuoteFixer()])
            ->setRiskyAllowed(true)
            ->setRules($rules);
    }

    #[ArrayShape([
        "paths" => "array",
        "skipped" => "array",
        "rules" => "array",
    ])]
    public function options(): array
    {
        return [
            "paths" => $this->paths->get(),
            "skipped" => $this->skipped->get(),
            "rules" => $this->rules->get(),
        ];
    }
}
