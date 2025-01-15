<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderDiscount\Communication\Plugin\JellyfishSalesOrderExtension;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesDiscount;
use Orm\Zed\Sales\Persistence\SpySalesDiscountCode;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use PHPUnit\Framework\MockObject\MockObject;

class DiscountJellyfishOrderExpanderPostMapPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Sales\Persistence\SpySalesOrder
     */
    protected MockObject|SpySalesOrder $spySalesOrderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    protected MockObject|JellyfishOrderTransfer $jellyfishOrderTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Sales\Persistence\SpySalesDiscount
     */
    protected MockObject|SpySalesDiscount $spySalesDiscountMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Sales\Persistence\SpySalesOrderItem
     */
    protected MockObject|SpySalesOrderItem $spySalesOrderItemMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Sales\Persistence\SpySalesDiscountCode
     */
    protected MockObject|SpySalesDiscountCode $spySalesDiscountCodeMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderDiscount\Communication\Plugin\JellyfishSalesOrderExtension\DiscountJellyfishOrderExpanderPostMapPlugin
     */
    protected DiscountJellyfishOrderExpanderPostMapPlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->spySalesOrderMock = $this->getMockBuilder(SpySalesOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderTransferMock = $this->getMockBuilder(JellyfishOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesDiscountMock = $this->getMockBuilder(SpySalesDiscount::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderItemMock = $this->getMockBuilder(SpySalesOrderItem::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesDiscountCodeMock = $this->getMockBuilder(SpySalesDiscountCode::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new DiscountJellyfishOrderExpanderPostMapPlugin();
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

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getDiscounts')
            ->willReturn([$this->spySalesDiscountMock]);

        $this->spySalesDiscountMock->expects(static::atLeastOnce())
            ->method('getName')
            ->willReturn($data['name']);

        $this->spySalesDiscountMock->expects(static::atLeastOnce())
            ->method('getFkSalesOrderItem')
            ->willReturn($data['fk_sales_order_item']);

        $this->spySalesDiscountMock->expects(static::atLeastOnce())
            ->method('getDescription')
            ->willReturn($data['description']);

        $this->spySalesDiscountMock->expects(static::atLeastOnce())
            ->method('getAmount')
            ->willReturn($data['amount']);

        $this->spySalesDiscountMock->expects(static::atLeastOnce())
            ->method('getOrderItem')
            ->willReturn($this->spySalesOrderItemMock);

        $this->spySalesOrderItemMock->expects(static::atLeastOnce())
            ->method('getQuantity')
            ->willReturn($data['quantity']);

        $this->spySalesDiscountMock->expects(static::atLeastOnce())
            ->method('getDiscountCodes')
            ->willReturn($data['codes']);

        $this->spySalesDiscountCodeMock->expects(static::atLeastOnce())
            ->method('getCode')
            ->willReturn('code-10');

        $this->jellyfishOrderTransferMock->expects(static::atLeastOnce())
            ->method('setDiscounts')
            ->with(
                static::callback(
                    fn (
                        ArrayObject $jellyfishOrderDiscountTransfers
                    ) => $jellyfishOrderDiscountTransfers->count() === 1
                        && $jellyfishOrderDiscountTransfers->offsetGet(0)->getName() === $data['name']
                        && $jellyfishOrderDiscountTransfers->offsetGet(0)->getIdSalesOrderItem() === $data['fk_sales_order_item']
                        && $jellyfishOrderDiscountTransfers->offsetGet(0)->getDescription() === $data['description']
                        && $jellyfishOrderDiscountTransfers->offsetGet(0)->getQuantity() === $data['quantity']
                        && $jellyfishOrderDiscountTransfers->offsetGet(0)->getUnitAmount() === $data['amount']
                        && $jellyfishOrderDiscountTransfers->offsetGet(0)->getSumAmount() === $data['amount']
                        && $jellyfishOrderDiscountTransfers->offsetGet(0)->getCode() === 'code-10',
                ),
            )->willReturn($this->jellyfishOrderTransferMock);

        static::assertEquals(
            $this->jellyfishOrderTransferMock,
            $this->plugin->expand($this->jellyfishOrderTransferMock, $this->spySalesOrderMock),
        );
    }
}
