<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyToProductListConnector\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterCompanyToProductListConnector\Business\CompanyDeleterCompanyToProductListConnectorFacade;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyToProductListDeleterPrePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyToProductListConnector\Business\CompanyDeleterCompanyToProductListConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyToProductListConnector\Communication\Plugin\CompanyToProductListDeleterPrePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CompanyDeleterCompanyToProductListConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanyToProductListDeleterPrePlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testExecute()
    {
        $this->facadeMock->expects(static::atLeastOnce())->method('deleteProductListDataForCompanyById');
        $this->plugin->execute($this->companyTransferMock);
    }
}
