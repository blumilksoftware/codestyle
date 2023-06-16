<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Fixers;

use PhpCsFixer\Fixer\FixerInterface;
use PhpCsFixer\Fixer\FunctionNotation\VoidReturnFixer;
use PhpCsFixer\FixerDefinition\CodeSample;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Tokenizer\Tokens;
use PhpCsFixerCustomFixers\TokenRemover;
use SplFileInfo;

final class NoLaravelMigrationsGeneratedCommentFixer implements FixerInterface
{
    public function getDefinition(): FixerDefinitionInterface
    {
        $codeSample = <<<'EOF'
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("sessions", function (Blueprint $table) {
            $table->string("id")->primary();
            $table->text("payload");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("sessions");
    }
};
EOF;

        return new FixerDefinition(
            "There can be no comments generated in Laravel migrations stub.",
            [
                new CodeSample($codeSample),
            ],
        );
    }

    public function getName(): string
    {
        return "Blumilk/no_laravel_migrations_generated_comments";
    }

    public function getPriority(): int
    {
        $fixer = new VoidReturnFixer();

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
        return false;
    }

    public function fix(SplFileInfo $file, Tokens $tokens): void
    {
        for ($index = $tokens->count() - 1; $index > 0; $index--) {
            if (!$tokens[$index]->isGivenKind([T_COMMENT, T_DOC_COMMENT])) {
                continue;
            }

            if (
                !str_contains($tokens[$index]->getContent(), "Run the migrations.")
                && !str_contains($tokens[$index]->getContent(), "Reverse the migrations.")
            ) {
                continue;
            }

            TokenRemover::removeWithLinesIfPossible($tokens, $index);
        }
    }
}
