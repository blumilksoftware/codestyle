<?php

declare(strict_types=1);

use Blumilk\Codestyle\Config;
use Blumilk\Codestyle\Configuration\Defaults\CommonSkippedRules;
use Blumilk\Codestyle\Configuration\Utils\Rule;
use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use PhpCsFixer\Fixer\ClassNotation\ClassAttributesSeparationFixer;
use PhpCsFixer\Fixer\Operator\BinaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\LogicalOperatorsFixer;
use PhpCsFixer\Fixer\Operator\NotOperatorWithSuccessorSpaceFixer;
use PhpCsFixer\Fixer\ReturnNotation\ReturnAssignmentFixer;
use PhpCsFixer\Fixer\StringNotation\SingleQuoteFixer;
use PHPUnit\Framework\TestCase;

class SkippedRulesConfigurationTest extends TestCase
{
    public function testSkippedRulesConfiguration(): void
    {
        $skipped = new CommonSkippedRules();
        $config = new Config(skipped: $skipped);

        $this->assertSame(
            [
                SingleQuoteFixer::class => null,
                ClassAttributesSeparationFixer::class => null,
                NotOperatorWithSuccessorSpaceFixer::class => null,
                ReturnAssignmentFixer::class => null,
                BinaryOperatorSpacesFixer::class => null,
            ],
            $config->options()["skipped"],
        );
    }

    public function testClearingSkippedRulesConfiguration(): void
    {
        $skipped = new CommonSkippedRules();
        $config = new Config(skipped: $skipped->clear());

        $this->assertSame([], $config->options()["skipped"]);
    }

    public function testFilteringSkippedRulesConfiguration(): void
    {
        $skipped = new CommonSkippedRules();
        $config = new Config(skipped: $skipped->filter(ReturnAssignmentFixer::class, SingleQuoteFixer::class));

        $this->assertSame(
            [
                ClassAttributesSeparationFixer::class => null,
                NotOperatorWithSuccessorSpaceFixer::class => null,
                BinaryOperatorSpacesFixer::class => null,
            ],
            $config->options()["skipped"],
        );
    }

    public function testExtendingSkippedRulesConfiguration(): void
    {
        $skipped = new CommonSkippedRules();
        $config = new Config(
            skipped: $skipped->add(new Rule(LogicalOperatorsFixer::class)),
        );

        $this->assertSame(
            [
                SingleQuoteFixer::class => null,
                ClassAttributesSeparationFixer::class => null,
                NotOperatorWithSuccessorSpaceFixer::class => null,
                ReturnAssignmentFixer::class => null,
                BinaryOperatorSpacesFixer::class => null,
                LogicalOperatorsFixer::class => null,
            ],
            $config->options()["skipped"],
        );
    }

    public function testExtendingWithOptionsSkippedRulesConfiguration(): void
    {
        $skipped = new CommonSkippedRules();
        $config = new Config(
            skipped: $skipped->add(new Rule(ArraySyntaxFixer::class, [__DIR__ . "/test"])),
        );

        $this->assertSame(
            [
                SingleQuoteFixer::class => null,
                ClassAttributesSeparationFixer::class => null,
                NotOperatorWithSuccessorSpaceFixer::class => null,
                ReturnAssignmentFixer::class => null,
                BinaryOperatorSpacesFixer::class => null,
                ArraySyntaxFixer::class => [__DIR__ . "/test"],
            ],
            $config->options()["skipped"],
        );
    }
}
