<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Fixers;

use PhpCsFixer\Fixer\FixerInterface;
use PhpCsFixer\Fixer\Import\FullyQualifiedStrictTypesFixer;
use PhpCsFixer\FixerDefinition\CodeSample;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Tokenizer\Tokens;
use ReflectionClass;
use SplFileInfo;

final class ClassKeywordFixer implements FixerInterface
{
    public function getDefinition(): FixerDefinitionInterface
    {
        return new FixerDefinition(
            "Converts FQCN strings to `*::class` keywords.",
            [
                new CodeSample(
                    '<?php

$foo = \'PhpCsFixer\Tokenizer\Tokens\';
$bar = "\PhpCsFixer\Tokenizer\Tokens";
$baz = "\Exception";
',
                ),
            ],
            "This rule does not have an understanding of whether a class exists in the scope of the codebase or not, relying on run-time and autoloaded classes to determine it, which makes the rule useless when running on a single file out of codebase context.",
            "Do not use it, unless you know what you are doing.",
        );
    }

    public function isCandidate(Tokens $tokens): bool
    {
        return true;
    }

    public function isRisky(): bool
    {
        return true;
    }

    public function fix(SplFileInfo $file, Tokens $tokens): void
    {
        for ($index = $tokens->count() - 1; $index >= 0; --$index) {
            $token = $tokens[$index];

            if ($token->isGivenKind(T_CONSTANT_ENCAPSED_STRING) && (strpos($token->getContent(), "\\") !== false)) {
                $name = substr($token->getContent(), 1, -1);
                $name = ltrim($name, "\\");
                $name = str_replace("\\\\", "\\", $name);

                if ($this->exists($name)) {
                    $substitution = Tokens::fromCode("<?php echo \\{$name}::class;");
                    $substitution->clearRange(0, 2);
                    $substitution->clearAt($substitution->getSize() - 1);
                    $substitution->clearEmptyTokens();

                    $tokens->clearAt($index);
                    $tokens->insertAt($index, $substitution);
                }
            }
        }
    }

    public function getName(): string
    {
        return "Blumilk/class_keyword_fixer";
    }

    public function getPriority(): int
    {
        $fixer = new FullyQualifiedStrictTypesFixer();

        return $fixer->getPriority() + 1;
    }

    public function supports(SplFileInfo $file): bool
    {
        return true;
    }

    private function exists(string $name): bool
    {
        if (class_exists($name) || interface_exists($name) || trait_exists($name) || enum_exists($name)) {
            $reflection = new ReflectionClass($name);

            return $reflection->getName() === $name;
        }

        return false;
    }
}
