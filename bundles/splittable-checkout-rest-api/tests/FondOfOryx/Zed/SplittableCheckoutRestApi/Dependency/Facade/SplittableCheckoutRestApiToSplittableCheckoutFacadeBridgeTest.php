<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableCheckout\Business\SplittableCheckoutFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SplittableCheckoutResponseTransfer;

class SplittableCheckoutRestApiToSplittableCheckoutFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableCheckout\Business\SplittableCheckoutFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableCheckoutFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\SplittableCheckoutResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableCheckoutResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableCheckoutFacadeBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->splittableCheckoutFacadeMock = $this->getMockBuilder(SplittableCheckoutFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutResponseTransferMock = $this->getMockBuilder(SplittableCheckoutResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new SplittableCheckoutRestApiToSplittableCheckoutFacadeBridge(
            $this->splittableCheckoutFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testPlaceOrder(): void
    {
        $this->splittableCheckoutFacadeMock->expects(static::atLeastOnce())
            ->method('placeOrder')
            ->with($this->quoteTransferMock)
            ->willReturn($this->splittableCheckoutResponseTransferMock);

        static::assertEquals(
            $this->splittableCheckoutResponseTransferMock,
            $this->bridge->placeOrder($this->quoteTransferMock),
        );
    }
}
