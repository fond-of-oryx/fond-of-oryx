<?php

namespace FondOfOryx\Zed\ThirtyFiveUp\Communication\Plugin\Sales;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SpySalesOrderItemEntityTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpOrderItemTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpVendorTransfer;

/**
 * @method \FondOfOryx\Zed\ThirtyFiveUp\Business\ThirtyFiveUpFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\ThirtyFiveUp\Business\ThirtyFiveUpBusinessFactory getFactory()
 */
class AddThirtyFiveUpDataToSalesOrderItemExpanderPreSavePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUp\Communication\Plugin\Sales\AddThirtyFiveUpDataToSalesOrderItemExpanderPreSavePlugin
     */
    protected $plugin;

    /**
     * @var \Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $itemTransferMock;

    /**
     * @var \Generated\Shared\Transfer\SpySalesOrderItemEntityTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderItemEntityTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpOrderTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ThirtyFiveUpOrderItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpOrderItemTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ThirtyFiveUpVendorTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpVendorMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->itemTransferMock = $this->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderItemEntityTransferMock = $this->getMockBuilder(SpySalesOrderItemEntityTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->thirtyFiveUpOrderTransferMock = $this->getMockBuilder(ThirtyFiveUpOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->thirtyFiveUpOrderItemTransferMock = $this->getMockBuilder(ThirtyFiveUpOrderItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->thirtyFiveUpVendorMock = $this->getMockBuilder(ThirtyFiveUpVendorTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new AddThirtyFiveUpDataToSalesOrderItemExpanderPreSavePlugin();
    }

    /**
     * @return void
     */
    public function testExpandOrderItem(): void
    {
        $items = new ArrayObject();
        $items->append($this->thirtyFiveUpOrderItemTransferMock);
        $this->quoteTransferMock->expects($this->once())->method('getThirtyFiveUpOrder')->willReturn($this->thirtyFiveUpOrderTransferMock);
        $this->thirtyFiveUpOrderTransferMock->expects($this->once())->method('getVendorItems')->willReturn($items);
        $this->spySalesOrderItemEntityTransferMock->expects($this->once())->method('getSku')->willReturn('abc');
        $this->spySalesOrderItemEntityTransferMock->expects($this->once())->method('setVendor');
        $this->spySalesOrderItemEntityTransferMock->expects($this->once())->method('setVendorSku');
        $this->thirtyFiveUpOrderItemTransferMock->expects($this->once())->method('getShopSku')->willReturn('abc');
        $this->thirtyFiveUpOrderItemTransferMock->expects($this->once())->method('getVendor')->willReturn($this->thirtyFiveUpVendorMock);
        $this->thirtyFiveUpOrderItemTransferMock->expects($this->once())->method('getSku')->willReturn('test');
        $this->thirtyFiveUpVendorMock->expects($this->once())->method('getName')->willReturn('vendor');

        $this->plugin->expandOrderItem($this->quoteTransferMock, $this->itemTransferMock, $this->spySalesOrderItemEntityTransferMock);
    }

    /**
     * @return void
     */
    public function testExpandOrderItemNoThirtyFiveUpOrder(): void
    {
        $this->quoteTransferMock->expects($this->once())->method('getThirtyFiveUpOrder');
        $this->thirtyFiveUpOrderTransferMock->expects($this->never())->method('getVendorItems');

        $return = $this->plugin->expandOrderItem($this->quoteTransferMock, $this->itemTransferMock, $this->spySalesOrderItemEntityTransferMock);

        $this->assertInstanceOf(SpySalesOrderItemEntityTransfer::class, $return);
    }
}
