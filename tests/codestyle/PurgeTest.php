<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Tests;

use Exception;

class PurgeTest extends CodestyleTestCase
{
    private string $config;
    /**
     * @throws Exception
     */
    public function testPhp82PurgeMode(): void
    {
        $this->config = "./tests/codestyle/config/config.purge.php";
        $this->testFixture("noComments");
    }

    /**
     * @throws Exception
     */
    public function testPhp82PurgeWithoutDocCommentsTest(): void
    {
        $this->config = "./tests/codestyle/config/config.purge.without.doc.comments.php";
        $this->testFixture("noCommentsWithoutDocComments");
    }

    protected function getConfigPath(): string
    {
        return $this->config;
    }
}
