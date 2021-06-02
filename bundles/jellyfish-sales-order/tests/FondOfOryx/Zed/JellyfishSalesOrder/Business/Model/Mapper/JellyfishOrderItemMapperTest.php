<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderItemMapper;
use Generated\Shared\Transfer\JellyfishOrderItemTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

class JellyfishOrderItemMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderItemMapperInterface
     */
    protected $jellyfishOrderItemMapper;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Sales\Persistence\SpySalesOrderItem
     */
    protected $spySalesOrderItemMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->spySalesOrderItemMock = $this->getMockBuilder(SpySalesOrderItem::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderItemMapper = new JellyfishOrderItemMapper([]);
    }

    /**
     * @return void
     */
    public function testFromSalesOrderItem(): void
    {
        $data = [
            'quantity' => 1,
            'id_sales_order_item' => 1,
            'name' => 'product 1',
            'tax_rate' => 19,
            'price' => 1990,
            'getPriceToPayAggregation' => 1990,
            'tax_amount' => 250,
            'discount_amount_aggregation' => 0,
            'discount_amount_full_aggregation' => 0,
        ];

        $this->spySalesOrderItemMock->expects($this->atLeastOnce())
            ->method('getQuantity')
            ->willReturn($data['quantity']);

        $this->spySalesOrderItemMock->expects($this->atLeastOnce())
            ->method('getIdSalesOrderItem')
            ->willReturn($data['id_sales_order_item']);

        $this->spySalesOrderItemMock->expects($this->atLeastOnce())
            ->method('getName')
            ->willReturn($data['name']);

        $this->spySalesOrderItemMock->expects($this->atLeastOnce())
            ->method('getTaxRate')
            ->willReturn($data['tax_rate']);

        $this->spySalesOrderItemMock->expects($this->atLeastOnce())
            ->method('getPrice')
            ->willReturn($data['price']);

        $this->spySalesOrderItemMock->expects($this->atLeastOnce())
            ->method('getPriceToPayAggregation')
            ->willReturn($data['getPriceToPayAggregation']);

        $this->spySalesOrderItemMock->expects($this->atLeastOnce())
            ->method('getTaxAmount')
            ->willReturn($data['tax_amount']);

        $this->spySalesOrderItemMock->expects($this->atLeastOnce())
            ->method('getDiscountAmountAggregation')
            ->willReturn($data['discount_amount_aggregation']);

        $this->spySalesOrderItemMock->expects($this->atLeastOnce())
            ->method('getDiscountAmountFullAggregation')
            ->willReturn($data['discount_amount_full_aggregation']);

        $jellyfishOrderItemTransfer = $this->jellyfishOrderItemMapper->fromSalesOrderItem($this->spySalesOrderItemMock);

        $this->assertInstanceOf(JellyfishOrderItemTransfer::class, $jellyfishOrderItemTransfer);
        $this->assertEquals($data['id_sales_order_item'], $jellyfishOrderItemTransfer->getId());
        $this->assertEquals($data['name'], $jellyfishOrderItemTransfer->getName());
        $this->assertEquals($data['price'], $jellyfishOrderItemTransfer->getUnitPrice());
        $this->assertEquals($data['quantity'], $jellyfishOrderItemTransfer->getQuantity());
    }
}
