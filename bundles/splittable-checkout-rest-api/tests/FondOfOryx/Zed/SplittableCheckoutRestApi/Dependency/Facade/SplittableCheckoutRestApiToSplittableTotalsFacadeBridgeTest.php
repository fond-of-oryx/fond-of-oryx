<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableTotals\Business\SplittableTotalsFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SplittableTotalsTransfer;

class SplittableCheckoutRestApiToSplittableTotalsFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotals\Business\SplittableTotalsFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableTotalsFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\SplittableTotalsTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableTotalsTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableTotalsFacadeBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->splittableTotalsFacadeMock = $this->getMockBuilder(SplittableTotalsFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableTotalsTransferMock = $this->getMockBuilder(SplittableTotalsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new SplittableCheckoutRestApiToSplittableTotalsFacadeBridge(
            $this->splittableTotalsFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testPlaceOrder(): void
    {
        $this->splittableTotalsFacadeMock->expects(static::atLeastOnce())
            ->method('getSplittableTotalsByQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($this->splittableTotalsTransferMock);

        static::assertEquals(
            $this->splittableTotalsTransferMock,
            $this->bridge->getSplittableTotalsByQuote($this->quoteTransferMock),
        );
    }
}
