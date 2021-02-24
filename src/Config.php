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
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator as Container;
use Symplify\EasyCodingStandard\ValueObject\Option;

class Config
{
    protected Paths $paths;
    protected SetLists $sets;
    protected SkippedRules $skipped;
    protected AdditionalRules $rules;

    #[Pure]
    public function __construct(
        ?Paths $paths = null,
        ?SetLists $sets = null,
        ?SkippedRules $skipped = null,
        ?AdditionalRules $rules = null
    ) {
        $this->paths = $paths ?? new LaravelPaths();
        $this->sets = $sets ?? new CommonSetLists();
        $this->skipped = $skipped ?? new CommonSkippedRules();
        $this->rules = $rules ?? new CommonAdditionalRules();
    }

    public function config(): callable
    {
        list("paths" => $paths, "sets" => $sets, "skipped" => $skipped, "rules" => $rules) = $this->options();

        return static function (Container $container) use ($sets, $skipped, $rules, $paths): void {
            $parameters = $container->parameters();
            $parameters->set(Option::SETS, $sets);
            $parameters->set(Option::SKIP, $skipped);
            $parameters->set(Option::PATHS, $paths);

            $services = $container->services();
            foreach ($rules as $rule => $configuration) {
                $service = $services->set($rule);
                if ($configuration) {
                    $service->call("configure", [$configuration]);
                }
            }
        };
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
