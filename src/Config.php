<?php

declare(strict_types=1);

namespace Blumilk\Codestyle;

use Blumilk\Codestyle\Configuration\AdditionalRules;
use Blumilk\Codestyle\Configuration\Defaults\CommonAdditionalRules;
use Blumilk\Codestyle\Configuration\Defaults\CommonSetLists;
use Blumilk\Codestyle\Configuration\Defaults\CommonSkippedRules;
use Blumilk\Codestyle\Configuration\Defaults\LaravelPaths;
use Blumilk\Codestyle\Configuration\Paths;
use Blumilk\Codestyle\Configuration\SetLists;
use Blumilk\Codestyle\Configuration\SkippedRules;
use Blumilk\Codestyle\Fixers\DoubleQuoteFixer;
use JetBrains\PhpStorm\ArrayShape;
use PhpCsFixer\Config as PhpCsFixerConfig;
use PhpCsFixer\Finder;
use PhpCsFixerCustomFixers\Fixers as PhpCsFixerCustomFixers;

class Config
{
    protected Paths $paths;
    protected SetLists $sets;
    protected SkippedRules $skipped;
    protected AdditionalRules $rules;

    public function __construct(
        ?Paths $paths = null,
        ?SetLists $sets = null,
        ?SkippedRules $skipped = null,
        ?AdditionalRules $rules = null,
    ) {
        $this->paths = $paths ?? new LaravelPaths();
        $this->sets = $sets ?? new CommonSetLists();
        $this->skipped = $skipped ?? new CommonSkippedRules();
        $this->rules = $rules ?? new CommonAdditionalRules();
    }

    public function config(): PhpCsFixerConfig
    {
        list("paths" => $paths, "sets" => $sets, "skipped" => $skipped, "rules" => $rules) = $this->options();

        $finder = Finder::create()
            ->in(__DIR__)
            ->name($paths);

        $config = new PhpCsFixerConfig("Blumilk codestyle standard");
        return $config->setFinder($finder)
            ->registerCustomFixers(new PhpCsFixerCustomFixers())
            ->registerCustomFixers([new DoubleQuoteFixer()])
            ->setRiskyAllowed(true)
            ->setRules($rules);
    }

    #[ArrayShape([
        "paths" => "array",
        "sets" => "array",
        "skipped" => "array",
        "rules" => "array",
    ])]
    public function options(): array
    {
        return [
            "paths" => $this->paths->get(),
            "sets" => $this->sets->get(),
            "skipped" => $this->skipped->get(),
            "rules" => $this->rules->get(),
        ];
    }
}
