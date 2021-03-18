<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Business\Model;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\TotalsTransfer;

class VariableExtractorTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\TotalsTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $totalsTransferMock;

    /**
     * @var \FondOfOryx\Zed\ShipmentTableRate\Business\Model\VariableExtractor
     */
    protected $variableExtractor;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->totalsTransferMock = $this->getMockBuilder(TotalsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->variableExtractor = new VariableExtractor();
    }

    /**
     * @return void
     */
    public function testExtractFromQuote(): void
    {
        $priceToPay = 1000;
        $subtotal = 1000;
        $discountTotal = 0;

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getTotals')
            ->willReturn($this->totalsTransferMock);

        $this->totalsTransferMock->expects(static::atLeastOnce())
            ->method('getPriceToPay')
            ->willReturn($priceToPay);

        $this->totalsTransferMock->expects(static::atLeastOnce())
            ->method('getSubtotal')
            ->willReturn($subtotal);

        $this->totalsTransferMock->expects(static::atLeastOnce())
            ->method('getDiscountTotal')
            ->willReturn($discountTotal);

        static::assertEquals(
            [
                'p' => (float)$priceToPay,
                's' => (float)$subtotal,
                'd' => (float)$discountTotal,
            ],
            $this->variableExtractor->extractFromQuote($this->quoteTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testExtractFromTotals(): void
    {
        $priceToPay = 1000;
        $subtotal = 1000;
        $discountTotal = 0;

        $this->totalsTransferMock->expects(static::atLeastOnce())
            ->method('getPriceToPay')
            ->willReturn($priceToPay);

        $this->totalsTransferMock->expects(static::atLeastOnce())
            ->method('getSubtotal')
            ->willReturn($subtotal);

        $this->totalsTransferMock->expects(static::atLeastOnce())
            ->method('getDiscountTotal')
            ->willReturn($discountTotal);

        static::assertEquals(
            [
                'p' => (float)$priceToPay,
                's' => (float)$subtotal,
                'd' => (float)$discountTotal,
            ],
            $this->variableExtractor->extractFromTotals($this->totalsTransferMock)
        );
    }
}
