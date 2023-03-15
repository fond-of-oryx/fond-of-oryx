<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Business\CompanyDeleterCompanyBusinessUnitConnectorFacade;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyBusinessUnitDeleterPrePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Business\CompanyDeleterCompanyBusinessUnitConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Communication\Plugin\CompanyBusinessUnitDeleterPrePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CompanyDeleterCompanyBusinessUnitConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanyBusinessUnitDeleterPrePlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testExecute()
    {
        $this->facadeMock->expects(static::atLeastOnce())->method('deleteCompanyBusinessUnitDataForCompanyById');
        $this->plugin->execute($this->companyTransferMock);
    }
}
