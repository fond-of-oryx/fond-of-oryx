<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyRoleConnector\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterCompanyRoleConnector\Business\CompanyDeleterCompanyRoleConnectorFacade;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyRoleDeleterPrePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyRoleConnector\Business\CompanyDeleterCompanyRoleConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyRoleConnector\Communication\Plugin\CompanyRoleDeleterPrePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CompanyDeleterCompanyRoleConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanyRoleDeleterPrePlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testExecute()
    {
        $this->facadeMock->expects(static::atLeastOnce())->method('deleteCompanyRoleDataForCompanyById');
        $this->plugin->execute($this->companyTransferMock);
    }
}
