<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Communication\Plugin\JellyfishSalesOrder;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\JellyfishSalesOrderGiftCardConnectorFacade;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class GiftCardRestrictionJellyfishOrderPostMapPluginTest extends Unit
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
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Communication\Plugin\JellyfishSalesOrder\GiftCardRestrictionJellyfishOrderPostMapPlugin
     */
    protected $plugin;

    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
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

        $this->plugin = new GiftCardRestrictionJellyfishOrderPostMapPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testPostMap(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('expandOrderItemsWithGiftCardRestrictionFlag')
            ->with($this->jellyfishOrderTransferMock)
            ->willReturn($this->jellyfishOrderTransferMock);

        $jellyfishOrderTransfer = $this->plugin->postMap(
            $this->jellyfishOrderTransferMock,
            $this->spySalesOrderMock
        );

        static::assertInstanceOf(JellyfishOrderTransfer::class, $jellyfishOrderTransfer);
        static::assertEquals($this->jellyfishOrderTransferMock, $jellyfishOrderTransfer);
    }
}
