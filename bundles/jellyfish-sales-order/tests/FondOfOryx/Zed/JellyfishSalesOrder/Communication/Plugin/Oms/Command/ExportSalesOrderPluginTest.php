<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Communication\Plugin\Oms\Command;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\JellyfishSalesOrderFacade;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\JellyfishSalesOrderFacadeInterface;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Kernel\Business\AbstractFacade;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

class ExportSalesOrderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Communication\Plugin\Oms\Command\ExportSalesOrderPlugin
     */
    protected $exportSalesOrderPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\JellyfishSalesOrder\Business\JellyfishSalesOrderFacadeInterface
     */
    protected $jellyfishSalesOrderFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Sales\Persistence\SpySalesOrder
     */
    protected $spySalesOrderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject
     */
    protected $readOnlyArrayObjectMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->jellyfishSalesOrderFacadeMock = $this->getMockBuilder(JellyfishSalesOrderFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderMock = $this->getMockBuilder(SpySalesOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->readOnlyArrayObjectMock = $this->getMockBuilder(ReadOnlyArrayObject::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->exportSalesOrderPlugin = new class (
            $this->jellyfishSalesOrderFacadeMock
        ) extends ExportSalesOrderPlugin {
            /**
             * @var \FondOfOryx\Zed\JellyfishSalesOrder\Business\JellyfishSalesOrderFacadeInterface
             */
            protected $jellyfishSalesOrderFacade;

            /**
             * @param \FondOfOryx\Zed\JellyfishSalesOrder\Business\JellyfishSalesOrderFacadeInterface $jellyfishSalesOrderFacade
             */
            public function __construct(JellyfishSalesOrderFacadeInterface $jellyfishSalesOrderFacade)
            {
                $this->jellyfishSalesOrderFacade = $jellyfishSalesOrderFacade;
            }

            /**
             * @return \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            public function getFacade(): AbstractFacade
            {
                return $this->jellyfishSalesOrderFacade;
            }
        };
    }

    /**
     * @return void
     */
    public function testRun(): void
    {
        $this->assertIsArray(
            $this->exportSalesOrderPlugin->run(
                [],
                $this->spySalesOrderMock,
                $this->readOnlyArrayObjectMock,
            ),
        );
    }
}
