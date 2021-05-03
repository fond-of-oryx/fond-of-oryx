<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\PreCheck;

use Codeception\Test\Unit;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToProductBridge;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\StoreRelationTransfer;

class SubscribersNotifierHasProductAssignedStoresCheckTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToProductInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriptionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ProductAbstractTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractTransferMock;

    /**
     * @var \Generated\Shared\Transfer\StoreRelationTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $storeRelationTransferMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\PreCheck\SubscribersNotifierHasProductAssignedStoresCheckInterface
     */
    protected $handler;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->productFacadeMock = $this->getMockBuilder(AvailabilityAlertToProductBridge::class)->disableOriginalConstructor()->getMock();
        $this->subscriptionTransferMock = $this->getMockBuilder(AvailabilityAlertSubscriptionTransfer::class)->disableOriginalConstructor()->getMock();
        $this->productAbstractTransferMock = $this->getMockBuilder(ProductAbstractTransfer::class)->disableOriginalConstructor()->getMock();
        $this->storeRelationTransferMock = $this->getMockBuilder(StoreRelationTransfer::class)->disableOriginalConstructor()->getMock();

        $this->handler = new SubscribersNotifierHasProductAssignedStoresCheck($this->productFacadeMock);
    }

    /**
     * @return void
     */
    public function testCheckHasProductAssignedStoresWillReturnTrue(): void
    {
        $this->productFacadeMock->expects(static::once())->method('findProductAbstractById')->willReturn($this->productAbstractTransferMock);
        $this->productAbstractTransferMock->expects(static::once())->method('getStoreRelation')->willReturn($this->storeRelationTransferMock);
        $this->storeRelationTransferMock->expects(static::once())->method('getIdStores')->willReturn([1]);
        $this->subscriptionTransferMock->expects(static::once())->method('getFkProductAbstract')->willReturn(1);

        $return = $this->handler->checkHasProductAssignedStores($this->subscriptionTransferMock);

        static::assertTrue($return);
    }

    /**
     * @return void
     */
    public function testCheckHasProductAssignedStoresWillReturnFalse(): void
    {
        $this->productFacadeMock->expects(static::once())->method('findProductAbstractById')->willReturn($this->productAbstractTransferMock);
        $this->productAbstractTransferMock->expects(static::once())->method('getStoreRelation')->willReturn($this->storeRelationTransferMock);
        $this->storeRelationTransferMock->expects(static::once())->method('getIdStores')->willReturn([]);
        $this->subscriptionTransferMock->expects(static::once())->method('getFkProductAbstract')->willReturn(1);

        $return = $this->handler->checkHasProductAssignedStores($this->subscriptionTransferMock);

        static::assertFalse($return);
    }
}
