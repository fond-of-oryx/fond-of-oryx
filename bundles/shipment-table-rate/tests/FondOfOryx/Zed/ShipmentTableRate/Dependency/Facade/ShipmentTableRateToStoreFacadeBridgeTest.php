<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\StoreTransfer;
use Spryker\Zed\Store\Business\StoreFacadeInterface;

class ShipmentTableRateToStoreFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Store\Business\StoreFacadeInterface
     */
    protected $storeFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\StoreTransfer
     */
    protected $storeTransferMock;

    /**
     * @var \FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToStoreFacadeBridge
     */
    protected $shipmentTableRateToStoreFacadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->storeFacadeMock = $this->getMockBuilder(StoreFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeTransferMock = $this->getMockBuilder(StoreTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentTableRateToStoreFacadeBridge = new ShipmentTableRateToStoreFacadeBridge(
            $this->storeFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testGetStoreByIso2Code(): void
    {
        $storeName = 'STORE';

        $this->storeFacadeMock->expects($this->atLeastOnce())
            ->method('getStoreByName')
            ->with($storeName)
            ->willReturn($this->storeTransferMock);

        $storeTransfer = $this->shipmentTableRateToStoreFacadeBridge->getStoreByName($storeName);

        $this->assertEquals($this->storeTransferMock, $storeTransfer);
    }
}
