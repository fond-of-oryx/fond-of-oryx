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
    public function testFilterWithDiscount(): void
    {
        $subTotal = 1990;
        $discount = 800;

        $this->totalsTransferMock->expects(static::atLeastOnce())
            ->method('getSubtotal')
            ->willReturn($subTotal);

        $this->totalsTransferMock->expects(static::atLeastOnce())
            ->method('getDiscountTotal')
            ->willReturn($discount);

        static::assertEquals(
            $subTotal - $discount,
            $this->priceToPayFilterPlugin->filter($this->totalsTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testFilterWithoutDiscount(): void
    {
        $subTotal = 1990;
        $discount = 0;

        $this->totalsTransferMock->expects(static::atLeastOnce())
            ->method('getSubtotal')
            ->willReturn($subTotal);

        $this->totalsTransferMock->expects(static::atLeastOnce())
            ->method('getDiscountTotal')
            ->willReturn($discount);

        static::assertEquals(
            $subTotal - $discount,
            $this->priceToPayFilterPlugin->filter($this->totalsTransferMock),
        );
    }
}
