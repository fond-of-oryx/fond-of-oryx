<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\JellyfishOrderTotalsTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderTotals;

class JellyfishOrderTotalsMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderTotalsMapperInterface
     */
    protected $jellyfishOrderTotalsMapper;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Sales\Persistence\SpySalesOrder
     */
    protected $spySalesOrderMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrderTotals
     */
    protected $spySalesOrderTotalsMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->spySalesOrderMock = $this->getMockBuilder(SpySalesOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderTotalsMock = $this->getMockBuilder(SpySalesOrderTotals::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderTotalsMapper = new JellyfishOrderTotalsMapper();
    }

    /**
     * @return void
     */
    public function testFromSalesOrder(): void
    {
        $data = [
            'expense_total' => 990,
            'discount_total' => 0,
            'tax_total' => 240,
            'subtotal' => 1000,
            'grandtotal' => 1990,
        ];

        if (!method_exists($this->spySalesOrderMock, 'getLastOrderTotals')) {
            self::markTestSkipped();
        }

        $this->spySalesOrderMock->expects($this->atLeastOnce())
            ->method('getLastOrderTotals')
            ->willReturn($this->spySalesOrderTotalsMock);

        $this->spySalesOrderTotalsMock->expects($this->atLeastOnce())
            ->method('getOrderExpenseTotal')
            ->willReturn($data['expense_total']);

        $this->spySalesOrderTotalsMock->expects($this->atLeastOnce())
            ->method('getDiscountTotal')
            ->willReturn($data['discount_total']);

        $this->spySalesOrderTotalsMock->expects($this->atLeastOnce())
            ->method('getTaxTotal')
            ->willReturn($data['tax_total']);

        $this->spySalesOrderTotalsMock->expects($this->atLeastOnce())
            ->method('getSubtotal')
            ->willReturn($data['subtotal']);

        $this->spySalesOrderTotalsMock->expects($this->atLeastOnce())
            ->method('getGrandTotal')
            ->willReturn($data['grandtotal']);

        $jellyfishOrderTotalsTransfer = $this->jellyfishOrderTotalsMapper->fromSalesOrder($this->spySalesOrderMock);

        $this->assertInstanceOf(JellyfishOrderTotalsTransfer::class, $jellyfishOrderTotalsTransfer);
        $this->assertEquals($data['expense_total'], $jellyfishOrderTotalsTransfer->getExpenseTotal());
        $this->assertEquals($data['discount_total'], $jellyfishOrderTotalsTransfer->getDiscountTotal());
        $this->assertEquals($data['tax_total'], $jellyfishOrderTotalsTransfer->getTaxTotal());
        $this->assertEquals($data['subtotal'], $jellyfishOrderTotalsTransfer->getSubtotal());
        $this->assertEquals($data['grandtotal'], $jellyfishOrderTotalsTransfer->getGrandTotal());
    }
}
