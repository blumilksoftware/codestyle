<?php

declare(strict_types=1);

use Blumilk\Codestyle\Config;
use Blumilk\Codestyle\Configuration\Defaults\CommonSetLists;
use PHPUnit\Framework\TestCase;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

class SetsConfigurationTest extends TestCase
{
    public function testSetsConfiguration(): void
    {
        $sets = new CommonSetLists();
        $config = new Config(sets: $sets);

        $this->assertSame([
            SetList::CLEAN_CODE,
            SetList::PSR_12,
            SetList::COMMON,
        ], $config->options()["sets"]);
    }

    public function testClearingSetsConfiguration(): void
    {
        $sets = new CommonSetLists();
        $config = new Config(sets: $sets->clear());

        $this->assertSame([], $config->options()["sets"]);
    }

    public function testFilteringSetsConfiguration(): void
    {
        $sets = new CommonSetLists();
        $config = new Config(sets: $sets->filter(SetList::CLEAN_CODE));

        $this->assertSame([SetList::PSR_12, SetList::COMMON], $config->options()["sets"]);
    }

    public function testExtendingSetsConfiguration(): void
    {
        $sets = new CommonSetLists();
        $config = new Config(sets: $sets->add(SetList::COMMENTS));

        $this->assertSame([
            SetList::CLEAN_CODE,
            SetList::PSR_12,
            SetList::COMMON,
            SetList::COMMENTS,
        ], $config->options()["sets"]);
    }
}
