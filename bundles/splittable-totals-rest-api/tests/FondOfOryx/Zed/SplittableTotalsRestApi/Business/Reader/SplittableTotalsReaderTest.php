<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApi\Business\Reader;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableTotalsRestApi\Dependency\Facade\SplittableTotalsRestApiToSplittableTotalsFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer;
use Generated\Shared\Transfer\SplittableTotalsTransfer;

class SplittableTotalsReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApi\Business\Reader\QuoteReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteReaderMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApi\Dependency\Facade\SplittableTotalsRestApiToSplittableTotalsFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableTotalsFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableTotalsRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableTotalsResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\SplittableTotalsTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableTotalsTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApi\Business\Reader\SplittableTotalsReader
     */
    protected $splittableTotalsReader;

    /**
     * @var \ArrayObject|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $totalsListMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->quoteReaderMock = $this->getMockBuilder(QuoteReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableTotalsFacadeMock = $this->getMockBuilder(SplittableTotalsRestApiToSplittableTotalsFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableTotalsRequestTransferMock = $this->getMockBuilder(RestSplittableTotalsRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableTotalsResponseTransferMock = $this->getMockBuilder(RestSplittableTotalsResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableTotalsTransferMock = $this->getMockBuilder(SplittableTotalsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->totalsListMock = $this->getMockBuilder(ArrayObject::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableTotalsReader = new SplittableTotalsReader(
            $this->quoteReaderMock,
            $this->splittableTotalsFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testGetByRestSplittableTotalsRequest(): void
    {
        $this->quoteReaderMock->expects(static::atLeastOnce())
            ->method('getByRestSplittableTotalsRequest')
            ->with($this->restSplittableTotalsRequestTransferMock)
            ->willReturn($this->quoteTransferMock);

        $this->splittableTotalsFacadeMock->expects(static::atLeastOnce())
            ->method('getSplittableTotalsByQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($this->splittableTotalsTransferMock);

        $this->splittableTotalsTransferMock->expects(static::atLeastOnce())
            ->method('getTotalsList')
            ->willReturn($this->totalsListMock);

        $this->totalsListMock->expects(static::atLeastOnce())
            ->method('count')
            ->willReturn(3);

        $restSplittableTotalsResponseTransfer = $this->splittableTotalsReader->getByRestSplittableTotalsRequest(
            $this->restSplittableTotalsRequestTransferMock
        );

        static::assertTrue(
            $restSplittableTotalsResponseTransfer->getIsSuccessful()
        );

        static::assertEquals(
            $this->splittableTotalsTransferMock,
            $restSplittableTotalsResponseTransfer->getSplittableTotals()
        );
    }

    /**
     * @return void
     */
    public function testGetByRestSplittableTotalsRequestWithNonExistingQuote(): void
    {
        $this->quoteReaderMock->expects(static::atLeastOnce())
            ->method('getByRestSplittableTotalsRequest')
            ->with($this->restSplittableTotalsRequestTransferMock)
            ->willReturn(null);

        $this->splittableTotalsFacadeMock->expects(static::never())
            ->method('getSplittableTotalsByQuote');

        $restSplittableTotalsResponseTransfer = $this->splittableTotalsReader->getByRestSplittableTotalsRequest(
            $this->restSplittableTotalsRequestTransferMock
        );

        static::assertFalse(
            $restSplittableTotalsResponseTransfer->getIsSuccessful()
        );

        static::assertEquals(
            null,
            $restSplittableTotalsResponseTransfer->getSplittableTotals()
        );
    }

    /**
     * @return void
     */
    public function testGetByRestSplittableTotalsRequestWithError(): void
    {
        $this->quoteReaderMock->expects(static::atLeastOnce())
            ->method('getByRestSplittableTotalsRequest')
            ->with($this->restSplittableTotalsRequestTransferMock)
            ->willReturn($this->quoteTransferMock);

        $this->splittableTotalsFacadeMock->expects(static::atLeastOnce())
            ->method('getSplittableTotalsByQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($this->splittableTotalsTransferMock);

        $this->splittableTotalsTransferMock->expects(static::atLeastOnce())
            ->method('getTotalsList')
            ->willReturn($this->totalsListMock);

        $this->totalsListMock->expects(static::atLeastOnce())
            ->method('count')
            ->willReturn(0);

        $restSplittableTotalsResponseTransfer = $this->splittableTotalsReader->getByRestSplittableTotalsRequest(
            $this->restSplittableTotalsRequestTransferMock
        );

        static::assertFalse(
            $restSplittableTotalsResponseTransfer->getIsSuccessful()
        );

        static::assertEquals(
            null,
            $restSplittableTotalsResponseTransfer->getSplittableTotals()
        );
    }
}
