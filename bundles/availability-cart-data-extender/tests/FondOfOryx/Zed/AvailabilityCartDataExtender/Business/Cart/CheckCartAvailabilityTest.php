<?php

namespace FondOfOryx\Zed\AvailabilityCartDataExtender\Business\Cart;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\AvailabilityCartDataExtender\Dependency\Facade\AvailabilityCartDataExtenderToAvailabilityCartConnectorFacadeBridge;
use FondOfOryx\Zed\AvailabilityCartDataExtender\Dependency\Facade\AvailabilityCartDataExtenderToAvailabilityFacadeBridge;
use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\CartPreCheckResponseTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\MessageTransfer;
use Generated\Shared\Transfer\ProductConcreteAvailabilityTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Spryker\DecimalObject\Decimal;

class CheckCartAvailabilityTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\AvailabilityCartDataExtender\Dependency\Facade\AvailabilityCartDataExtenderToAvailabilityFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $availabilityFacadeMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityCartDataExtender\Dependency\Facade\AvailabilityCartDataExtenderToAvailabilityCartConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $availabilityCartConnectorFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\CartPreCheckResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $cartPreCheckResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CartChangeTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $cartChangeTransferMock;

    /**
     * @var \Generated\Shared\Transfer\MessageTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $messageTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $itemTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\StoreTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $storeTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ProductConcreteAvailabilityTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productConcreteAvailabilityTransferMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityCartDataExtender\Business\Cart\CheckCartAvailability
     */
    protected $toTest;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->availabilityFacadeMock = $this->getMockBuilder(AvailabilityCartDataExtenderToAvailabilityFacadeBridge::class)->disableOriginalConstructor()->getMock();
        $this->availabilityCartConnectorFacadeMock = $this->getMockBuilder(AvailabilityCartDataExtenderToAvailabilityCartConnectorFacadeBridge::class)->disableOriginalConstructor()->getMock();
        $this->cartPreCheckResponseTransferMock = $this->getMockBuilder(CartPreCheckResponseTransfer::class)->disableOriginalConstructor()->getMock();
        $this->cartChangeTransferMock = $this->getMockBuilder(CartChangeTransfer::class)->disableOriginalConstructor()->getMock();
        $this->messageTransferMock = $this->getMockBuilder(MessageTransfer::class)->disableOriginalConstructor()->getMock();
        $this->itemTransferMock = $this->getMockBuilder(ItemTransfer::class)->disableOriginalConstructor()->getMock();
        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)->disableOriginalConstructor()->getMock();
        $this->storeTransferMock = $this->getMockBuilder(StoreTransfer::class)->disableOriginalConstructor()->getMock();
        $this->productConcreteAvailabilityTransferMock = $this->getMockBuilder(ProductConcreteAvailabilityTransfer::class)->disableOriginalConstructor()->getMock();

        $this->toTest = new CheckCartAvailability($this->availabilityCartConnectorFacadeMock, $this->availabilityFacadeMock);
    }

    /**
     * @return void
     */
    public function testCheckCartAvailabilityWithNoMessages(): void
    {
        $messages = new ArrayObject();
        $this->availabilityCartConnectorFacadeMock->expects(static::once())->method('checkCartAvailability')->willReturn($this->cartPreCheckResponseTransferMock);
        $this->cartPreCheckResponseTransferMock->expects(static::once())->method('getMessages')->willReturn($messages);
        $this->cartChangeTransferMock->expects(static::never())->method('getItems');

        $this->toTest->checkCartAvailability($this->cartChangeTransferMock);
    }

    /**
     * @return void
     */
    public function testCheckCartAvailability(): void
    {
        $messages = new ArrayObject([$this->messageTransferMock]);
        $items = new ArrayObject([$this->itemTransferMock]);
        $this->availabilityCartConnectorFacadeMock->expects(static::once())->method('checkCartAvailability')->willReturn($this->cartPreCheckResponseTransferMock);
        $this->cartPreCheckResponseTransferMock->expects(static::once())->method('getMessages')->willReturn($messages);
        $this->cartChangeTransferMock->expects(static::once())->method('getItems')->willReturn($items);
        $this->messageTransferMock->expects(static::once())->method('getParameters')->willReturn([CheckCartAvailability::SKU_TRANSLATION_PARAMETER => 'sku']);
        $this->itemTransferMock->expects(static::once())->method('getSku')->willReturn('sku');
        $this->itemTransferMock->expects(static::once())->method('getName')->willReturn('name');
        $this->messageTransferMock->expects(static::once())->method('setParameters')->with([CheckCartAvailability::SKU_TRANSLATION_PARAMETER => 'sku', CheckCartAvailability::NAME_TRANSLATION_PARAMETER => 'name'])->willReturnSelf();

        $this->toTest->checkCartAvailability($this->cartChangeTransferMock);
    }

    /**
     * @return void
     */
    public function testAddAvailabilityInformationOnQuoteItemsWithNoItems(): void
    {
        $items = new ArrayObject();
        $this->quoteTransferMock->expects(static::once())->method('requireStore');
        $this->quoteTransferMock->expects(static::once())->method('getStore')->willReturn($this->storeTransferMock);
        $this->quoteTransferMock->expects(static::exactly(2))->method('getItems')->willReturn($items);
        $this->itemTransferMock->expects(static::never())->method('getAmount');

        $this->toTest->addAvailabilityInformationOnQuoteItems($this->quoteTransferMock);
    }

    /**
     * @return void
     */
    public function testAddAvailabilityInformationOnQuoteItems(): void
    {
        $items = new ArrayObject([$this->itemTransferMock]);
        $decimal = new Decimal(1);
        $this->quoteTransferMock->expects(static::once())->method('requireStore');
        $this->quoteTransferMock->expects(static::once())->method('getStore')->willReturn($this->storeTransferMock);
        $this->quoteTransferMock->expects(static::exactly(2))->method('getItems')->willReturn($items);
        $this->itemTransferMock->expects(static::once())->method('getAmount');
        $this->itemTransferMock->expects(static::atLeast(2))->method('getSku')->willReturn('sku');
        $this->itemTransferMock->expects(static::once())->method('getQuantity')->willReturn(1);
        $this->itemTransferMock->expects(static::once())->method('toArray')->willReturn([]);
        $this->availabilityFacadeMock->expects(static::once())->method('isProductSellableForStore')->willReturn(true);
        $this->itemTransferMock->expects(static::once())->method('setAvailability')->with($decimal->toInt())->willReturnSelf();
        $this->itemTransferMock->expects(static::once())->method('setIsBuyable')->with(true)->willReturnSelf();
        $this->availabilityFacadeMock->expects(static::once())->method('findOrCreateProductConcreteAvailabilityBySkuForStore')->willReturn($this->productConcreteAvailabilityTransferMock);
        $this->productConcreteAvailabilityTransferMock->expects(static::once())->method('getAvailability')->willReturn($decimal);

        $this->toTest->addAvailabilityInformationOnQuoteItems($this->quoteTransferMock);
    }
}
