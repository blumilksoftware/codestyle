<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Configuration\Defaults;

use Blumilk\Codestyle\Configuration\Paths as PathsContract;

class Paths implements PathsContract
{
    protected array $paths = [];

    public function __construct(string ...$paths)
    {
        $this->add(...$paths);
    }

    public function get(): array
    {
        return $this->paths;
    }

    public function add(string ...$paths): static
    {
        foreach ($paths as $path) {
            if (!in_array($path, $this->paths, true)) {
                $this->paths[] = $path;
            }
        }

        return $this;
    }

    public function clear(): static
    {
        $this->paths = [];

        return $this;
    }

    public function filter(string ...$paths): static
    {
        foreach ($this->paths as $index => $path) {
            if (in_array($path, $paths, true)) {
                unset($this->paths[$index]);
            }
        }

        $this->paths = array_values($this->paths);

        return $this;
    }
}
