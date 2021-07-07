<?php

namespace FondOfOryx\Zed\GiftCardProductConnector;

use Codeception\Test\Unit;

class GiftCardProductConnectorConfigTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\GiftCardProductConnector\GiftCardProductConnectorConfig
     */
    protected $giftCardProductConnectorConfig;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->giftCardProductConnectorConfig = new GiftCardProductConnectorConfig();
    }

    /**
     * @return void
     */
    public function testGetGiftCardProductSkuPrefixes(): void
    {
        $this->assertIsArray($this->giftCardProductConnectorConfig->getGiftCardProductSkuPrefixes());
    }
}
