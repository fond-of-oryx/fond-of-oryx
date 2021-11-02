<?php

namespace FondOfOryx\Zed\SplittableCheckout\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Checkout\Business\CheckoutFacade;

class SplittableCheckoutToCheckoutFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Checkout\Business\CheckoutFacade
     */
    protected $checkoutFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CheckoutResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $checkoutResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeBridge
     */
    protected $splittableCheckoutToCheckoutFacadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->checkoutFacadeMock = $this->getMockBuilder(CheckoutFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->checkoutResponseTransferMock = $this->getMockBuilder(CheckoutResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutToCheckoutFacadeBridge = new SplittableCheckoutToCheckoutFacadeBridge(
            $this->checkoutFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testPlaceOrder(): void
    {
        $this->checkoutFacadeMock->expects(static::atLeastOnce())
            ->method('placeOrder')
            ->with($this->quoteTransferMock)
            ->willReturn($this->checkoutResponseTransferMock);

        static::assertEquals(
            $this->checkoutResponseTransferMock,
            $this->splittableCheckoutToCheckoutFacadeBridge->placeOrder($this->quoteTransferMock),
        );
    }
}
