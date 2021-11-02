<?php

namespace FondOfOryx\Zed\SplittableQuote\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableQuote\Business\Splitter\QuoteSplitterInterface;
use Generated\Shared\Transfer\QuoteTransfer;

class SplittableQuoteFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableQuote\Business\SplittableQuoteBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $businessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\SplittableQuote\Business\Splitter\QuoteSplitter|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteSplitterMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableQuote\Business\SplittableQuoteFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactoryMock = $this->getMockBuilder(SplittableQuoteBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteSplitterMock = $this->getMockBuilder(QuoteSplitterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new SplittableQuoteFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testSplitQuote(): void
    {
        $splittedQuoteTransfers = ['*' => $this->quoteTransferMock];

        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createQuoteSplitter')
            ->willReturn($this->quoteSplitterMock);

        $this->quoteSplitterMock->expects(static::atLeastOnce())
            ->method('split')
            ->with($this->quoteTransferMock)
            ->willReturn($splittedQuoteTransfers);

        static::assertEquals(
            $splittedQuoteTransfers,
            $this->facade->splitQuote(
                $this->quoteTransferMock,
            ),
        );
    }
}
