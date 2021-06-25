<?php

namespace FondOfOryx\Zed\JellyfishThirtyFiveUp\Communication\Plugin;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\JellyfishOrderItemTransfer;
use Generated\Shared\Transfer\JellyfishThirtyFiveUpVendorTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

class JellyfishThirtyFiveUpOrderItemExpanderPostMapPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishThirtyFiveUp\Communication\Plugin\JellyfishThirtyFiveUpOrderItemExpanderPostMapPlugin
     */
    protected $plugin;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrderItem|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $salesOrderItemMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyOrderItemTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->salesOrderItemMock = $this->getMockBuilder(SpySalesOrderItem::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyOrderItemTransferMock = $this->getMockBuilder(JellyfishOrderItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new JellyfishThirtyFiveUpOrderItemExpanderPostMapPlugin();
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $self = $this;

        $this->jellyOrderItemTransferMock->expects($this->once())->method('setVendor')->willReturnCallback(static function ($vendor) use ($self) {
            $self->assertInstanceOf(JellyfishThirtyFiveUpVendorTransfer::class, $vendor);
            $self->assertSame('vendorName', $vendor->getName());
            $self->assertSame('vendorSku', $vendor->getSku());

            return $self->jellyOrderItemTransferMock;
        });

        $this->salesOrderItemMock->expects($this->exactly(2))->method('getVendorSku')->willReturn('vendorSku');
        $this->salesOrderItemMock->expects($this->once())->method('getVendor')->willReturn('vendorName');

        $this->plugin->expand($this->jellyOrderItemTransferMock, $this->salesOrderItemMock);
    }

    /**
     * @return void
     */
    public function testExpandNoVendorSet(): void
    {
        $this->jellyOrderItemTransferMock->expects($this->never())->method('setVendor');
        $this->salesOrderItemMock->expects($this->once())->method('getVendorSku');

        $this->plugin->expand($this->jellyOrderItemTransferMock, $this->salesOrderItemMock);
    }
}
