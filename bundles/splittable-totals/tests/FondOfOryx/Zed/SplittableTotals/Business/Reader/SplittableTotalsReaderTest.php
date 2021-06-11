<?php

namespace FondOfOryx\Zed\SplittableTotals\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToSplittableQuoteFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\TotalsTransfer;

class SplittableTotalsReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToSplittableQuoteFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableQuoteFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\TotalsTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $totalsTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotals\Business\Reader\SplittableTotalsReader
     */
    protected $splittableTotalsReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->splittableQuoteFacadeMock = $this->getMockBuilder(SplittableTotalsToSplittableQuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->totalsTransferMock = $this->getMockBuilder(TotalsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableTotalsReader = new SplittableTotalsReader($this->splittableQuoteFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetBySplittableTotalsRequest(): void
    {
        $key = 'foo';
        $splittedQuoteTransfers = [$key => $this->quoteTransferMock];

        $this->splittableQuoteFacadeMock->expects(static::atLeastOnce())
            ->method('splitQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($splittedQuoteTransfers);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getTotals')
            ->willReturn($this->totalsTransferMock);

        $splittableTotalsResponseTransfer = $this->splittableTotalsReader
            ->getByQuote($this->quoteTransferMock);

        $totalsList = $splittableTotalsResponseTransfer->getTotalsList();

        static::assertCount(1, $totalsList);
        static::assertTrue($totalsList->offsetExists($key));
        static::assertEquals($this->totalsTransferMock, $totalsList->offsetGet($key));
    }
}
