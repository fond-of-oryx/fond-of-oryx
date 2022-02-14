<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Communication\Plugin\JellyfishSalesOrder;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\JellyfishSalesOrderGiftCardConnectorFacade;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class GiftCardItemsSplitJellyfishOrderPostMapPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\JellyfishSalesOrderGiftCardConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishOrderTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Communication\Plugin\JellyfishSalesOrder\GiftCardItemsSplitJellyfishOrderPostMapPlugin
     */
    protected $plugin;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderMock;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(JellyfishSalesOrderGiftCardConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderTransferMock = $this->getMockBuilder(JellyfishOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderMock = $this->getMockBuilder(SpySalesOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new GiftCardItemsSplitJellyfishOrderPostMapPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testPostMap(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('splitGiftCardOrderItems')
            ->with($this->jellyfishOrderTransferMock, $this->spySalesOrderMock)
            ->willReturn($this->jellyfishOrderTransferMock);

        $jellyfishOrderTransfer = $this->plugin->postMap(
            $this->jellyfishOrderTransferMock,
            $this->spySalesOrderMock,
        );

        static::assertInstanceOf(JellyfishOrderTransfer::class, $jellyfishOrderTransfer);
        static::assertEquals($this->jellyfishOrderTransferMock, $jellyfishOrderTransfer);
    }
}
