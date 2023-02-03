<?php

namespace FondOfOryx\Zed\StockApi\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\StockProductTransfer;
use Spryker\DecimalObject\Decimal;
use Spryker\Zed\Stock\Business\StockFacadeInterface;

class StockApiToStockBridgeTest extends Unit
{
    /**
     * @var \Spryker\Zed\Stock\Business\StockFacadeInterface |\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $stockFacadeMock;

    /**
     * @var \FondOfOryx\Zed\StockApi\Dependency\Facade\StockApiToStockInterface
     */
    protected $stockApiToAvailabilityBridge;

    /**
     * @var \Generated\Shared\Transfer\StockProductTransfer |\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $stockProductTransferMock;

    /**
     * @return void
     */
    public function _before(): void
    {
        $this->stockFacadeMock = $this->getMockBuilder(StockFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $this->stockProductTransferMock = $this->getMockBuilder(StockProductTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->stockApiToAvailabilityBridge = new StockApiToStockBridge($this->stockFacadeMock);
    }

    /**
     * @return void
     */
    public function testFindProductConcreteIdBySku(): void
    {
        $this->stockFacadeMock->expects($this->atLeastOnce())
            ->method('calculateStockForProduct')
            ->willReturn((new Decimal(10)));

        $stock = $this->stockApiToAvailabilityBridge->calculateStockForProduct('sku');

        $this->assertEquals(10, $stock->toInt());
    }

    /**
     * @return void
     */
    public function testIsNeverOutOfStock(): void
    {
        $this->stockFacadeMock->expects($this->atLeastOnce())
            ->method('isNeverOutOfStock')
            ->willReturn(false);

        $isNeverOutOfStock = $this->stockApiToAvailabilityBridge->isNeverOutOfStock('sku');

        $this->assertEquals(false, $isNeverOutOfStock);
    }

    /**
     * @return void
     */
    public function testCreateStockProduct(): void
    {
        $this->stockFacadeMock->expects($this->atLeastOnce())
            ->method('createStockProduct')
            ->willReturn(1);

        $stock = $this->stockApiToAvailabilityBridge->createStockProduct($this->stockProductTransferMock);

        $this->assertEquals(1, $stock);
    }

    /**
     * @return void
     */
    public function testUpdateStockProduct(): void
    {
        $this->stockFacadeMock->expects($this->atLeastOnce())
            ->method('updateStockProduct')
            ->willReturn(1);

        $stock = $this->stockApiToAvailabilityBridge->updateStockProduct($this->stockProductTransferMock);

        $this->assertEquals(1, $stock);
    }

    /**
     * @return void
     */
    public function testGetAvailableStockTypes(): void
    {
        $this->stockFacadeMock->expects($this->atLeastOnce())
            ->method('getAvailableStockTypes')
            ->willReturn([]);

        $stockTypes = $this->stockApiToAvailabilityBridge->getAvailableStockTypes();

        $this->assertIsArray($stockTypes);
    }

    /**
     * @return void
     */
    public function testGetStockProductsByIdProduct(): void
    {
        $this->stockFacadeMock->expects($this->atLeastOnce())
            ->method('getStockProductsByIdProduct')
            ->willReturn([$this->stockProductTransferMock]);

        $stockProducts = $this->stockApiToAvailabilityBridge->getStockProductsByIdProduct(1);

        $this->assertInstanceOf(StockProductTransfer::class, $stockProducts[0]);
    }
}
