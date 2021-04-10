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
    protected ReflectionClass $reflection;

    /**
     * @throws ReflectionException
     */
    public function __construct()
    {
        parent::__construct();
        $this->reflection = new ReflectionClass(get_class($this->getFixer()));
    }

    /**
     * @throws ReflectionException
     */
    public function __call(string $name, array $arguments = []): void
    {
        if (method_exists($this, $name)) {
            $this->{$name}(...$arguments);
        }

        $reflectedMethod = $this->reflection->getMethod($name);
        $reflectedMethod->setAccessible(true);
        $reflectedMethod->invoke($this->getFixer(), ...$arguments);
    }

    /**
     * @throws ReflectionException
     */
    public function __get(string $name): mixed
    {
        $reflectedProperty = $this->reflection->getProperty($name);
        $reflectedProperty->setAccessible(true);
        return $reflectedProperty->getValue($this->getFixer());
    }

    /**
     * @throws ReflectionException
     */
    public function __set(string $name, mixed $value): void
    {
        $reflectedProperty = $this->reflection->getProperty($name);
        $reflectedProperty->setAccessible(true);
        $reflectedProperty->setValue($this->getFixer(), $value);
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
