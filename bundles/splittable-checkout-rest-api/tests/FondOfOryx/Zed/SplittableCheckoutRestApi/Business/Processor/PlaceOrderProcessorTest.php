<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Processor;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Reader\QuoteReaderInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableCheckoutFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer;

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
    protected $restSplittableCheckoutResponseTransferMock;

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

        $this->restSplittableCheckoutResponseTransferMock = $this->getMockBuilder(RestSplittableCheckoutResponseTransfer::class)
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
        $this->quoteReaderMock->expects(static::atLeastOnce())
            ->method('getByRestSplittableCheckoutRequest')
            ->with($this->restSplittableCheckoutRequestTransferMock)
            ->willReturn($this->quoteTransferMock);

        $this->splittableCheckoutFacadeMock->expects(static::atLeastOnce())
            ->method('placeOrder')
            ->with($this->quoteTransferMock)
            ->willReturn($this->restSplittableCheckoutResponseTransferMock);

        $this->restSplittableCheckoutResponseTransferMock->expects(static::atLeastOnce())
            ->method('getOrderReferences')
            ->willReturn([]);

        static::assertEquals(
            RestSplittableCheckoutResponseTransfer::class,
            $this->placeOrderProcessor->placeOrder($this->restSplittableCheckoutResponseTransferMock)
        );
    }
}
