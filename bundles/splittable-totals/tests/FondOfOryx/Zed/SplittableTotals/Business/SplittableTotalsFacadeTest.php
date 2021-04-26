<?php

namespace FondOfOryx\Zed\SplittableTotals\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableTotals\Business\Reader\SplittableTotalsReaderInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SplittableTotalsTransfer;

class SplittableTotalsFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotals\Business\SplittableTotalsBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $businessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotals\Business\Reader\SplittableTotalsReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableTotalsReaderMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\SplittableTotalsTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableTotalsTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotals\Business\SplittableTotalsFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactoryMock = $this->getMockBuilder(SplittableTotalsBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableTotalsReaderMock = $this->getMockBuilder(SplittableTotalsReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableTotalsTransferMock = $this->getMockBuilder(SplittableTotalsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new SplittableTotalsFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testGetSplittableTotalsBySplittableTotalsRequest(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createSplittableTotalsReader')
            ->willReturn($this->splittableTotalsReaderMock);

        $this->splittableTotalsReaderMock->expects(static::atLeastOnce())
            ->method('getByQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($this->splittableTotalsTransferMock);

        static::assertEquals(
            $this->splittableTotalsTransferMock,
            $this->facade->getSplittableTotalsByQuote(
                $this->quoteTransferMock
            )
        );
    }
}
