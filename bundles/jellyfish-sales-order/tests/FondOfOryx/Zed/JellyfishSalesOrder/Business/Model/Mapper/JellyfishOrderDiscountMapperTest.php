<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderDiscountMapper;
use Generated\Shared\Transfer\JellyfishOrderDiscountTransfer;
use Orm\Zed\Sales\Persistence\SpySalesDiscount;
use Orm\Zed\Sales\Persistence\SpySalesDiscountCode;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

class JellyfishOrderDiscountMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderDiscountMapperInterface
     */
    protected $jellyfishOrderDiscountMapper;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Sales\Persistence\SpySalesDiscount
     */
    protected $spySalesDiscountMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Sales\Persistence\SpySalesOrderItem
     */
    protected $spySalesOrderItemMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Sales\Persistence\SpySalesDiscountCode
     */
    protected $spySalesDiscountCodeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->spySalesDiscountMock = $this->getMockBuilder(SpySalesDiscount::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderItemMock = $this->getMockBuilder(SpySalesOrderItem::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesDiscountCodeMock = $this->getMockBuilder(SpySalesDiscountCode::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderDiscountMapper = new JellyfishOrderDiscountMapper();
    }

    /**
     * @return void
     */
    public function testFromSalesOrderItem(): void
    {
        $data = [
            'fk_sales_order_item' => 1,
            'name' => 'discount 10',
            'description' => 'discount newsletter',
            'amount' => 1000,
            'quantity' => 1,
            'codes' => [
                $this->spySalesDiscountCodeMock,
            ],
        ];

        $this->spySalesDiscountMock->expects($this->atLeastOnce())
            ->method('getName')
            ->willReturn($data['name']);

        $this->spySalesDiscountMock->expects($this->atLeastOnce())
            ->method('getFkSalesOrderItem')
            ->willReturn($data['fk_sales_order_item']);

        $this->spySalesDiscountMock->expects($this->atLeastOnce())
            ->method('getDescription')
            ->willReturn($data['description']);

        $this->spySalesDiscountMock->expects($this->atLeastOnce())
            ->method('getAmount')
            ->willReturn($data['amount']);

        $this->spySalesDiscountMock->expects($this->atLeastOnce())
            ->method('getOrderItem')
            ->willReturn($this->spySalesOrderItemMock);

        $this->spySalesOrderItemMock->expects($this->atLeastOnce())
            ->method('getQuantity')
            ->willReturn($data['quantity']);

        $this->spySalesDiscountMock->expects($this->atLeastOnce())
            ->method('getDiscountCodes')
            ->willReturn($data['codes']);

        $this->spySalesDiscountCodeMock->expects($this->atLeastOnce())
            ->method('getCode')
            ->willReturn('code-10');

        $jellyfishOrderDiscountTransfer = $this->jellyfishOrderDiscountMapper->fromSalesDiscount($this->spySalesDiscountMock);

        $this->assertInstanceOf(JellyfishOrderDiscountTransfer::class, $jellyfishOrderDiscountTransfer);
        $this->assertEquals($data['name'], $jellyfishOrderDiscountTransfer->getName());
        $this->assertEquals($data['fk_sales_order_item'], $jellyfishOrderDiscountTransfer->getIdSalesOrderItem());
        $this->assertEquals($data['description'], $jellyfishOrderDiscountTransfer->getDescription());
        $this->assertEquals($data['quantity'], $jellyfishOrderDiscountTransfer->getQuantity());
        $this->assertEquals($data['amount'], $jellyfishOrderDiscountTransfer->getUnitAmount());
        $this->assertEquals($data['amount'], $jellyfishOrderDiscountTransfer->getSumAmount());
        $this->assertEquals('code-10', $jellyfishOrderDiscountTransfer->getCode());
    }
}
