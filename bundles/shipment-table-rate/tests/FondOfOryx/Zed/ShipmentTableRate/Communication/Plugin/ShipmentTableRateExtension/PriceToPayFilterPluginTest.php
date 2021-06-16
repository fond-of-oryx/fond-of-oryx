<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Communication\Plugin\ShipmentTableRateExtension;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\TotalsTransfer;

class PriceToPayFilterPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\TotalsTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $totalsTransferMock;

    /**
     * @var \FondOfOryx\Zed\ShipmentTableRate\Communication\Plugin\ShipmentTableRateExtension\PriceToPayFilterPlugin
     */
    protected $priceToPayFilterPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->totalsTransferMock = $this->getMockBuilder(TotalsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceToPayFilterPlugin = new PriceToPayFilterPlugin();
    }

    /**
     * @return void
     */
    public function testFilter(): void
    {
        $priceToPay = 1295;

        $this->totalsTransferMock->expects(static::atLeastOnce())
            ->method('getPriceToPay')
            ->willReturn($priceToPay);

        static::assertEquals(
            $priceToPay,
            $this->priceToPayFilterPlugin->filter($this->totalsTransferMock)
        );
    }
}
