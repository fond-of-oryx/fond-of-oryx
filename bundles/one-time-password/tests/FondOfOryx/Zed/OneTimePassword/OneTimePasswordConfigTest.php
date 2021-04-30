<?php

namespace FondOfOryx\Zed\OneTimePassword;

use Codeception\Test\Unit;

class OneTimePasswordConfigTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig
     */
    protected $oneTimePasswordConfig;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->oneTimePasswordConfig = new OneTimePasswordConfig();
    }

    /**
     * @return void
     */
    public function testGetGermanWordListPath(): void
    {
        $this->assertIsString(
            $this->oneTimePasswordConfig->getGermanWordListPath()
        );
    }
}
