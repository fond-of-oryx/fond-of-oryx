<?php

namespace FondOfOryx\Zed\SplittableTotals\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableQuote\Business\SplittableQuoteFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;

class SplittableTotalsToSplittableQuoteFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\SplittableQuote\Business\SplittableQuoteFacadeInterface
     */
    protected $splittableQuoteFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToSplittableQuoteFacadeBridge
     */
    protected $facadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->splittableQuoteFacadeMock = $this->getMockBuilder(SplittableQuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeBridge = new SplittableTotalsToSplittableQuoteFacadeBridge($this->splittableQuoteFacadeMock);
    }

    /**
     * @return void
     */
    public function testSplitQuote(): void
    {
        $splittedQuoteTransfers = ['foo' => $this->quoteTransferMock];

        $this->splittableQuoteFacadeMock->expects(static::atLeastOnce())
            ->method('splitQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($splittedQuoteTransfers);

        static::assertEquals(
            $splittedQuoteTransfers,
            $this->facadeBridge->splitQuote($this->quoteTransferMock)
        );
    }
}
