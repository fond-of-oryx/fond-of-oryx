<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Business\CompanyDeleterCompanyUnitAddressConnectorFacade;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyUnitAddressDeleterPrePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Business\CompanyDeleterCompanyUnitAddressConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Communication\Plugin\CompanyUnitAddressDeleterPrePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CompanyDeleterCompanyUnitAddressConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanyUnitAddressDeleterPrePlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testExecute()
    {
        $this->facadeMock->expects(static::atLeastOnce())->method('deleteCompanyUnitAddressDataForCompanyById');
        $this->plugin->execute($this->companyTransferMock);
    }
}
