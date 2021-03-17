<?php

namespace FondOfOryx\Zed\ShipmentTableRate;

use Codeception\Test\Unit;
use FondOfOryx\Shared\ShipmentTableRate\ShipmentTableRateConstants;

class ShipmentTableRateConfigTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ShipmentTableRate\ShipmentTableRateConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $shipmentTableRateConfig;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->shipmentTableRateConfig = $this->getMockBuilder(ShipmentTableRateConfig::class)
            ->onlyMethods(['get'])
            ->getMock();
    }

    /**
     * @return void
     */
    public function testGetFallbackPrice(): void
    {
        $this->shipmentTableRateConfig->expects($this->atLeastOnce())
            ->method('get')
            ->with(
                ShipmentTableRateConstants::FALLBACK_PRICE,
                ShipmentTableRateConstants::FALLBACK_PRICE_DEFAULT_VALUE
            )->willReturn(ShipmentTableRateConstants::FALLBACK_PRICE_DEFAULT_VALUE);

        $this->assertEquals(
            ShipmentTableRateConstants::FALLBACK_PRICE_DEFAULT_VALUE,
            $this->shipmentTableRateConfig->getFallbackPrice()
        );
    }

    /**
     * @return void
     */
    public function testGetCustomFallbackPrice(): void
    {
        $customFallbackPrice = 0;

        $this->shipmentTableRateConfig->expects($this->atLeastOnce())
            ->method('get')
            ->with(
                ShipmentTableRateConstants::FALLBACK_PRICE,
                ShipmentTableRateConstants::FALLBACK_PRICE_DEFAULT_VALUE
            )->willReturn($customFallbackPrice);

        $this->assertEquals(
            $customFallbackPrice,
            $this->shipmentTableRateConfig->getFallbackPrice()
        );
    }
}
