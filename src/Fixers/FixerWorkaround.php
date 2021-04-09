<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Fixers;

use PhpCsFixer\AbstractFixer;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\Tokenizer\Tokens;
use ReflectionClass;
use ReflectionException;
use SplFileInfo;

abstract class FixerWorkaround extends AbstractFixer
{
    /**
     * @throws ReflectionException
     */
    public function __call(string $name, array $arguments = []): void
    {
        $reflection = new ReflectionClass(get_class($this->getFixer()));
        $reflectedMethod = $reflection->getMethod($name);
        $reflectedMethod->setAccessible(true);
        $reflectedMethod->invoke($this->getFixer(), ...$arguments);
    }

    /**
     * @throws ReflectionException
     */
    public function __get(string $name): mixed
    {
        $reflection = new ReflectionClass(get_class($this->getFixer()));
        $reflectedProperty = $reflection->getProperty($name);
        $reflectedProperty->setAccessible(true);
        return $reflectedProperty->getValue($this->getFixer());
    }

    public function getDefinition(): FixerDefinition
    {
        return $this->getFixer()->getDefinition();
    }

    public function isCandidate(Tokens $tokens): bool
    {
        return $this->getFixer()->isCandidate($tokens);
    }

    abstract protected function applyFix(SplFileInfo $file, Tokens $tokens): void;

    abstract protected function getFixer(): AbstractFixer;
}
