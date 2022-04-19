<?php

namespace FondOfOryx\Zed\PayoneCreditMemo;

use Codeception\Test\Unit;

class PayoneCreditMemoConfigTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\PayoneCreditMemo\PayoneCreditMemoConfig
     */
    protected $config;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->config = new PayoneCreditMemoConfig();
    }

    /**
     * @return void
     */
    public function testGetListeningPaymentMethods(): void
    {
        static::assertEquals([], $this->config->getListeningPaymentMethods());
    }
}
