<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Fixers;

use PhpCsFixer\AbstractFixer;
use PhpCsFixer\Fixer\ConfigurableFixerInterface;
use PhpCsFixer\Fixer\Whitespace\NoExtraBlankLinesFixer;
use PhpCsFixer\FixerConfiguration\FixerConfigurationResolver;
use PhpCsFixer\FixerConfiguration\FixerOptionBuilder;
use PhpCsFixer\FixerDefinition\CodeSample;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Tokenizer\Tokens;
use PhpCsFixerCustomFixers\TokenRemover;
use SplFileInfo;

final class NoCommentFixer extends AbstractFixer implements ConfigurableFixerInterface
{
    public function getConfigurationDefinition(): FixerConfigurationResolver
    {
        return new FixerConfigurationResolver([
            (new FixerOptionBuilder("doc_comment", "Docblock comments should be removed."))
                ->setAllowedTypes(["bool"])
                ->setDefault(false)
                ->getOption(),
        ]);
    }

    public function getDefinition(): FixerDefinitionInterface
    {
        $codeSample = <<<'EOF'
<?php

class Migration
{
    public function up()
    {
        Schema::create("sessions", function (Blueprint $table) {
        // test
            $table->string("id")->primary();
            $table->text("payload");
        });
    }
};
EOF;

        return new FixerDefinition(
            "There can be no comments.",
            [
                new CodeSample($codeSample),
            ],
        );
    }

    public function getName(): string
    {
        return "Blumilk/no_comments";
    }

    public function getPriority(): int
    {
        $fixer = new NoExtraBlankLinesFixer();

        return $fixer->getPriority() + 1;
    }

    public function supports(SplFileInfo $file): bool
    {
        return true;
    }

    public function isCandidate(Tokens $tokens): bool
    {
        return $tokens->isAnyTokenKindsFound([T_COMMENT, T_DOC_COMMENT]);
    }

    public function isRisky(): bool
    {
        return true;
    }

    public function applyFix(SplFileInfo $file, Tokens $tokens): void
    {
        for ($index = $tokens->count() - 1; $index > 0; $index--) {
            if (!$tokens[$index]->isGivenKind($this->configuration["doc_comment"] ? [T_COMMENT, T_DOC_COMMENT] : [T_COMMENT])) {
                continue;
            }

            TokenRemover::removeWithLinesIfPossible($tokens, $index);
        }
    }

    public function configure(array $configuration): void
    {
        // TODO: Implement configure() method.
    }
}
