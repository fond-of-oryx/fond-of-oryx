<?php

namespace FondOfOryx\Zed\GiftCardPaymentConnector;

use Codeception\Test\Unit;

class GiftCardPaymentConnectorConfigTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardPaymentConnector\GiftCardPaymentConnectorConfig
     */
    protected $config;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->config = new GiftCardPaymentConnectorConfig();
    }

    /**
     * @return void
     */
    public function testGetNotAllowedPaymentMethods(): void
    {
        static::assertIsArray($this->config->getNotAllowedPaymentMethods());
    }
}
