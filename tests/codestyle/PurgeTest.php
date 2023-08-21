<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Tests;

use Exception;

class PurgeTest extends CodestyleTestCase
{
    /**
     * @throws Exception
     */
    public function testPhp82Fixtures(): void
    {
        $this->testFixture("noComments");
    }

    protected function getConfigPath(): string
    {
        return "./tests/codestyle/config/config.purge.php";
    }
}
