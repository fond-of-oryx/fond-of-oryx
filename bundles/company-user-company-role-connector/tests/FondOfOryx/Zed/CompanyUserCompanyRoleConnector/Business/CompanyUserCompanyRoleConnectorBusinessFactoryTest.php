<?php

namespace FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\Writer\CompanyUserCompanyRoleWriterInterface;
use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\CompanyUserCompanyRoleConnectorDependencyProvider;
use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Dependency\Facade\CompanyUserCompanyRoleConnectorToCompanyRoleFacadeInterface;
use Spryker\Zed\Kernel\Container;

class CompanyUserCompanyRoleConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Dependency\Facade\CompanyUserCompanyRoleConnectorToCompanyRoleFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyRoleFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\CompanyUserCompanyRoleConnectorBusinessFactory
     */
    protected $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleFacadeMock = $this
            ->getMockBuilder(CompanyUserCompanyRoleConnectorToCompanyRoleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new CompanyUserCompanyRoleConnectorBusinessFactory();
        $this->businessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyUserCompanyRoleWriter(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(CompanyUserCompanyRoleConnectorDependencyProvider::FACADE_COMPANY_ROLE)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(CompanyUserCompanyRoleConnectorDependencyProvider::FACADE_COMPANY_ROLE)
            ->willReturn($this->companyRoleFacadeMock);

        static::assertInstanceOf(
            CompanyUserCompanyRoleWriterInterface::class,
            $this->businessFactory->createCompanyUserCompanyRoleWriter(),
        );
    }
}
