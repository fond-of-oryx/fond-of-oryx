<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderProductType\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderProductType\Business\Expander\JellyfishOrderItemExpanderInterface;
use Generated\Shared\Transfer\JellyfishOrderItemTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

class JellyfishSalesOrderProductTypeFacadeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\JellyfishSalesOrderProductType\Business\JellyfishSalesOrderProductTypeBusinessFactory
     */
    protected $factoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\JellyfishSalesOrderProductType\Business\Expander\JellyfishOrderItemExpanderInterface
     */
    protected $jellyfishOrderItemExpanderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\JellyfishOrderItemTransfer
     */
    protected $jellyfishOrderItemTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderProductType\Business\JellyfishSalesOrderProductTypeFacadeInterface
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
        $this->factoryMock = $this->getMockBuilder(JellyfishSalesOrderProductTypeBusinessFactory::class)
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

        $this->facade = new JellyfishSalesOrderProductTypeFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->factoryMock->expects($this->atLeastOnce())
            ->method('createJellyfishOrderItemExpander')
            ->willReturn($this->jellyfishOrderItemExpanderMock);

        $this->jellyfishOrderItemExpanderMock->expects($this->atLeastOnce())
            ->method('expand')
            ->with($this->jellyfishOrderItemTransferMock, $this->spySalesOrderItemMock)
            ->willReturn($this->jellyfishOrderItemTransferMock);

        $jellyfishOrderItemTransferMock = $this->facade->expand(
            $this->jellyfishOrderItemTransferMock,
            $this->spySalesOrderItemMock,
        );

        $this->assertInstanceOf(JellyfishOrderItemTransfer::class, $jellyfishOrderItemTransferMock);
        $this->assertEquals($this->jellyfishOrderItemTransferMock, $jellyfishOrderItemTransferMock);
    }
}
