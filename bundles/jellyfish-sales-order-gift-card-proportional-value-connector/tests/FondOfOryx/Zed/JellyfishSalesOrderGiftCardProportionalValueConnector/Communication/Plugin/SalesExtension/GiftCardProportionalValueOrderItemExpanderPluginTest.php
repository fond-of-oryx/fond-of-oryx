<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Communication\Plugin\SalesExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\JellyfishSalesOrderGiftCardProportionalValueConnectorFacade;
use Generated\Shared\Transfer\ItemTransfer;

class GiftCardProportionalValueOrderItemExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\JellyfishSalesOrderGiftCardProportionalValueConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $itemTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Communication\Plugin\SalesExtension\GiftCardProportionalValueOrderItemExpanderPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(JellyfishSalesOrderGiftCardProportionalValueConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMock = $this->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new GiftCardProportionalValueOrderItemExpanderPlugin();
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
