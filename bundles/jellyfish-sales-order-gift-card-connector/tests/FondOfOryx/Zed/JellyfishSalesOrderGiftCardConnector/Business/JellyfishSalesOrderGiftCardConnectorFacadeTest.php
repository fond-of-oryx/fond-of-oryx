<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander\JellyfishOrderItemExpanderInterface;
use Generated\Shared\Transfer\JellyfishOrderItemTransfer;
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
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\JellyfishOrderItemTransfer
     */
    protected $jellyfishOrderItemTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\JellyfishSalesOrderGiftCardConnectorFacadeInterface
     */
    protected $facade;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Sales\Persistence\SpySalesOrderItem
     */
    protected $spySalesOrderItemMock;

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

        $this->jellyfishOrderItemTransferMock = $this->getMockBuilder(JellyfishOrderItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderItemMock = $this->getMockBuilder(SpySalesOrderItem::class)
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
            $this->spySalesOrderItemMock
        );

        $this->assertInstanceOf(JellyfishOrderItemTransfer::class, $jellyfishOrderItemTransferMock);
        $this->assertEquals($this->jellyfishOrderItemTransferMock, $jellyfishOrderItemTransferMock);
    }
}
