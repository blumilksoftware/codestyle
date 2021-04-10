<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Fixers;

use PhpCsFixer\Fixer\FunctionNotation\NoSpacesAfterFunctionNameFixer as BaseNoSpacesAfterFunctionNameFixer;
use PhpCsFixer\Tokenizer\Tokens;
use SplFileInfo;

class NoSpacesAfterFunctionNameFixer extends FixerWorkaround
{
    protected BaseNoSpacesAfterFunctionNameFixer $fixer;

    public function __construct()
    {
        $this->fixer = new BaseNoSpacesAfterFunctionNameFixer();
        parent::__construct();
    }

    protected function getFixer(): BaseNoSpacesAfterFunctionNameFixer
    {
        return $this->fixer;
    }

    protected function applyFix(SplFileInfo $file, Tokens $tokens): void
    {
        $functionyTokens = $this->getFunctionyTokenKinds();
        $languageConstructionTokens = $this->getLanguageConstructionTokenKinds();
        $braceTypes = $this->getBraceAfterVariableKinds();

        foreach ($tokens as $index => $token) {
            if (!$token->equals("(")) {
                continue;
            }

            $lastTokenIndex = $tokens->getPrevNonWhitespace($index);

            $endParenthesisIndex = $tokens->findBlockEnd(Tokens::BLOCK_TYPE_PARENTHESIS_BRACE, $index);
            $nextNonWhiteSpace = $tokens->getNextMeaningfulToken($endParenthesisIndex);
            if (
                $nextNonWhiteSpace !== null
                && $tokens[$nextNonWhiteSpace]->equals("?")
                && $tokens[$lastTokenIndex]->isGivenKind($languageConstructionTokens)
            ) {
                continue;
            }

            if ($tokens[$lastTokenIndex]->isGivenKind($functionyTokens)) {
                $this->fixFunctionCall($tokens, $index);
            } elseif ($tokens[$lastTokenIndex]->isGivenKind(T_STRING)) {
                $possibleDefinitionIndex = $tokens->getPrevMeaningfulToken($lastTokenIndex);
                if (!$tokens[$possibleDefinitionIndex]->isGivenKind(T_FUNCTION)) {
                    $this->fixFunctionCall($tokens, $index);
                }
            } elseif ($tokens[$lastTokenIndex]->equalsAny($braceTypes ?? [])) {
                $block = Tokens::detectBlockType($tokens[$lastTokenIndex]);
                if (
                    $block["type"] === Tokens::BLOCK_TYPE_ARRAY_INDEX_CURLY_BRACE
                    || $block["type"] === Tokens::BLOCK_TYPE_DYNAMIC_VAR_BRACE
                    || $block["type"] === Tokens::BLOCK_TYPE_INDEX_SQUARE_BRACE
                    || $block["type"] === Tokens::BLOCK_TYPE_PARENTHESIS_BRACE
                ) {
                    $this->fixFunctionCall($tokens, $index);
                }
            }
        }
    }

    protected function getFunctionyTokenKinds(): array
    {
        return [
            T_ARRAY,
            T_ECHO,
            T_EMPTY,
            T_EVAL,
            T_EXIT,
            T_INCLUDE,
            T_INCLUDE_ONCE,
            T_ISSET,
            T_LIST,
            T_PRINT,
            T_REQUIRE,
            T_REQUIRE_ONCE,
            T_UNSET,
            T_VARIABLE,
            T_FN,
        ];
    }
}
