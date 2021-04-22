<?php

namespace FondOfOryx\Zed\SplittableTotals\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\QuoteResponseTransfer;
use Spryker\Zed\Quote\Business\QuoteFacadeInterface;

class SplittableTotalsToQuoteFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Quote\Business\QuoteFacadeInterface
     */
    protected $quoteFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToQuoteFacadeBridge
     */
    protected $facadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->quoteFacadeMock = $this->getMockBuilder(QuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteResponseTransferMock = $this->getMockBuilder(QuoteResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeBridge = new SplittableTotalsToQuoteFacadeBridge($this->quoteFacadeMock);
    }

    /**
     * @return void
     */
    public function testFindQuoteById(): void
    {
        $idQuote = 1;

        $this->quoteFacadeMock->expects(static::atLeastOnce())
            ->method('findQuoteById')
            ->with($idQuote)
            ->willReturn($this->quoteResponseTransferMock);

        static::assertEquals(
            $this->quoteResponseTransferMock,
            $this->facadeBridge->findQuoteById($idQuote)
        );
    }
}
