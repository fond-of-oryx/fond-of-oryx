<?php

namespace FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade;

use Codeception\Test\Unit;
use Spryker\Zed\Sales\Business\SalesFacade;

class PayoneCreditMemoToSalesBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Sales\Business\SalesFacadeInterface
     */
    protected $salesFacadeMock;

    /**
     * @var \FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToSalesInterface
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->salesFacadeMock = $this->getMockBuilder(SalesFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new PayoneCreditMemoToSalesBridge($this->salesFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetOrderByIdSalesOrder(): void
    {
        // $oderTransfer = $this->bridge->getOrderByIdSalesOrder(1);
    }
}
