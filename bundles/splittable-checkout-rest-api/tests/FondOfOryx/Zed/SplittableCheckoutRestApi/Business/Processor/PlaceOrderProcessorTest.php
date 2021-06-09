<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Processor;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Reader\QuoteReaderInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableCheckoutFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;
use Generated\Shared\Transfer\SplittableCheckoutResponseTransfer;

class PlaceOrderProcessorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Processor\PlaceOrderProcessor
     */
    protected $placeOrderProcessor;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject[]|\FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableCheckoutFacadeInterface
     */
    protected $splittableCheckoutFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject[]|\Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer
     */
    protected $restSplittableCheckoutRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject[]|\Generated\Shared\Transfer\SplittableCheckoutResponseTransfer
     */
    protected $splittableCheckoutResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Reader\QuoteReaderInterface
     */
    protected $quoteReaderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject[]|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->quoteReaderMock = $this->getMockBuilder(QuoteReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutRequestTransferMock = $this->getMockBuilder(RestSplittableCheckoutRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutResponseTransferMock = $this->getMockBuilder(SplittableCheckoutResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutFacadeMock = $this->getMockBuilder(SplittableCheckoutRestApiToSplittableCheckoutFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->placeOrderProcessor = new PlaceOrderProcessor(
            $this->quoteReaderMock,
            $this->splittableCheckoutFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testPlaceOrder(): void
    {
        $orderReferences = ['FOO-1'];

        $this->quoteReaderMock->expects(static::atLeastOnce())
            ->method('getByRestSplittableCheckoutRequest')
            ->with($this->restSplittableCheckoutRequestTransferMock)
            ->willReturn($this->quoteTransferMock);

        $this->splittableCheckoutFacadeMock->expects(static::atLeastOnce())
            ->method('placeOrder')
            ->with($this->quoteTransferMock)
            ->willReturn($this->splittableCheckoutResponseTransferMock);

        $this->splittableCheckoutResponseTransferMock->expects(static::atLeastOnce())
            ->method('getOrderReferences')
            ->willReturn($orderReferences);

        $this->splittableCheckoutResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccess')
            ->willReturn(true);

        $restSplittableCheckoutResponseTransfer = $this->placeOrderProcessor
           ->placeOrder($this->restSplittableCheckoutRequestTransferMock);

        static::assertNotEquals(
            null,
            $restSplittableCheckoutResponseTransfer->getSplittableCheckout()
        );

        static::assertEquals(
            $orderReferences,
            $restSplittableCheckoutResponseTransfer->getSplittableCheckout()->getOrderReferences()
        );
    }
}
