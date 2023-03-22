<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Business\CompanyDeleterCompanyUserArchiveConnectorFacade;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyUserArchiveDeleterPrePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Business\CompanyDeleterCompanyUserArchiveConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Communication\Plugin\CompanyUserArchiveDeleterPrePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CompanyDeleterCompanyUserArchiveConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanyUserArchiveDeleterPrePlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testExecute()
    {
        $this->facadeMock->expects(static::atLeastOnce())->method('deleteCompanyUserArchiveDataForCompanyByIdCompany');
        $this->plugin->execute($this->companyTransferMock);
    }
}
