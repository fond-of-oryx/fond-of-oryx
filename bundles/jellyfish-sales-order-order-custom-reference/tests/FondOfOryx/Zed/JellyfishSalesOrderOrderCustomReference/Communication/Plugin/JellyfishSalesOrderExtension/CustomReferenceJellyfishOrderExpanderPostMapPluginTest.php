<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderOrderCustomReference\Communication\Plugin\JellyfishSalesOrderExtension;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class CustomReferenceJellyfishOrderExpanderPostMapPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishOrderTransferMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderOrderCustomReference\Communication\Plugin\JellyfishSalesOrderExtension\CustomReferenceJellyfishOrderExpanderPostMapPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->jellyfishOrderTransferMock = $this->getMockBuilder(JellyfishOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderMock = $this->getMockBuilder(SpySalesOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CustomReferenceJellyfishOrderExpanderPostMapPlugin();
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $orderCustomReference = 'Foo';

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getOrderCustomReference')
            ->willReturn($orderCustomReference);

        $this->jellyfishOrderTransferMock->expects(static::atLeastOnce())
            ->method('setCustomReference')
            ->with($orderCustomReference)
            ->willReturn($this->jellyfishOrderTransferMock);

        static::assertEquals(
            $this->jellyfishOrderTransferMock,
            $this->plugin->expand(
                $this->jellyfishOrderTransferMock,
                $this->spySalesOrderMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithEmptyCartNote(): void
    {
        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getOrderCustomReference')
            ->willReturn(null);

        $this->jellyfishOrderTransferMock->expects(static::never())
            ->method('setCustomReference');

        static::assertEquals(
            $this->jellyfishOrderTransferMock,
            $this->plugin->expand(
                $this->jellyfishOrderTransferMock,
                $this->spySalesOrderMock,
            ),
        );
    }
}
