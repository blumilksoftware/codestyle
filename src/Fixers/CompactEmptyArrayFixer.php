<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Fixers;

use PhpCsFixer\Fixer\FixerInterface;
use PhpCsFixer\FixerDefinition\CodeSample;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Tokenizer\CT;
use PhpCsFixer\Tokenizer\Tokens;
use PhpCsFixerCustomFixers\Fixer\NoCommentedOutCodeFixer;
use SplFileInfo;

final class CompactEmptyArrayFixer implements FixerInterface
{
    public function getDefinition(): FixerDefinitionInterface
    {
        return new FixerDefinition(
            "Ensures that empty arrays are declared using compact syntax.",
            [new CodeSample("<?php\n\$array = [\n];\n")],
        );
    }

    public function isCandidate(Tokens $tokens): bool
    {
        return $tokens->isAnyTokenKindsFound([T_ARRAY, CT::T_ARRAY_SQUARE_BRACE_OPEN, CT::T_DESTRUCTURING_SQUARE_BRACE_OPEN]);
    }

    public function isRisky(): bool
    {
        return false;
    }

    public function fix(SplFileInfo $file, Tokens $tokens): void
    {
        foreach ($tokens as $index => $token) {
            if ($token->isGivenKind([T_ARRAY, CT::T_ARRAY_SQUARE_BRACE_OPEN, CT::T_DESTRUCTURING_SQUARE_BRACE_OPEN])) {
                $startIndex = $index;

                if ($token->isGivenKind(T_ARRAY)) {
                    $startIndex = $tokens->getNextMeaningfulToken($startIndex);
                    $endIndex = $tokens->findBlockEnd(Tokens::BLOCK_TYPE_PARENTHESIS_BRACE, $startIndex);
                } elseif ($token->isGivenKind(CT::T_DESTRUCTURING_SQUARE_BRACE_OPEN)) {
                    $endIndex = $tokens->findBlockEnd(Tokens::BLOCK_TYPE_DESTRUCTURING_SQUARE_BRACE, $startIndex);
                } else {
                    $endIndex = $tokens->findBlockEnd(Tokens::BLOCK_TYPE_ARRAY_SQUARE_BRACE, $startIndex);
                }

                // Check if the array is empty and multiline
                $isEmptyArray = true;

                for ($i = $index + 1; $i < $endIndex; ++$i) {
                    if (!$tokens[$i]->isWhitespace() && !$tokens[$i]->isComment()) {
                        $isEmptyArray = false;

                        break;
                    }
                }

                if ($isEmptyArray) {
                    for ($i = $index + 1; $i < $endIndex; ++$i) {
                        $tokens->clearAt($i);
                    }
                }
            }
        }
    }

    public function getName(): string
    {
        return "Blumilk/compact_empty_array";
    }

    public function getPriority(): int
    {
        $fixer = new NoCommentedOutCodeFixer();

        return $fixer->getPriority() - 1;
    }

    public function supports(SplFileInfo $file): bool
    {
        return true;
    }
}
