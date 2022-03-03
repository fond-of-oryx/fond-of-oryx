<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderCompany\Communication\Plugin\JellyfishSalesOrderExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderCompany\Business\JellyfishSalesOrderCompanyFacade;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class CompanyJellyfishOrderExpanderPostMapPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderCompany\Business\JellyfishSalesOrderCompanyFacade|\PHPUnit\Framework\MockObject\MockObject
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
     * @var \FondOfOryx\Zed\JellyfishSalesOrderCompany\Communication\Plugin\JellyfishSalesOrderExtension\CompanyJellyfishOrderExpanderPostMapPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(JellyfishSalesOrderCompanyFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderMock = $this->getMockBuilder(SpySalesOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderTransferMock = $this->getMockBuilder(JellyfishOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanyJellyfishOrderExpanderPostMapPlugin();
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
