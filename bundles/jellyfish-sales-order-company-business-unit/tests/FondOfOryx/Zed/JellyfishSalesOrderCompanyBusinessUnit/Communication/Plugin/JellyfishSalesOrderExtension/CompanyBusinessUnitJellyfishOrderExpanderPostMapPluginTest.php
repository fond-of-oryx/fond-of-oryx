<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\Communication\Plugin\JellyfishSalesOrderExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\Business\JellyfishSalesOrderCompanyBusinessUnitFacade;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class CompanyBusinessUnitJellyfishOrderExpanderPostMapPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\Business\JellyfishSalesOrderCompanyBusinessUnitFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishOrderTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\Communication\Plugin\JellyfishSalesOrderExtension\CompanyBusinessUnitJellyfishOrderExpanderPostMapPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(JellyfishSalesOrderCompanyBusinessUnitFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderMock = $this->getMockBuilder(SpySalesOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderTransferMock = $this->getMockBuilder(JellyfishOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanyBusinessUnitJellyfishOrderExpanderPostMapPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('expandJellyfishOrder')
            ->with($this->jellyfishOrderTransferMock, $this->spySalesOrderMock)
            ->willReturn($this->jellyfishOrderTransferMock);

        static::assertEquals(
            $this->jellyfishOrderTransferMock,
            $this->plugin->expand($this->jellyfishOrderTransferMock, $this->spySalesOrderMock),
        );
    }
}
