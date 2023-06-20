<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Configuration\Defaults;

use Blumilk\Codestyle\Configuration\Rules as RulesContract;
use Blumilk\Codestyle\Configuration\Utils\Rule;
use PhpCsFixerCustomFixers\Fixer\AbstractFixer;

abstract class Rules implements RulesContract
{
    protected array $rules = [];

    public function get(): array
    {
        $rules = [];

        foreach ($this->rules as $fixer => $options) {
            /** @var AbstractFixer $fixer */
            $fixer = new $fixer();
            $rules[$fixer->getName()] = $options === null ? true : $options;
        }

        return $rules;
    }

    public function add(Rule ...$rules): static
    {
        foreach ($rules as $rule) {
            if (!in_array($rule->getFixerClassName(), array_keys($this->rules), true)) {
                $this->rules[$rule->getFixerClassName()] = $rule->getOptions();
            }
        }

        return $this;
    }

    public function clear(): static
    {
        $this->rules = [];

        return $this;
    }

    public function filter(string ...$rules): static
    {
        foreach (array_keys($this->rules) as $rule) {
            if (in_array($rule, $rules, true)) {
                unset($this->rules[$rule]);
            }
        }

        return $this;
    }
}
