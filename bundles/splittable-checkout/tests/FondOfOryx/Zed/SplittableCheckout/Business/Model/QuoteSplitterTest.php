<?php

namespace FondOfOryx\Zed\SplittableCheckout\Business\Model;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToPersistentCartFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\SplittableCheckoutConfig;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteCollectionTransfer;
use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class QuoteSplitterTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\SplittableCheckout\SplittableCheckoutConfig
     */
    protected $configMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ItemTransfer
     */
    protected $itemTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckout\Business\Model\QuoteSplitter
     */
    protected $quoteSplitter;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteResponseTransfer
     */
    protected $quoteResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToPersistentCartFacadeInterface
     */
    protected $splittableCheckoutToPersistentCartFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->configMock = $this->getMockBuilder(SplittableCheckoutConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMock = $this->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutToPersistentCartFacadeMock = $this->getMockBuilder(SplittableCheckoutToPersistentCartFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteResponseTransferMock = $this->getMockBuilder(QuoteResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteSplitter = new QuoteSplitter(
            $this->splittableCheckoutToPersistentCartFacadeMock,
            $this->configMock
        );
    }

    /**
     * @return void
     */
    public function testSplit(): void
    {
        $quoteItems = new ArrayObject();
        $quoteItems->append($this->itemTransferMock);
        $splitAttribute = 'split_attribute';

        $this->configMock->expects($this->atLeastOnce())
            ->method('getQuoteSplitQuoteItemAttribute')
            ->willReturn($splitAttribute);

        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getItems')
            ->willReturn($quoteItems);

        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('toArray')
            ->willReturn(
                ['items' => $quoteItems]
            );

        $this->itemTransferMock->expects($this->atLeastOnce())
            ->method('toArray')
            ->willReturn(
                [$splitAttribute => 'value']
            );

        $this->splittableCheckoutToPersistentCartFacadeMock->expects($this->atLeastOnce())
            ->method('createQuote')
            ->willReturn($this->quoteResponseTransferMock);

        $this->quoteResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $quoteCollectionTransfer = $this->quoteSplitter->split($this->quoteTransferMock);

        $this->assertInstanceOf(
            QuoteCollectionTransfer::class,
            $quoteCollectionTransfer
        );

        $this->assertInstanceOf(ArrayObject::class, $quoteCollectionTransfer->getQuotes());
    }
}
