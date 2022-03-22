<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Fixers;

use PhpCsFixer\Fixer\Operator\BinaryOperatorSpacesFixer as BaseBinaryOperatorSpacesFixer;
use PhpCsFixer\Tokenizer\CT;
use PhpCsFixer\Tokenizer\Tokens;
use PhpCsFixer\Tokenizer\TokensAnalyzer;
use SplFileInfo;

final class BinaryOperatorSpacesFixer extends FixerWorkaround
{
    protected BaseBinaryOperatorSpacesFixer $fixer;

    public function __construct()
    {
        $this->fixer = new BaseBinaryOperatorSpacesFixer();
        parent::__construct();
    }

    protected function getFixer(): BaseBinaryOperatorSpacesFixer
    {
        return $this->fixer;
    }

    protected function applyFix(SplFileInfo $file, Tokens $tokens): void
    {
        $this->tokensAnalyzer = new TokensAnalyzer($tokens);

        for ($index = $tokens->count() - 2; $index > 0; --$index) {
            if ($tokens[$index]->getContent() === "|" && $tokens[$index]->getId() === CT::T_TYPE_ALTERNATION) {
                continue;
            }

            if (!$this->tokensAnalyzer->isBinaryOperator($index)) {
                continue;
            }

            if ($tokens[$index]->getContent() === "=") {
                $isDeclare = $this->isEqualPartOfDeclareStatement($tokens, $index);
                if ($isDeclare === false) {
                    $this->fixWhiteSpaceAroundOperator($tokens, $index);
                } else {
                    $index = $isDeclare;
                }
            } else {
                $this->fixWhiteSpaceAroundOperator($tokens, $index);
            }

            --$index;
        }

        if (\count($this->alignOperatorTokens)) {
            $this->fixAlignment($tokens, $this->alignOperatorTokens);
        }
    }
}
