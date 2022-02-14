<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Communication\Plugin\JellyfishSalesOrder;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\JellyfishSalesOrderGiftCardConnectorFacade;
use Generated\Shared\Transfer\JellyfishOrderItemTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

class JellyfishSalesOrderGiftCardConnectorOrderItemExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\JellyfishSalesOrderGiftCardConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishOrderItemTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Communication\Plugin\JellyfishSalesOrder\JellyfishSalesOrderGiftCardConnectorOrderItemExpanderPlugin
     */
    protected $plugin;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrderItem|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderItemMock;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(JellyfishSalesOrderGiftCardConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderItemTransferMock = $this->getMockBuilder(JellyfishOrderItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderItemMock = $this->getMockBuilder(SpySalesOrderItem::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new JellyfishSalesOrderGiftCardConnectorOrderItemExpanderPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('expandOrderItem')
            ->with($this->jellyfishOrderItemTransferMock, $this->spySalesOrderItemMock)
            ->willReturn($this->jellyfishOrderItemTransferMock);

        $jellyfishOrderItemTransfer = $this->plugin->expand($this->jellyfishOrderItemTransferMock, $this->spySalesOrderItemMock);

        static::assertInstanceOf(JellyfishOrderItemTransfer::class, $jellyfishOrderItemTransfer);
        static::assertEquals($this->jellyfishOrderItemTransferMock, $jellyfishOrderItemTransfer);
    }
}
