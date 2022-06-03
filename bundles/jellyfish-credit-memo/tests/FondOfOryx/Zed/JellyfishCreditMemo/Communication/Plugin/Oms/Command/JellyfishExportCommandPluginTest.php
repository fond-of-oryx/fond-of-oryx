<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Communication\Plugin\Oms\Command;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishCreditMemo\Business\JellyfishCreditMemoFacade;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Zed\Kernel\Business\AbstractFacade;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

class JellyfishExportCommandPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishCreditMemo\Business\JellyfishCreditMemoFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrderItem|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderItemMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishCreditMemo\Communication\Plugin\Oms\Command\JellyfishExportCommandPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(JellyfishCreditMemoFacade::class)->disableOriginalConstructor()->getMock();
        $this->spySalesOrderMock = $this->getMockBuilder(SpySalesOrder::class)->disableOriginalConstructor()->getMock();
        $this->spySalesOrderItemMock = $this->getMockBuilder(SpySalesOrderItem::class)->disableOriginalConstructor()->getMock();

        $this->plugin = new class ($this->facadeMock) extends JellyfishExportCommandPlugin {
            /**
             * @var \FondOfOryx\Zed\JellyfishCreditMemo\Business\JellyfishCreditMemoFacade
             */
            protected $ownFacade;

            /**
             *  constructor.
             *
             * @param \FondOfOryx\Zed\JellyfishCreditMemo\Business\JellyfishCreditMemoFacade $jellyfishCreditMemoFacade
             */
            public function __construct(JellyfishCreditMemoFacade $jellyfishCreditMemoFacade)
            {
                $this->ownFacade = $jellyfishCreditMemoFacade;
            }

            /**
             * @return \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected function getFacade(): AbstractFacade
            {
                return $this->ownFacade;
            }
        };
    }

    /**
     * @return void
     */
    public function testRunNoItems(): void
    {
        $roao = new ReadOnlyArrayObject();
        $this->facadeMock->expects(static::once())->method('exportCreditMemo');
        $this->spySalesOrderMock->expects(static::once())->method('getIdSalesOrder')->willReturn(1);
        $response = $this->plugin->run([], $this->spySalesOrderMock, $roao);

        static::assertSame([], $response);
    }

    /**
     * @return void
     */
    public function testRun(): void
    {
        $roao = new ReadOnlyArrayObject();
        $this->facadeMock->expects(static::once())->method('exportCreditMemo')->with(1, [0 => 100]);
        $this->spySalesOrderMock->expects(static::once())->method('getIdSalesOrder')->willReturn(1);
        $this->spySalesOrderItemMock->expects(static::once())->method('getIdSalesOrderItem')->willReturn(100);
        $response = $this->plugin->run([$this->spySalesOrderItemMock], $this->spySalesOrderMock, $roao);

        static::assertSame([], $response);
    }
}
