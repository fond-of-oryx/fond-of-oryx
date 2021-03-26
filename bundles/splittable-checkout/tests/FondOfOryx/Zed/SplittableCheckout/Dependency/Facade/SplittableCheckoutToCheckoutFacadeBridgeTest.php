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
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteResponseTransfer
     */
    protected $quoteResponseTransferMock;

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
            $this->checkoutFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testPlaceOrder(): void
    {
        $this->checkoutFacadeMock->expects($this->atLeastOnce())
            ->method('placeOrder')
            ->with($this->quoteTransferMock)
            ->willReturn($this->checkoutResponseTransferMock);

        $checkoutResponseTransfer = $this->splittableCheckoutToCheckoutFacadeBridge
            ->placeOrder($this->quoteTransferMock);

        $this->assertInstanceOf(
            CheckoutResponseTransfer::class,
            $checkoutResponseTransfer
        );
    }
}
