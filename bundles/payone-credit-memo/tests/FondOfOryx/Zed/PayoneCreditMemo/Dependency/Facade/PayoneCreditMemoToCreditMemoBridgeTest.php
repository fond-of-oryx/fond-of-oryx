<?php

namespace FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CreditMemo\Business\CreditMemoFacade;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

class PayoneCreditMemoToCreditMemoBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CreditMemo\Business\CreditMemoFacade
     */
    protected $creditMemoFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CreditMemoTransfer
     */
    protected $creditMemoTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Sales\Persistence\SpySalesOrderItem
     */
    protected $spySalesOrderItemMock;

    /**
     * @var \FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToCreditMemoInterface
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->creditMemoFacadeMock = $this->getMockBuilder(CreditMemoFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->creditMemoTransferMock = $this->getMockBuilder(CreditMemoTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderItemMock = $this->getMockBuilder(SpySalesOrderItem::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new PayoneCreditMemoToCreditMemoBridge($this->creditMemoFacadeMock);
    }

    /**
     * @return void
     */
    public function testUpdateCreditMemo(): void
    {
        $creditMemoResponseTransfer = $this->bridge->updateCreditMemo($this->creditMemoTransferMock);

        static::assertNull($creditMemoResponseTransfer->getIsSuccess());
    }

    /**
     * @return void
     */
    public function testGetSalesOrderByCreditMemo(): void
    {
        static::assertInstanceOf(SpySalesOrder::class, $this->bridge->getSalesOrderByCreditMemo($this->creditMemoTransferMock));
    }

    /**
     * @return void
     */
    public function testGetCreditMemoBySalesOrderId(): void
    {
        static::assertEquals([], $this->bridge->getCreditMemosBySalesOrderItems([$this->spySalesOrderItemMock]));
    }

    /**
     * @return void
     */
    public function testGetSalesOrderItemsByCreditMemo(): void
    {
        static::assertNull($this->bridge->getSalesOrderItemsByCreditMemo($this->creditMemoTransferMock));
    }
}
