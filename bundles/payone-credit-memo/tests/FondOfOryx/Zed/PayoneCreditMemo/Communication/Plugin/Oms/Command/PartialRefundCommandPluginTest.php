<?php

namespace FondOfOryx\Zed\PayoneCreditMemo\Communication\Plugin\Oms\Command;

use Codeception\Test\Unit;
use FondOfOryx\Zed\PayoneCreditMemo\Communication\PayoneCreditMemoCommunicationFactory;
use FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToCreditMemoBridge;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

class PartialRefundCommandPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Sales\Persistence\SpySalesOrderItem
     */
    protected $salesOrderItemMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Sales\Persistence\SpySalesOrder
     */
    protected $salesOrderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject
     */
    protected $readOnlyArrayObject;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\PayoneCreditMemo\Communication\PayoneCreditMemoCommunicationFactory
     */
    protected $communicationFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToCreditMemoBridge
     */
    protected $creditMemoFacadeMock;

    /**
     * @var \Spryker\Zed\Oms\Dependency\Plugin\Command\CommandByOrderInterface
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->spySalesOrderItemMock = $this->getMockBuilder(SpySalesOrderItem::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesOrderMock = $this->getMockBuilder(SpySalesOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->readOnlyArrayObject = $this->getMockBuilder(ReadOnlyArrayObject::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->communicationFactoryMock = $this->getMockBuilder(PayoneCreditMemoCommunicationFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->creditMemoFacadeMock = $this->getMockBuilder(PayoneCreditMemoToCreditMemoBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new PartialRefundCommandPlugin();
        $this->plugin->setFactory($this->communicationFactoryMock);
    }

    /**
     * @return void
     */
    public function testRun(): void
    {
        static::assertEquals([], $this->plugin->run([$this->salesOrderItemMock], $this->salesOrderMock, $this->readOnlyArrayObject));
    }
}
