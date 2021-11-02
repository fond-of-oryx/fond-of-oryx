<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\PluginExecutor;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class JellyfishSalesOrderPluginExecutorTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    protected $jellyfishOrderTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\PluginExecutor\JellyfishSalesOrderPluginExecutorInterface
     */
    protected $jellyfishSalesOrderPluginExecutor;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Sales\Persistence\SpySalesOrder
     */
    protected $spySalesOrderMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->jellyfishOrderTransferMock = $this->getMockBuilder(JellyfishOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderMock = $this->getMockBuilder(SpySalesOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishSalesOrderPluginExecutor = new JellyfishSalesOrderPluginExecutor([]);
    }

    /**
     * @return void
     */
    public function testExecutePostMapPlugins(): void
    {
        $this->assertInstanceOf(
            JellyfishOrderTransfer::class,
            $this->jellyfishSalesOrderPluginExecutor->executePostMapPlugins(
                $this->jellyfishOrderTransferMock,
                $this->spySalesOrderMock,
            ),
        );
    }
}
