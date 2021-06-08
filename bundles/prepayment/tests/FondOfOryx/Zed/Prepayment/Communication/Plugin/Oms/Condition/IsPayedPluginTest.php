<?php

namespace FondOfOryx\Zed\Prepayment\Communication\Plugin\Oms\Condition;

use Codeception\Test\Unit;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

class IsPayedPluginTest extends Unit
{
    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrderItem|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderItemMock;

    /**
     * @var \Spryker\Zed\Oms\Dependency\Plugin\Condition\ConditionInterface
     */
    protected $plugin;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->spySalesOrderItemMock = $this->getMockBuilder(SpySalesOrderItem::class)->disableOriginalConstructor()->getMock();

        $this->plugin = new class extends IsPayedPlugin {
        };
    }

    /**
     * @return void
     */
    public function testCheck(): void
    {
        static::assertTrue($this->plugin->check($this->spySalesOrderItemMock));
    }
}
