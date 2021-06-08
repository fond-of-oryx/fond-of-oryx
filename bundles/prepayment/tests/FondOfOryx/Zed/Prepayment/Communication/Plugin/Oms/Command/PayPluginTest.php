<?php

namespace FondOfOryx\Zed\Prepayment\Communication\Plugin\Oms\Command;

use Codeception\Test\Unit;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

class PayPluginTest extends Unit
{
    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderMock;

    /**
     * @var \Spryker\Zed\Oms\Dependency\Plugin\Command\CommandByOrderInterface
     */
    protected $plugin;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->spySalesOrderMock = $this->getMockBuilder(SpySalesOrder::class)->disableOriginalConstructor()->getMock();

        $this->plugin = new class extends PayPlugin {
        };
    }

    /**
     * @return void
     */
    public function testRun(): void
    {
        $this->plugin->run([], $this->spySalesOrderMock, new ReadOnlyArrayObject());
    }
}
