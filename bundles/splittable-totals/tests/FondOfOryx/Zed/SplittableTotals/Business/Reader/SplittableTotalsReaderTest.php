<?php

namespace FondOfOryx\Zed\SplittableTotals\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableTotals\Business\Splitter\QuoteSplitterInterface;
use FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToCalculationFacadeInterface;
use FondOfOryx\Zed\SplittableTotalsExtension\Dependency\Plugin\SplittedQuoteExpanderPluginInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\TotalsTransfer;

class SplittableTotalsReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotals\Business\Splitter\QuoteSplitterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteSplitterMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToCalculationFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $calculationFacadeMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsExtension\Dependency\Plugin\SplittedQuoteExpanderPluginInterface[]|\PHPUnit\Framework\MockObject\MockObject[]
     */
    protected $splittedQuoteExpanderPluginMocks;

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

        $this->quoteSplitterMock = $this->getMockBuilder(QuoteSplitterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->calculationFacadeMock = $this->getMockBuilder(SplittableTotalsToCalculationFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittedQuoteExpanderPluginMocks = [
            $this->getMockBuilder(SplittedQuoteExpanderPluginInterface::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->totalsTransferMock = $this->getMockBuilder(TotalsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableTotalsReader = new SplittableTotalsReader(
            $this->quoteSplitterMock,
            $this->calculationFacadeMock,
            $this->splittedQuoteExpanderPluginMocks
        );
    }

    /**
     * @return void
     */
    public function testGetBySplittableTotalsRequest(): void
    {
        $key = 'foo';

        $this->quoteSplitterMock->expects(static::atLeastOnce())
            ->method('split')
            ->with($this->quoteTransferMock)
            ->willReturn([$key => $this->quoteTransferMock]);

        $this->splittedQuoteExpanderPluginMocks[0]->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteTransferMock);

        $this->calculationFacadeMock->expects(static::atLeastOnce())
            ->method('recalculateQuote')
            ->with($this->quoteTransferMock, false)
            ->willReturn($this->quoteTransferMock);

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
