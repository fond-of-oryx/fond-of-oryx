<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Reader;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableTotalsFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer;
use Generated\Shared\Transfer\SplittableTotalsTransfer;

class SplittableTotalsReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Reader\QuoteReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteReaderMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableTotalsFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableTotalsFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableCheckoutRequestTransferMock;

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
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Reader\SplittableTotalsReader
     */
    protected $splittableTotalsReader;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\ArrayObject
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

        $this->splittableTotalsFacadeMock = $this->getMockBuilder(SplittableCheckoutRestApiToSplittableTotalsFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutRequestTransferMock = $this->getMockBuilder(RestSplittableCheckoutRequestTransfer::class)
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
            $this->splittableTotalsFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testGetByRestSplittableCheckoutRequest(): void
    {
        $this->quoteReaderMock->expects(static::atLeastOnce())
            ->method('getByRestSplittableCheckoutRequest')
            ->with($this->restSplittableCheckoutRequestTransferMock)
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

        $restSplittableTotalsResponseTransfer = $this->splittableTotalsReader->getByRestSplittableCheckoutRequest(
            $this->restSplittableCheckoutRequestTransferMock,
        );

        static::assertTrue(
            $restSplittableTotalsResponseTransfer->getIsSuccessful(),
        );

        static::assertEquals(
            $this->splittableTotalsTransferMock,
            $restSplittableTotalsResponseTransfer->getSplittableTotals(),
        );
    }

    /**
     * @return void
     */
    public function testGetByRestSplittableCheckoutRequestWithNonExistingQuote(): void
    {
        $this->quoteReaderMock->expects(static::atLeastOnce())
            ->method('getByRestSplittableCheckoutRequest')
            ->with($this->restSplittableCheckoutRequestTransferMock)
            ->willReturn(null);

        $this->splittableTotalsFacadeMock->expects(static::never())
            ->method('getSplittableTotalsByQuote');

        $restSplittableTotalsResponseTransfer = $this->splittableTotalsReader->getByRestSplittableCheckoutRequest(
            $this->restSplittableCheckoutRequestTransferMock,
        );

        static::assertFalse(
            $restSplittableTotalsResponseTransfer->getIsSuccessful(),
        );

        static::assertEquals(
            null,
            $restSplittableTotalsResponseTransfer->getSplittableTotals(),
        );
    }

    /**
     * @return void
     */
    public function testGetByRestSplittableCheckoutRequestWithError(): void
    {
        $this->quoteReaderMock->expects(static::atLeastOnce())
            ->method('getByRestSplittableCheckoutRequest')
            ->with($this->restSplittableCheckoutRequestTransferMock)
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

        $restSplittableTotalsResponseTransfer = $this->splittableTotalsReader->getByRestSplittableCheckoutRequest(
            $this->restSplittableCheckoutRequestTransferMock,
        );

        static::assertFalse(
            $restSplittableTotalsResponseTransfer->getIsSuccessful(),
        );

        static::assertEquals(
            null,
            $restSplittableTotalsResponseTransfer->getSplittableTotals(),
        );
    }
}
