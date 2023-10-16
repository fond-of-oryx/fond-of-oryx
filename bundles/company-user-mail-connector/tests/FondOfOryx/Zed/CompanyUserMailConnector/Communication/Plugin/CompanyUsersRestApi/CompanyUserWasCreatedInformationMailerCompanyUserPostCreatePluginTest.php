<?php

namespace FondOfOryx\Zed\CompanyUserMailConnector\Communication\Plugin\CompanyUsersRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUserMailConnector\Business\CompanyUserMailConnectorFacade;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\RestCompanyUsersRequestAttributesTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class CompanyUserWasCreatedInformationMailerCompanyUserPostCreatePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\Business\CompanyUserMailConnectorFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUserMailConnectorFacade|MockObject $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUserTransfer|MockObject $companyUserTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyUsersRequestAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestCompanyUsersRequestAttributesTransfer|MockObject $restCompanyUsersRequestAttributesTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\Communication\Plugin\CompanyUsersRestApi\CompanyUserWasCreatedInformationMailerCompanyUserPostCreatePlugin
     */
    protected CompanyUserWasCreatedInformationMailerCompanyUserPostCreatePlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CompanyUserMailConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyUsersRequestAttributesTransferMock = $this->getMockBuilder(RestCompanyUsersRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanyUserWasCreatedInformationMailerCompanyUserPostCreatePlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testPostCreate(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('sendCustomerNotificationMails')
            ->with($this->companyUserTransferMock)
            ->willReturn($this->companyUserTransferMock);

        static::assertInstanceOf(
            CompanyUserTransfer::class,
            $this->plugin->postCreate($this->companyUserTransferMock, $this->restCompanyUsersRequestAttributesTransferMock),
        );
    }
}
