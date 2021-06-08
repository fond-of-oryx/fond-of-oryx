<?php

namespace FondOfOryx\Zed\SplittableCheckout\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableQuote\Business\SplittableQuoteFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;

class SplittableCheckoutToSplittableQuoteFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\SplittableQuote\Business\SplittableQuoteFacadeInterface
     */
    protected $splittableQuoteFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToSplittableQuoteFacadeBridge
     */
    protected $splittableCheckoutToSplittableQuoteFacadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->splittableQuoteFacadeMock = $this->getMockBuilder(SplittableQuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutToSplittableQuoteFacadeBridge = new SplittableCheckoutToSplittableQuoteFacadeBridge(
            $this->splittableQuoteFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testDeleteQuote(): void
    {
        $splittedQuoteTransfers = ['*' => $this->quoteTransferMock];

        $this->splittableQuoteFacadeMock->expects(static::atLeastOnce())
            ->method('splitQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($splittedQuoteTransfers);

        static::assertEquals(
            $splittedQuoteTransfers,
            $this->splittableCheckoutToSplittableQuoteFacadeBridge->splitQuote($this->quoteTransferMock)
        );
    }
}
