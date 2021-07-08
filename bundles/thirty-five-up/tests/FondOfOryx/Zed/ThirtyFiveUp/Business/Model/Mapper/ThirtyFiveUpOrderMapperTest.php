<?php

namespace FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\ThirtyFiveUp\Dependency\Facade\ThirtyFiveUpToLocaleFacadeBridge;
use FondOfOryx\Zed\ThirtyFiveUp\Dependency\Facade\ThirtyFiveUpToStoreFacadeBridge;
use FondOfOryx\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpRepository;
use FondOfOryx\Zed\ThirtyFiveUp\ThirtyFiveUpConfig;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpOrderItemTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;
use Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrder;

class ThirtyFiveUpOrderMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUp\Dependency\Facade\ThirtyFiveUpToLocaleFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUp\Dependency\Facade\ThirtyFiveUpToStoreFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $storeFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUp\ThirtyFiveUpConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\SaveOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $saveOrderTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpOrderTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ThirtyFiveUpOrderItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpOrderItemTransferMock;

    /**
     * @var \Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpOrderEntityMock;

    /**
     * @var \Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $itemTransferMock;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Mapper\ThirtyFiveUpOrderMapperInterface
     */
    protected $mapper;

    /**
     * @return void
     */
    public function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this
            ->getMockBuilder(ThirtyFiveUpRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeFacadeMock = $this
            ->getMockBuilder(ThirtyFiveUpToLocaleFacadeBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeFacadeMock = $this
            ->getMockBuilder(ThirtyFiveUpToStoreFacadeBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this
            ->getMockBuilder(ThirtyFiveUpConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this
            ->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->saveOrderTransferMock = $this
            ->getMockBuilder(SaveOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->thirtyFiveUpOrderTransferMock = $this
            ->getMockBuilder(ThirtyFiveUpOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->thirtyFiveUpOrderEntityMock = $this
            ->getMockBuilder(FooThirtyFiveUpOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->thirtyFiveUpOrderItemTransferMock = $this
            ->getMockBuilder(ThirtyFiveUpOrderItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMock = $this
            ->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapper = new ThirtyFiveUpOrderMapper(
            $this->configMock,
            $this->localeFacadeMock,
            $this->repositoryMock,
            $this->storeFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testFromQuote(): void
    {
        $currentLocale = 'de_DE';
        $suffix = 'Sku';
        $abstractAttributes = [
            $currentLocale => [
                sprintf('caseable%s', $suffix) => 'lalalasku',
            ],
        ];
        $knownVendor = ['caseable'];
        $items = new ArrayObject();
        $items->append($this->itemTransferMock);
        $this->configMock->expects($this->once())->method('getKnownVendor')->willReturn($knownVendor);
        $this->configMock->expects($this->atLeastOnce())->method('getAttributeSkuSuffix')->willReturn($suffix);
        $this->localeFacadeMock->expects($this->once())->method('getCurrentLocaleName')->willReturn($currentLocale);
        $this->quoteTransferMock->expects($this->once())->method('getItems')->willReturn($items);
        $this->itemTransferMock->expects($this->once())->method('getAbstractAttributes')->willReturn($abstractAttributes);
        $this->itemTransferMock->expects($this->atLeastOnce())->method('getSku')->willReturn('123');
        $this->itemTransferMock->expects($this->atLeastOnce())->method('getFkSalesOrderItem')->willReturn(1);
        $this->storeFacadeMock->expects($this->once())->method('getCurrentStoreName')->willReturn('testStore');
        $this->itemTransferMock->expects($this->never())->method('setQuantity');

        $transfer = $this->mapper->fromQuote($this->quoteTransferMock);

        $this->assertInstanceOf(ThirtyFiveUpOrderTransfer::class, $transfer);
        $this->assertInstanceOf(ThirtyFiveUpOrderItemTransfer::class, $transfer->getVendorItems()[0]);
        $this->assertSame('testStore', $transfer->getStore());
    }

    /**
     * @return void
     */
    public function testFromQuoteMoreItems(): void
    {
        $currentLocale = 'de_DE';
        $suffix = 'Sku';
        $abstractAttributes = [
            $currentLocale => [
                sprintf('caseable%s', $suffix) => 'lalalasku',
            ],
        ];
        $knownVendor = ['caseable'];
        $items = new ArrayObject();
        $items->append($this->itemTransferMock);
        $itemClone = clone $this->itemTransferMock;
        $items->append($itemClone);
        $this->configMock->expects($this->once())->method('getKnownVendor')->willReturn($knownVendor);
        $this->configMock->expects($this->atLeastOnce())->method('getAttributeSkuSuffix')->willReturn($suffix);
        $this->localeFacadeMock->expects($this->once())->method('getCurrentLocaleName')->willReturn($currentLocale);
        $this->quoteTransferMock->expects($this->once())->method('getItems')->willReturn($items);
        $this->itemTransferMock->expects($this->once())->method('getAbstractAttributes')->willReturn($abstractAttributes);
        $this->itemTransferMock->expects($this->atLeastOnce())->method('getSku')->willReturn('123');
        $this->itemTransferMock->expects($this->atLeastOnce())->method('getFkSalesOrderItem')->willReturn(1);
        $this->storeFacadeMock->expects($this->once())->method('getCurrentStoreName')->willReturn('testStore');
        $this->itemTransferMock->expects($this->never())->method('setQuantity');

        $itemClone->expects($this->once())->method('getAbstractAttributes')->willReturn($abstractAttributes);
        $itemClone->expects($this->atLeastOnce())->method('getSku')->willReturn('456');
        $itemClone->expects($this->atLeastOnce())->method('getFkSalesOrderItem')->willReturn(2);

        $transfer = $this->mapper->fromQuote($this->quoteTransferMock);

        $this->assertInstanceOf(ThirtyFiveUpOrderTransfer::class, $transfer);
        $this->assertCount(2, $transfer->getVendorItems());
        $this->assertInstanceOf(ThirtyFiveUpOrderItemTransfer::class, $transfer->getVendorItems()[0]);
        $this->assertInstanceOf(ThirtyFiveUpOrderItemTransfer::class, $transfer->getVendorItems()[1]);
        $this->assertSame('testStore', $transfer->getStore());
    }

    /**
     * @return void
     */
    public function testFromQuoteNo35UpItemAvailable(): void
    {
        $currentLocale = 'de_DE';
        $suffix = 'Sku';
        $abstractAttributes = [
            $currentLocale => [
                'lalala' => 'lalalasku',
            ],
        ];
        $knownVendor = ['caseable'];
        $items = new ArrayObject();
        $items->append($this->itemTransferMock);
        $this->configMock->expects($this->once())->method('getKnownVendor')->willReturn($knownVendor);
        $this->configMock->expects($this->atLeastOnce())->method('getAttributeSkuSuffix')->willReturn($suffix);
        $this->localeFacadeMock->expects($this->once())->method('getCurrentLocaleName')->willReturn($currentLocale);
        $this->quoteTransferMock->expects($this->once())->method('getItems')->willReturn($items);
        $this->itemTransferMock->expects($this->once())->method('getAbstractAttributes')->willReturn($abstractAttributes);
        $this->itemTransferMock->expects($this->atLeastOnce())->method('getSku')->willReturn('123');
        $this->itemTransferMock->expects($this->never())->method('getFkSalesOrderItem')->willReturn(1);
        $this->storeFacadeMock->expects($this->never())->method('getCurrentStoreName')->willReturn('testStore');
        $this->itemTransferMock->expects($this->never())->method('setQuantity');

        $transfer = $this->mapper->fromQuote($this->quoteTransferMock);

        $this->assertNull($transfer);
    }

    /**
     * @return void
     */
    public function testFromQuoteWithFallbackLocale(): void
    {
        $currentLocale = '_';
        $suffix = 'Sku';
        $abstractAttributes = [
            $currentLocale => [
                sprintf('caseable%s', $suffix) => 'lalalasku',
            ],
        ];
        $knownVendor = ['caseable'];
        $items = new ArrayObject();
        $items->append($this->itemTransferMock);
        $this->configMock->expects($this->once())->method('getKnownVendor')->willReturn($knownVendor);
        $this->configMock->expects($this->atLeastOnce())->method('getAttributeSkuSuffix')->willReturn($suffix);
        $this->localeFacadeMock->expects($this->once())->method('getCurrentLocaleName')->willReturn($currentLocale);
        $this->quoteTransferMock->expects($this->once())->method('getItems')->willReturn($items);
        $this->itemTransferMock->expects($this->once())->method('getAbstractAttributes')->willReturn($abstractAttributes);
        $this->itemTransferMock->expects($this->atLeastOnce())->method('getSku')->willReturn('123');
        $this->itemTransferMock->expects($this->atLeastOnce())->method('getFkSalesOrderItem')->willReturn(1);
        $this->storeFacadeMock->expects($this->once())->method('getCurrentStoreName')->willReturn('testStore');
        $this->itemTransferMock->expects($this->never())->method('setQuantity');

        $transfer = $this->mapper->fromQuote($this->quoteTransferMock);

        $this->assertInstanceOf(ThirtyFiveUpOrderTransfer::class, $transfer);
        $this->assertInstanceOf(ThirtyFiveUpOrderItemTransfer::class, $transfer->getVendorItems()[0]);
        $this->assertSame('testStore', $transfer->getStore());
    }

    /**
     * @return void
     */
    public function testFromQuoteWithGroupedItems(): void
    {
        $currentLocale = 'de_DE';
        $suffix = 'Sku';
        $abstractAttributes = [
            $currentLocale => [
                sprintf('caseable%s', $suffix) => 'lalalasku',
            ],
        ];
        $knownVendor = ['caseable'];
        $items = new ArrayObject();
        $items->append($this->itemTransferMock);
        $itemClone = clone $this->itemTransferMock;
        $items->append($itemClone);
        $this->configMock->expects($this->once())->method('getKnownVendor')->willReturn($knownVendor);
        $this->configMock->expects($this->atLeastOnce())->method('getAttributeSkuSuffix')->willReturn($suffix);
        $this->localeFacadeMock->expects($this->once())->method('getCurrentLocaleName')->willReturn($currentLocale);
        $this->quoteTransferMock->expects($this->once())->method('getItems')->willReturn($items);
        $this->itemTransferMock->expects($this->once())->method('getAbstractAttributes')->willReturn($abstractAttributes);
        $this->itemTransferMock->expects($this->atLeastOnce())->method('getSku')->willReturn('123');
        $this->itemTransferMock->expects($this->atLeastOnce())->method('getFkSalesOrderItem')->willReturn(1);
        $this->storeFacadeMock->expects($this->once())->method('getCurrentStoreName')->willReturn('testStore');
        $this->itemTransferMock->expects($this->once())->method('setQuantity');

        $itemClone->expects($this->once())->method('getAbstractAttributes')->willReturn($abstractAttributes);
        $itemClone->expects($this->atLeastOnce())->method('getSku')->willReturn('123');
        $itemClone->expects($this->atLeastOnce())->method('getFkSalesOrderItem')->willReturn(1);

        $transfer = $this->mapper->fromQuote($this->quoteTransferMock);

        $this->assertInstanceOf(ThirtyFiveUpOrderTransfer::class, $transfer);
        $this->assertInstanceOf(ThirtyFiveUpOrderItemTransfer::class, $transfer->getVendorItems()[0]);
        $this->assertCount(1, $transfer->getVendorItems());
        $this->assertSame('testStore', $transfer->getStore());
    }

    /**
     * @return void
     */
    public function testFromSavedOrder(): void
    {
        $this->saveOrderTransferMock->expects($this->once())->method('getOrderReference')->willReturn('123');
        $this->saveOrderTransferMock->expects($this->once())->method('getIdSalesOrder')->willReturn(1);
        $this->storeFacadeMock->expects($this->once())->method('getCurrentStoreName')->willReturn('testStore');
        $this->thirtyFiveUpOrderTransferMock->expects($this->once())->method('setOrderReference')->willReturn($this->thirtyFiveUpOrderTransferMock);
        $this->thirtyFiveUpOrderTransferMock->expects($this->once())->method('setStore')->willReturn($this->thirtyFiveUpOrderTransferMock);
        $this->thirtyFiveUpOrderTransferMock->expects($this->once())->method('setIdSalesOrder')->willReturn($this->thirtyFiveUpOrderTransferMock);

        $this->mapper->fromSavedOrder($this->saveOrderTransferMock, $this->thirtyFiveUpOrderTransferMock);
    }

    /**
     * @return void
     */
    public function testFromEntity(): void
    {
        $this->repositoryMock->expects($this->once())->method('convertOrderEntityToTransfer')->willReturn($this->thirtyFiveUpOrderTransferMock);

        $this->mapper->fromEntity($this->thirtyFiveUpOrderEntityMock);
    }
}
