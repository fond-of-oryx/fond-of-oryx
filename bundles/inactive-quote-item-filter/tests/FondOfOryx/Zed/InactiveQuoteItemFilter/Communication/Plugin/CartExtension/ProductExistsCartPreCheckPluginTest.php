<?php

namespace FondOfOryx\Zed\InactiveQuoteItemFilter\Communication\Plugin\CartExtension;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\InactiveQuoteItemFilter\Persistence\InactiveQuoteItemFilterRepository;
use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class ProductExistsCartPreCheckPluginTest extends Unit
{
    /**
     * @var (\Generated\Shared\Transfer\CartChangeTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CartChangeTransfer|MockObject $cartChangeTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\QuoteTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected QuoteTransfer|MockObject $quoteTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\StoreTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected StoreTransfer|MockObject $storeTransferMock;

    /**
     * @var array<(\Generated\Shared\Transfer\ItemTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $itemTransferMocks;

    /**
     * @var (\FondOfOryx\Zed\InactiveQuoteItemFilter\Persistence\InactiveQuoteItemFilterRepository&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|InactiveQuoteItemFilterRepository $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\InactiveQuoteItemFilter\Communication\Plugin\CartExtension\ProductExistsCartPreCheckPlugin
     */
    protected ProductExistsCartPreCheckPlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->cartChangeTransferMock = $this->getMockBuilder(CartChangeTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeTransferMock = $this->getMockBuilder(StoreTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMocks = [
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->repositoryMock = $this->getMockBuilder(InactiveQuoteItemFilterRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new ProductExistsCartPreCheckPlugin();
        $this->plugin->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCheck(): void
    {
        $storeName = 'FOO';
        $skus = ['12345-67890', '12345-67891'];
        $activeSkus = [$skus[1]];

        $this->cartChangeTransferMock->expects(static::atLeastOnce())
            ->method('getQuote')
            ->willReturn($this->quoteTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getStore')
            ->willReturn($this->storeTransferMock);

        $this->storeTransferMock->expects(static::atLeastOnce())
            ->method('getName')
            ->willReturn($storeName);

        $this->cartChangeTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn(new ArrayObject($this->itemTransferMocks));

        $this->itemTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($skus[0]);

        $this->itemTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($skus[0]);

        $this->itemTransferMocks[2]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($skus[1]);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getActiveSkusByStoreNameAndSkus')
            ->with($storeName, $skus)
            ->willReturn($activeSkus);

        $cartChangeResponseTransfer = $this->plugin->check($this->cartChangeTransferMock);

        static::assertFalse($cartChangeResponseTransfer->getIsSuccess());

        $messageTransfers = $cartChangeResponseTransfer->getMessages();

        static::assertCount(1, $messageTransfers);

        static::assertEquals(
            [ProductExistsCartPreCheckPlugin::MESSAGE_PARAM_SKU => $skus[0]],
            $messageTransfers->offsetGet(0)->getParameters(),
        );

        static::assertEquals(
            ProductExistsCartPreCheckPlugin::MESSAGE_ERROR_CONCRETE_PRODUCT_INACTIVE,
            $messageTransfers->offsetGet(0)->getValue(),
        );
    }

    /**
     * @return void
     */
    public function testCheckWithoutInactiveItems(): void
    {
        $storeName = 'FOO';
        $skus = ['12345-67890', '12345-67891'];
        $activeSkus = $skus;

        $this->cartChangeTransferMock->expects(static::atLeastOnce())
            ->method('getQuote')
            ->willReturn($this->quoteTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getStore')
            ->willReturn($this->storeTransferMock);

        $this->storeTransferMock->expects(static::atLeastOnce())
            ->method('getName')
            ->willReturn($storeName);

        $this->cartChangeTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn(new ArrayObject($this->itemTransferMocks));

        $this->itemTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($skus[0]);

        $this->itemTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($skus[0]);

        $this->itemTransferMocks[2]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($skus[1]);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getActiveSkusByStoreNameAndSkus')
            ->with($storeName, $skus)
            ->willReturn($activeSkus);

        $cartChangeResponseTransfer = $this->plugin->check($this->cartChangeTransferMock);

        static::assertTrue($cartChangeResponseTransfer->getIsSuccess());

        $messageTransfers = $cartChangeResponseTransfer->getMessages();

        static::assertCount(0, $messageTransfers);
    }

    /**
     * @return void
     */
    public function testCheckWithoutStore(): void
    {
        $this->cartChangeTransferMock->expects(static::atLeastOnce())
            ->method('getQuote')
            ->willReturn($this->quoteTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getStore')
            ->willReturn(null);

        $this->cartChangeTransferMock->expects(static::never())
            ->method('getItems');

        $this->repositoryMock->expects(static::never())
            ->method('getActiveSkusByStoreNameAndSkus');

        $cartChangeResponseTransfer = $this->plugin->check($this->cartChangeTransferMock);

        static::assertFalse($cartChangeResponseTransfer->getIsSuccess());

        $messageTransfers = $cartChangeResponseTransfer->getMessages();

        static::assertCount(1, $messageTransfers);

        static::assertEquals(
            ProductExistsCartPreCheckPlugin::MESSAGE_ERROR_MISSING_STORE,
            $messageTransfers->offsetGet(0)->getValue(),
        );
    }

    /**
     * @return void
     */
    public function testCheckWithoutQuote(): void
    {
        $this->cartChangeTransferMock->expects(static::atLeastOnce())
            ->method('getQuote')
            ->willReturn(null);

        $this->cartChangeTransferMock->expects(static::never())
            ->method('getItems');

        $this->repositoryMock->expects(static::never())
            ->method('getActiveSkusByStoreNameAndSkus');

        $cartChangeResponseTransfer = $this->plugin->check($this->cartChangeTransferMock);

        static::assertFalse($cartChangeResponseTransfer->getIsSuccess());

        $messageTransfers = $cartChangeResponseTransfer->getMessages();

        static::assertCount(1, $messageTransfers);

        static::assertEquals(
            ProductExistsCartPreCheckPlugin::MESSAGE_ERROR_MISSING_STORE,
            $messageTransfers->offsetGet(0)->getValue(),
        );
    }
}
