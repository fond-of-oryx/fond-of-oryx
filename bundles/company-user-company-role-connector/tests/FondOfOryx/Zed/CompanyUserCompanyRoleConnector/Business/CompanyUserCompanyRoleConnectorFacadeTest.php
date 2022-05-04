<?php

namespace FondOfOryx\Zed\CompanUserCompanyRoleConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\CompanyUserCompanyRoleConnectorBusinessFactory;
use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\CompanyUserCompanyRoleConnectorFacade;
use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\Writer\CompanyUserCompanyRoleWriterInterface;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\RestCompanyUsersRequestAttributesTransfer;

class CompanyUserCompanyRoleConnectorFacadeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\CompanyUserCompanyRoleConnectorBusinessFactory
     */
    protected $businessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\CompanyBusinessUnitOrderBudgetBusinessFactory
     */
    protected $companyUserCompanyRoleWriterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected $companyUserTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyUsersRequestAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompanyUsersRequestAttributesTransfer;

    /**
     * @var \FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\CompanyUserCompanyRoleConnectorFacadeInterface
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactoryMock = $this
            ->getMockBuilder(CompanyUserCompanyRoleConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserCompanyRoleWriterMock = $this
            ->getMockBuilder(CompanyUserCompanyRoleWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyUsersRequestAttributesTransfer = $this
            ->getMockBuilder(RestCompanyUsersRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompanyUserCompanyRoleConnectorFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyUserCompanyRoleConnector(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createCompanyUserCompanyRoleWriter')
            ->willReturn($this->companyUserCompanyRoleWriterMock);

        $this->companyUserCompanyRoleWriterMock->expects(static::atLeastOnce())
            ->method('saveCompanyUserCompanyRole')
            ->with($this->companyUserTransferMock, $this->restCompanyUsersRequestAttributesTransfer)
            ->willReturn($this->companyUserTransferMock);

        static::assertInstanceOf(
            CompanyUserTransfer::class,
            $this->facade->saveCompanyUserCompanyRole(
                $this->companyUserTransferMock,
                $this->restCompanyUsersRequestAttributesTransfer,
            ),
        );
    }
}
