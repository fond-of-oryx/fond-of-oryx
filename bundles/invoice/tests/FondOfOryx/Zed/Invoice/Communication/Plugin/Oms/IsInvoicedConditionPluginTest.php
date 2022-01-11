<?php

namespace FondOfOryx\Zed\Invoice\Communication\Plugin\Oms;

use Codeception\Test\Unit;
use FondOfOryx\Zed\Invoice\Persistence\InvoiceRepository;
use Generated\Shared\Transfer\ItemTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

class IsInvoicedConditionPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Sales\Persistence\SpySalesOrderItem
     */
    protected $orderItemMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\Invoice\Persistence\InvoiceRepository
     */
    protected $repositoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Oms\Dependency\Plugin\Condition\ConditionInterface
     */
    protected $plugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ItemTransfer
     */
    protected $itemTransferMock;

    /**
     * @return void
     */
    public function _before(): void
    {
        $this->orderItemMock = $this->getMockBuilder(SpySalesOrderItem::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(InvoiceRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMock = $this->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new IsInvoicedConditionPlugin();
        $this->plugin->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCheck(): void
    {
        $this->orderItemMock->expects(static::atLeastOnce())
            ->method('getIdSalesOrderItem')
            ->willReturn(1);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findInvoiceItemByIdSalesOrderItem')
            ->with(1)
            ->willReturn($this->itemTransferMock);

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getIdInvoiceItem')
            ->willReturn(1);

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getFkInvoice')
            ->willReturn(1);

        static::assertEquals(true, $this->plugin->check($this->orderItemMock));
    }

    /**
     * @return void
     */
    public function testCheckItemTransferNull(): void
    {
        $this->orderItemMock->expects(static::atLeastOnce())
            ->method('getIdSalesOrderItem')
            ->willReturn(1);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findInvoiceItemByIdSalesOrderItem')
            ->with(1)
            ->willReturn(null);

        static::assertEquals(false, $this->plugin->check($this->orderItemMock));
    }

    /**
     * @return void
     */
    public function testCheckIdInvoiceItemNull(): void
    {
        $this->orderItemMock->expects(static::atLeastOnce())
            ->method('getIdSalesOrderItem')
            ->willReturn(1);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findInvoiceItemByIdSalesOrderItem')
            ->with(1)
            ->willReturn($this->itemTransferMock);

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getIdInvoiceItem')
            ->willReturn(null);

        static::assertEquals(false, $this->plugin->check($this->orderItemMock));
    }

    /**
     * @return void
     */
    public function testCheckFkInvoiceNull(): void
    {
        $this->orderItemMock->expects(static::atLeastOnce())
            ->method('getIdSalesOrderItem')
            ->willReturn(1);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findInvoiceItemByIdSalesOrderItem')
            ->with(1)
            ->willReturn($this->itemTransferMock);

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getIdInvoiceItem')
            ->willReturn(1);

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getFkInvoice')
            ->willReturn(null);

        static::assertEquals(false, $this->plugin->check($this->orderItemMock));
    }
}
