<?php

declare(strict_types=1);

namespace Blumilk\Codestyle\Tests;

use Exception;

class PurgeWithoutDocCommentsTest extends CodestyleTestCase
{
    /**
     * @throws Exception
     */
    public function testPhp82Fixtures(): void
    {
        $this->testFixture("noCommentsWithoutDocComments");
    }

    protected function getConfigPath(): string
    {
        return "./tests/codestyle/config/config.purge.without.doc.comments.php";
    }
}
