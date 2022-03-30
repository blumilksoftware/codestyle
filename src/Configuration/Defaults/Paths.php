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
        $paths = [];
        foreach ($this->paths as $path) {
            $directory = getcwd() . "/" . $path;
            $this->getAllFiles($paths, $directory);
        }

        return $paths;
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

    protected function getAllFiles(array &$paths, string $path): void {
        if (is_file($path)) {
            $paths[] = $path;
            return;
        }

        if (!is_dir($path)) {
            return;
        }

        $files = array_diff(scandir($path), [".", ".."]);

        foreach ($files as $file) {
            $directory = $path . "/" . $file;

            if (is_file($directory)) {
                $paths[] = $directory;
            } else {
                $this->getAllFiles($paths, $directory);
            }
        }
    }
}
