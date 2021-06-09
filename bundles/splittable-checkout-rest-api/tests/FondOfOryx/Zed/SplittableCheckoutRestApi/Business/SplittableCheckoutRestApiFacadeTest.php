<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Processor\PlaceOrderProcessorInterface;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer;

class SplittableCheckoutRestApiFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\SplittableCheckoutRestApiBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $businessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Processor\PlaceOrderProcessorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $placeOrderProcessorMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableCheckoutRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableCheckoutResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\SplittableCheckoutRestApiFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactoryMock = $this->getMockBuilder(SplittableCheckoutRestApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->placeOrderProcessorMock = $this->getMockBuilder(PlaceOrderProcessorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutRequestTransferMock = $this->getMockBuilder(RestSplittableCheckoutRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutResponseTransferMock = $this->getMockBuilder(RestSplittableCheckoutResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new SplittableCheckoutRestApiFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testPlaceOrder(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createPlaceOrderProcessor')
            ->willReturn($this->placeOrderProcessorMock);

        $this->placeOrderProcessorMock->expects(static::atLeastOnce())
            ->method('placeOrder')
            ->with($this->restSplittableCheckoutRequestTransferMock)
            ->willReturn($this->restSplittableCheckoutResponseTransferMock);

        static::assertEquals(
            $this->restSplittableCheckoutResponseTransferMock,
            $this->facade->placeOrder($this->restSplittableCheckoutRequestTransferMock)
        );
    }
}
