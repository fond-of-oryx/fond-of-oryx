<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\PreCheck;

use Codeception\Test\Unit;
use DateTime;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToProductBridge;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class SubscribersNotifierProductAttributeLaunchDateInPastOrIsEmptyCheckTest extends Unit
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
     * @var \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\PreCheck\SubscribersNotifierProductAttributeLaunchDateInPastOrIsEmptyCheckInterface
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

        $this->handler = new SubscribersNotifierProductAttributeLaunchDateInPastOrIsEmptyCheck($this->productFacadeMock);
    }

    /**
     * @return void
     */
    public function testCheckHasProductAttributeLaunchDateInPastOrIsEmptyWillReturnTrue(): void
    {
        $attributes = [
            'launch_date' => (new DateTime())->format('Y-m-d'),
        ];

        $this->productFacadeMock->expects(static::once())->method('findProductAbstractById')->willReturn($this->productAbstractTransferMock);
        $this->subscriptionTransferMock->expects(static::once())->method('getFkProductAbstract')->willReturn(1);
        $this->productAbstractTransferMock->expects(static::exactly(4))->method('getAttributes')->willReturn($attributes);

        $return = $this->handler->checkHasProductAttributeLaunchDateInPastOrIsEmpty($this->subscriptionTransferMock);

        static::assertTrue($return);
    }

    /**
     * @return void
     */
    public function testCheckHasProductAttributeLaunchDateInPastOrIsEmptyWillReturnFalseSinceProductWasNotFound(): void
    {
        $this->productFacadeMock->expects(static::once())->method('findProductAbstractById')->willReturn(null);
        $this->subscriptionTransferMock->expects(static::once())->method('getFkProductAbstract')->willReturn(1);

        $return = $this->handler->checkHasProductAttributeLaunchDateInPastOrIsEmpty($this->subscriptionTransferMock);

        static::assertFalse($return);
    }

    /**
     * @return void
     */
    public function testCheckHasProductAttributeLaunchDateInPastOrIsEmptyWillReturnTrueSinceNoLaunchDate(): void
    {
        $attributes = [
            'launch_date' => '',
        ];

        $this->productFacadeMock->expects(static::once())->method('findProductAbstractById')->willReturn($this->productAbstractTransferMock);
        $this->subscriptionTransferMock->expects(static::once())->method('getFkProductAbstract')->willReturn(1);
        $this->productAbstractTransferMock->expects(static::atLeastOnce())->method('getAttributes')->willReturn($attributes);

        $return = $this->handler->checkHasProductAttributeLaunchDateInPastOrIsEmpty($this->subscriptionTransferMock);

        static::assertTrue($return);
    }
}
