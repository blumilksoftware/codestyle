<?php

namespace Blumilk\Codestyle\Fixers;

use PhpCsFixer\AbstractFixer;
use PhpCsFixer\FixerDefinition\CodeSample;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\Tokenizer\Tokens;
use SplFileInfo;

final class DoubleQuoteFixer extends AbstractFixer
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
            ]
        );
    }

    public function isCandidate(Tokens $tokens): bool
    {
        return $tokens->isTokenKindFound(T_CONSTANT_ENCAPSED_STRING);
    }

    protected function applyFix(SplFileInfo $file, Tokens $tokens): void
    {
        foreach ($tokens as $token) {
            if (!$token->isGivenKind(T_CONSTANT_ENCAPSED_STRING)) {
                continue;
            }

            $content = $token->getContent();
            if (
                "'" === $content[0] &&
                false === strpos($content, '"') &&
                // regex: odd number of backslashes, not followed by double quote or dollar
                !preg_match("/(?<!\\\\)(?:\\\\{2})*\\\\(?!['$\\\\])/", $content)
            ) {
                $content = substr($content, 1, -1);
                $content = str_replace("\\'", "'", $content);
                $content = str_replace("\\$", "$", $content);
                $token->setContent("\"" . $content . "\"");
            }
        }
    }
}
