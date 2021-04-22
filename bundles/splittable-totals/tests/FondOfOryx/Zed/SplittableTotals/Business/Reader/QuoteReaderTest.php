<?php

namespace FondOfOryx\Zed\SplittableTotals\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToQuoteFacadeInterface;
use FondOfOryx\Zed\SplittableTotalsExtension\Dependency\Plugin\QuoteExpanderPluginInterface;
use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SplittableTotalsRequestTransfer;

class QuoteReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToQuoteFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteFacadeMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsExtension\Dependency\Plugin\QuoteExpanderPluginInterface[]|\PHPUnit\Framework\MockObject\MockObject[]
     */
    protected $quoteExpanderPluginMocks;

    /**
     * @var \Generated\Shared\Transfer\SplittableTotalsRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableTotalsRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotals\Business\Reader\QuoteReader
     */
    protected $quoteReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->quoteFacadeMock = $this->getMockBuilder(SplittableTotalsToQuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteExpanderPluginMocks = [
            $this->getMockBuilder(QuoteExpanderPluginInterface::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->splittableTotalsRequestTransferMock = $this->getMockBuilder(SplittableTotalsRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteResponseTransferMock = $this->getMockBuilder(QuoteResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteReader = new QuoteReader($this->quoteFacadeMock, $this->quoteExpanderPluginMocks);
    }

    /**
     * @return void
     */
    public function testGetBySplittableTotalsRequest(): void
    {
        $idQuote = 1;

        $this->splittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCart')
            ->willReturn($idQuote);

        $this->quoteFacadeMock->expects(static::atLeastOnce())
            ->method('findQuoteById')
            ->with($idQuote)
            ->willReturn($this->quoteResponseTransferMock);

        $this->quoteResponseTransferMock->expects(static::atLeastOnce())
            ->method('getQuoteTransfer')
            ->willReturn($this->quoteTransferMock);

        $this->quoteResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->quoteExpanderPluginMocks[0]->expects(static::atLeastOnce())
            ->method('expandQuote')
            ->with($this->splittableTotalsRequestTransferMock, $this->quoteTransferMock)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteReader->getBySplittableTotalsRequest($this->splittableTotalsRequestTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testGetBySplittableTotalsRequestWithoutQuoteId(): void
    {
        $this->splittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCart')
            ->willReturn(null);

        $this->quoteFacadeMock->expects(static::never())
            ->method('findQuoteById');

        $this->quoteExpanderPluginMocks[0]->expects(static::never())
            ->method('expandQuote');

        static::assertEquals(
            null,
            $this->quoteReader->getBySplittableTotalsRequest($this->splittableTotalsRequestTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testGetBySplittableTotalsRequestWithNonExistingQuote(): void
    {
        $idQuote = 1;

        $this->splittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCart')
            ->willReturn($idQuote);

        $this->quoteFacadeMock->expects(static::atLeastOnce())
            ->method('findQuoteById')
            ->with($idQuote)
            ->willReturn($this->quoteResponseTransferMock);

        $this->quoteResponseTransferMock->expects(static::atLeastOnce())
            ->method('getQuoteTransfer')
            ->willReturn(null);

        $this->quoteResponseTransferMock->expects(static::never())
            ->method('getIsSuccessful');

        $this->quoteExpanderPluginMocks[0]->expects(static::never())
            ->method('expandQuote');

        static::assertEquals(
            null,
            $this->quoteReader->getBySplittableTotalsRequest($this->splittableTotalsRequestTransferMock)
        );
    }
}
