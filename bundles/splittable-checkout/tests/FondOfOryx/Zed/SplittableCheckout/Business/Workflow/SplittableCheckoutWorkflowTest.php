<?php

namespace FondOfOryx\Zed\SplittableCheckout\Business\Workflow;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableCheckout\Business\Model\QuoteSplitterInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeInterface;
use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\QuoteCollectionTransfer;
use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;
use Generated\Shared\Transfer\SplittableCheckoutResponseTransfer;

class SplittableCheckoutWorkflowTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CheckoutResponseTransfer
     */
    protected $checkoutResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteResponseTransfer
     */
    protected $quoteResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $splittedQuoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckout\Business\Workflow\SplittableCheckoutWorkflow
     */
    protected $splittableCheckoutWorkflow;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface
     */
    protected $checkoutFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\SaveOrderTransfer
     */
    protected $saveOrderTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteCollectionTransfer
     */
    protected $quoteCollectionTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeInterface
     */
    protected $quoteFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteSplitterMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->checkoutFacadeMock = $this->getMockBuilder(SplittableCheckoutToCheckoutFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->saveOrderTransferMock = $this->getMockBuilder(SaveOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittedQuoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteFacadeMock = $this->getMockBuilder(SplittableCheckoutToQuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteSplitterMock = $this->getMockBuilder(QuoteSplitterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteCollectionTransferMock = $this->getMockBuilder(QuoteCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteResponseTransferMock = $this->getMockBuilder(QuoteResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->checkoutResponseTransferMock = $this->getMockBuilder(CheckoutResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutWorkflow = new SplittableCheckoutWorkflow(
            $this->checkoutFacadeMock,
            $this->quoteFacadeMock,
            $this->quoteSplitterMock
        );
    }

    /**
     * @return void
     */
    public function testPlaceOrder(): void
    {
        $quotes = new ArrayObject();
        $quotes->append($this->splittedQuoteTransferMock);

        $this->quoteSplitterMock->expects($this->atLeastOnce())
            ->method('split')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteCollectionTransferMock);

        $this->quoteCollectionTransferMock->expects($this->atLeastOnce())
            ->method('getQuotes')
            ->willReturn($quotes);

        $this->checkoutFacadeMock->expects($this->atLeastOnce())
            ->method('placeOrder')
            ->willReturn($this->checkoutResponseTransferMock);

        $this->checkoutResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccess')
            ->willReturn(true);

        $this->quoteFacadeMock->expects($this->atLeastOnce())
            ->method('deleteQuote')
            ->willReturn($this->quoteResponseTransferMock);

        $this->checkoutResponseTransferMock->expects($this->atLeastOnce())
            ->method('getSaveOrder')
            ->willReturn($this->saveOrderTransferMock);

        $this->saveOrderTransferMock->expects($this->atLeastOnce())
            ->method('getOrderReference')
            ->willReturn('SALE---1');

        $splittableCheckoutResponseTransfer = $this->splittableCheckoutWorkflow->placeOrder($this->quoteTransferMock);

        $this->assertInstanceOf(
            SplittableCheckoutResponseTransfer::class,
            $splittableCheckoutResponseTransfer
        );

        $this->assertEquals(true, $splittableCheckoutResponseTransfer->getIsSuccess());
        $this->assertEquals(['SALE---1'], $splittableCheckoutResponseTransfer->getOrderReferences());
    }
}
