<?php

namespace FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Communication\Plugin\CompanyUsersRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\CompanyUserCompanyRoleConnectorFacade;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\RestCompanyUsersRequestAttributesTransfer;

class CompanyRoleCompanyUserPreCreatePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\CompanyUserCompanyRoleConnectorFacade|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyUserTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyUsersRequestAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyUsersRequestAttributesTransfer;

    /**
     * @var \FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Communication\Plugin\CompanyUsersRestApi\CompanyRoleCompanyUserPreCreatePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CompanyUserCompanyRoleConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyUsersRequestAttributesTransfer = $this->getMockBuilder(RestCompanyUsersRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanyRoleCompanyUserPreCreatePlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testPreCreate(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('expandCompanyUserWithCompanyRole')
            ->with($this->companyUserTransferMock, $this->restCompanyUsersRequestAttributesTransfer);

        static::assertInstanceOf(
            CompanyUserTransfer::class,
            $this->plugin->preCreate($this->companyUserTransferMock, $this->restCompanyUsersRequestAttributesTransfer),
        );
    }
}
