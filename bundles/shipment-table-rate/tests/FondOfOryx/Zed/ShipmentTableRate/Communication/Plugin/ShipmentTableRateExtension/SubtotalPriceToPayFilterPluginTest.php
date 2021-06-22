<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Communication\Plugin\ShipmentTableRateExtension;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\TotalsTransfer;

class SubtotalPriceToPayFilterPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\TotalsTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $totalsTransferMock;

    /**
     * @var \FondOfOryx\Zed\ShipmentTableRate\Communication\Plugin\ShipmentTableRateExtension\SubtotalPriceToPayFilterPlugin
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

        $this->priceToPayFilterPlugin = new SubtotalPriceToPayFilterPlugin();
    }

    /**
     * @return void
     */
    public function testFilter(): void
    {
        $subtotal = 1095;

        $this->totalsTransferMock->expects(static::atLeastOnce())
            ->method('getSubtotal')
            ->willReturn($subtotal);

        static::assertEquals(
            $subtotal,
            $this->priceToPayFilterPlugin->filter($this->totalsTransferMock)
        );
    }
}
