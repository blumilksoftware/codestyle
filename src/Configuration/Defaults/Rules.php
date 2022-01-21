<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Configuration\Defaults;

use Blumilk\Codestyle\Configuration\Utils\Rule;

class Rules
{
    protected array $rules = [];

    public function get(): array
    {
        return $this->rules;
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
