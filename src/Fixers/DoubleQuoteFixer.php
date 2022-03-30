<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Fixers;

use PhpCsFixer\Fixer\FixerInterface;
use PhpCsFixer\FixerDefinition\CodeSample;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\Tokenizer\Token;
use PhpCsFixer\Tokenizer\Tokens;
use SplFileInfo;

final class DoubleQuoteFixer implements FixerInterface
{
    public function getDefinition(): FixerDefinition
    {
        $codeSample = <<<'EOF'
<?php
$a = 'sample';
EOF;

        return new FixerDefinition(
            "Convert single quotes to double quotes for simple strings.",
            [
                new CodeSample($codeSample),
            ],
        );
    }

    public function isCandidate(Tokens $tokens): bool
    {
        return $tokens->isTokenKindFound(T_CONSTANT_ENCAPSED_STRING);
    }

    public function isRisky(): bool
    {
        return false;
    }

    public function fix(SplFileInfo $file, Tokens $tokens): void
    {
        if ($tokens->count() > 0 && $this->isCandidate($tokens) && $this->supports($file)) {
            $this->applyFix($file, $tokens);
        }
    }

    public function getName(): string
    {
        return "Blumilk/double_quote";
    }

    public function getPriority(): int
    {
        return 0;
    }

    public function supports(SplFileInfo $file): bool
    {
        return true;
    }

    protected function applyFix(SplFileInfo $file, Tokens $tokens): void
    {
        foreach ($tokens as $index => $token) {
            if (!$token->isGivenKind(T_CONSTANT_ENCAPSED_STRING)) {
                continue;
            }

            $content = $token->getContent();
            $prefix = "";
            if (
                $content[0] === "'" &&
                !str_contains($content, '"') &&
                // regex: odd number of backslashes, not followed by double quote or dollar
                !preg_match("/(?<!\\\\)(?:\\\\{2})*\\\\(?!['$\\\\])/", $content)
            ) {
                $content = substr($content, 1, -1);
                $content = str_replace("\\'", "'", $content);
                $content = str_replace("$", "$", $content);

                $tokens[$index] = new Token([T_CONSTANT_ENCAPSED_STRING, $prefix . '"' . $content . '"']);
            }
        }
    }
}
