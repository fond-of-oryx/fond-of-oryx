<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Cart\Business\CartFacadeInterface;

class SplittableCheckoutRestApiToCartFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Cart\Business\CartFacadeInterface
     */
    protected MockObject|CartFacadeInterface $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected QuoteTransfer|MockObject $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected QuoteResponseTransfer|MockObject $quoteResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToCartFacadeBridge
     */
    protected SplittableCheckoutRestApiToCartFacadeBridge $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CartFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteResponseTransferMock = $this->getMockBuilder(QuoteResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new SplittableCheckoutRestApiToCartFacadeBridge(
            $this->facadeMock,
        );
    }

    /**
     * @return void
     */
    public function testValidateQuote(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('validateQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteResponseTransferMock);

        static::assertEquals(
            $this->quoteResponseTransferMock,
            $this->bridge->validateQuote($this->quoteTransferMock),
        );
    }
}
