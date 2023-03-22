<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Business\CompanyDeleterCompanyUserConnectorFacade;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyUserDeleterPrePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Business\CompanyDeleterCompanyUserConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Communication\Plugin\CompanyUserDeleterPrePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CompanyDeleterCompanyUserConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanyUserDeleterPrePlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testExecute()
    {
        $this->facadeMock->expects(static::atLeastOnce())->method('deleteCompanyUserDataForCompanyById');
        $this->plugin->execute($this->companyTransferMock);
    }
}
