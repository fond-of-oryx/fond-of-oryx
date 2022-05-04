<?php

namespace FondOfOryx\Zed\CompanyUserCompanyRoleConnector;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Dependency\Facade\CompanyUserCompanyRoleConnectorToCompanyRoleFacadeInterface;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\CompanyRole\Business\CompanyRoleFacadeInterface;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;

class CompanyUserCompanyRoleConnectorDependencyProviderTest extends Unit
{
    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Locator
     */
    protected $locatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\BundleProxy
     */
    protected $bundleProxyMock;

    /**
     * @var \Spryker\Zed\CompanyRole\Business\CompanyRoleFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $companyRoleFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserCompanyRoleConnector\CompanyUserCompanyRoleConnectorDependencyProvider
     */
    protected $companyUserCompanyRoleConnectorDependencyProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet'])
            ->getMock();

        $this->locatorMock = $this->getMockBuilder(Locator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bundleProxyMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleFacadeMock = $this
            ->getMockBuilder(CompanyRoleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserCompanyRoleConnectorDependencyProvider =
            new CompanyUserCompanyRoleConnectorDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects(static::atLeastOnce())
            ->method('__call')
            ->withConsecutive(
                ['companyRole'],
            )->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->with('facade')
            ->willReturnOnConsecutiveCalls(
                $this->companyRoleFacadeMock,
            );

        $container = $this->companyUserCompanyRoleConnectorDependencyProvider
            ->provideBusinessLayerDependencies($this->containerMock);

        static::assertEquals($this->containerMock, $container);

        static::assertInstanceOf(
            CompanyUserCompanyRoleConnectorToCompanyRoleFacadeInterface::class,
            $container[CompanyUserCompanyRoleConnectorDependencyProvider::FACADE_COMPANY_ROLE],
        );
    }
}
