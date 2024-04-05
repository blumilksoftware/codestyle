<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Fixers;

use PhpCsFixer\Fixer\FixerInterface;
use PhpCsFixer\FixerDefinition\CodeSample;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\Tokenizer\CT;
use PhpCsFixer\Tokenizer\Tokens;
use SplFileInfo;

final class NamedArgumentFixer implements FixerInterface
{
    public function getDefinition(): FixerDefinition
    {
        $codeSample = <<<'EOF'
<?php
if (floatval($percentage) >= (float)$this->option("threshold")) {
    event(
        new ErrorsThresholdExceeded(
            requestsNumber : $requests,
            errorsNumber   : $errors,
            percentage     : $percentage,
        ),
    );
}
EOF;

        return new FixerDefinition(
            "Fix named arguments formatting.",
            [
                new CodeSample($codeSample),
            ],
        );
    }

    public function getName(): string
    {
        return "Blumilk/named_arguments";
    }

    public function getPriority(): int
    {
        return 1;
    }

    public function supports(SplFileInfo $file): bool
    {
        return true;
    }

    public function isCandidate(Tokens $tokens): bool
    {
        return $tokens->isTokenKindFound(CT::T_NAMED_ARGUMENT_NAME);
    }

    public function isRisky(): bool
    {
        return false;
    }

    public function fix(SplFileInfo $file, Tokens $tokens): void
    {
        foreach ($tokens as $index => $token) {
            if (!$token->isGivenKind(CT::T_NAMED_ARGUMENT_NAME)) {
                continue;
            }

            $colonIndex = $tokens->getNextMeaningfulToken($index);

            if ($colonIndex !== null && $tokens[$colonIndex]->isGivenKind(CT::T_NAMED_ARGUMENT_COLON)) {
                $nextIndex = $tokens->getNextNonWhitespace($index);

                if ($nextIndex !== null && $nextIndex === $colonIndex) {
                    $tokens->clearAt($index + 1);
                    $tokens->clearEmptyTokens();
                }
            }
        }
    }
}
