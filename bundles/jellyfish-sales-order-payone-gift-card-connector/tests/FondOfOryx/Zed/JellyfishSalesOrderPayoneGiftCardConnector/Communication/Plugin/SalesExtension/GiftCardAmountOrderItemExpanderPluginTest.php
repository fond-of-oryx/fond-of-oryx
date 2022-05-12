<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Communication\Plugin\SalesExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\JellyfishSalesOrderPayoneGiftCardConnectorFacade;
use Generated\Shared\Transfer\ItemTransfer;

class GiftCardAmountOrderItemExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\JellyfishSalesOrderPayoneGiftCardConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $itemTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Communication\Plugin\SalesExtension\GiftCardAmountOrderItemExpanderPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(JellyfishSalesOrderPayoneGiftCardConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMock = $this->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new GiftCardAmountOrderItemExpanderPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $itemTransferMocks = [$this->itemTransferMock];

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('expandOrderItems')
            ->with($itemTransferMocks)
            ->willReturn($itemTransferMocks);

        static::assertEquals(
            $itemTransferMocks,
            $this->plugin->expand($itemTransferMocks),
        );
    }
}
