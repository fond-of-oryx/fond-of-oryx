<?php

namespace FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\RefundTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Zed\Refund\Business\RefundFacade;

class PayoneCreditMemoToRefundBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Refund\Business\RefundFacade
     */
    protected $refundFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Sales\Persistence\SpySalesOrderItem
     */
    protected $salesOrderItemMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Sales\Persistence\SpySalesOrder
     */
    protected $salesOrderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RefundTransfer
     */
    protected $refundTransferMock;

    /**
     * @var \FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToRefundBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->refundFacadeMock = $this->getMockBuilder(RefundFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesOrderItemMock = $this->getMockBuilder(SpySalesOrderItem::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesOrderMock = $this->getMockBuilder(SpySalesOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->refundTransferMock = $this->getMockBuilder(RefundTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new PayoneCreditMemoToRefundBridge($this->refundFacadeMock);
    }

    /**
     * @return void
     */
    public function testCalculateRefund(): void
    {
        //$this->bridge->calculateRefund([$this->salesOrderItemMock], $this->salesOrderMock);
    }

    /**
     * @return void
     */
    public function testSaveRefund(): void
    {
        $this->bridge->saveRefund($this->refundTransferMock);
    }
}
