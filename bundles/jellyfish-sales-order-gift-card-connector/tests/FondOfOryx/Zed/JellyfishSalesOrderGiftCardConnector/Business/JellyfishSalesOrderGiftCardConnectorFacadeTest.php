<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander\JellyfishOrderExpanderInterface;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander\JellyfishOrderItemExpanderInterface;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Splitter\JellyfishOrderItemsSplitterInterface;
use Generated\Shared\Transfer\JellyfishOrderItemTransfer;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

class JellyfishSalesOrderGiftCardConnectorFacadeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCardProductConnectorBusinessFactory
     */
    protected $factoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander\JellyfishOrderItemExpanderInterface
     */
    protected $jellyfishOrderItemExpanderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander\JellyfishOrderExpanderInterface
     */
    protected $jellyfishOrderExpanderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\JellyfishOrderItemTransfer
     */
    protected $jellyfishOrderItemTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Splitter\JellyfishOrderItemsSplitterInterface
     */
    protected $jellyfishOrderItemsSplitterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    protected $jellyfishOrderTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\JellyfishSalesOrderGiftCardConnectorFacadeInterface
     */
    protected $facade;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Sales\Persistence\SpySalesOrderItem
     */
    protected $spySalesOrderItemMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Sales\Persistence\SpySalesOrder
     */
    protected $spySalesOrderMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->factoryMock = $this->getMockBuilder(JellyfishSalesOrderGiftCardConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderItemExpanderMock = $this->getMockBuilder(JellyfishOrderItemExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderExpanderMock = $this->getMockBuilder(JellyfishOrderExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderItemTransferMock = $this->getMockBuilder(JellyfishOrderItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderTransferMock = $this->getMockBuilder(JellyfishOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderItemsSplitterMock = $this->getMockBuilder(JellyfishOrderItemsSplitterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderItemMock = $this->getMockBuilder(SpySalesOrderItem::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderMock = $this->getMockBuilder(SpySalesOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new JellyfishSalesOrderGiftCardConnectorFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testExpandOrderItem(): void
    {
        $this->factoryMock->expects($this->atLeastOnce())
            ->method('createJellyfishOrderItemExpander')
            ->willReturn($this->jellyfishOrderItemExpanderMock);

        $this->jellyfishOrderItemExpanderMock->expects($this->atLeastOnce())
            ->method('expand')
            ->with($this->jellyfishOrderItemTransferMock, $this->spySalesOrderItemMock)
            ->willReturn($this->jellyfishOrderItemTransferMock);

        $jellyfishOrderItemTransferMock = $this->facade->expandOrderItem(
            $this->jellyfishOrderItemTransferMock,
            $this->spySalesOrderItemMock,
        );

        $this->assertInstanceOf(JellyfishOrderItemTransfer::class, $jellyfishOrderItemTransferMock);
        $this->assertEquals($this->jellyfishOrderItemTransferMock, $jellyfishOrderItemTransferMock);
    }

    /**
     * @return void
     */
    public function testExpandOrder(): void
    {
        $this->factoryMock->expects($this->atLeastOnce())
            ->method('createJellyfishOrderExpander')
            ->willReturn($this->jellyfishOrderExpanderMock);

        $this->jellyfishOrderExpanderMock->expects($this->atLeastOnce())
            ->method('expand')
            ->with($this->jellyfishOrderTransferMock, $this->spySalesOrderMock)
            ->willReturn($this->jellyfishOrderTransferMock);

        $jellyfishOrderTransferMock = $this->facade->expandOrder(
            $this->jellyfishOrderTransferMock,
            $this->spySalesOrderMock,
        );

        $this->assertInstanceOf(JellyfishOrderTransfer::class, $jellyfishOrderTransferMock);
        $this->assertEquals($this->jellyfishOrderTransferMock, $jellyfishOrderTransferMock);
    }

    /**
     * @return void
     */
    public function testExpandOrderItemsWithGiftCardRestrictionFlag(): void
    {
        $this->factoryMock->expects($this->atLeastOnce())
            ->method('createJellyfishOrderExpander')
            ->willReturn($this->jellyfishOrderExpanderMock);

        $this->jellyfishOrderExpanderMock->expects($this->atLeastOnce())
            ->method('expandOrderItemsWithGiftCardRestrictionFlag')
            ->with($this->jellyfishOrderTransferMock)
            ->willReturn($this->jellyfishOrderTransferMock);

        $jellyfishOrderTransferMock = $this->facade->expandOrderItemsWithGiftCardRestrictionFlag(
            $this->jellyfishOrderTransferMock,
        );

        $this->assertInstanceOf(JellyfishOrderTransfer::class, $jellyfishOrderTransferMock);
        $this->assertEquals($this->jellyfishOrderTransferMock, $jellyfishOrderTransferMock);
    }

    /**
     * @return void
     */
    public function testSplitGiftCardOrderItems(): void
    {
        $this->factoryMock->expects($this->atLeastOnce())
            ->method('createJellyfishOrderItemsSplitter')
            ->willReturn($this->jellyfishOrderItemsSplitterMock);

        $this->jellyfishOrderItemsSplitterMock->expects($this->atLeastOnce())
            ->method('splitGiftCardOrderItems')
            ->with($this->jellyfishOrderTransferMock, $this->spySalesOrderMock)
            ->willReturn($this->jellyfishOrderTransferMock);

        $jellyfishOrderTransferMock = $this->facade->splitGiftCardOrderItems(
            $this->jellyfishOrderTransferMock,
            $this->spySalesOrderMock,
        );

        $this->assertInstanceOf(JellyfishOrderTransfer::class, $jellyfishOrderTransferMock);
        $this->assertEquals($this->jellyfishOrderTransferMock, $jellyfishOrderTransferMock);
    }
}
