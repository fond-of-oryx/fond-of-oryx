<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Business\RepresentativeCompanyUserTradeFairFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface;
use FondOfSpryker\Zed\CompanyType\Business\CompanyTypeFacadeInterface;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;
use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use Orm\Zed\Permission\Persistence\Base\SpyPermissionQuery;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;

class RepresentativeCompanyUserTradeFairRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected MockObject|Container $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyType\Business\CompanyTypeFacadeInterface
     */
    protected MockObject|CompanyTypeFacadeInterface $companyTypeFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Locator
     */
    protected MockObject|Locator $locatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\BundleProxy
     */
    protected MockObject|BundleProxy $bundleProxyMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiDependencyProvider
     */
    protected RepresentativeCompanyUserTradeFairRestApiDependencyProvider $dependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Business\RepresentativeCompanyUserTradeFairFacadeInterface
     */
    protected MockObject|RepresentativeCompanyUserTradeFairFacadeInterface $representativeCompanyUserTradeFairFacadeMock;

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

        $this->companyTypeFacadeMock = $this->getMockBuilder(CompanyTypeFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTradeFairFacadeMock = $this->getMockBuilder(RepresentativeCompanyUserTradeFairFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dependencyProvider = new RepresentativeCompanyUserTradeFairRestApiDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvidePersistenceLayerDependencies(): void
    {
        $container = $this->dependencyProvider->providePersistenceLayerDependencies($this->containerMock);

        static::assertEquals($container, $this->containerMock);
        static::assertInstanceOf(
            SpyCustomerQuery::class,
            $container[RepresentativeCompanyUserTradeFairRestApiDependencyProvider::QUERY_SPY_CUSTOMER],
        );

        static::assertInstanceOf(
            SpyCompanyUserQuery::class,
            $container[RepresentativeCompanyUserTradeFairRestApiDependencyProvider::QUERY_SPY_COMPANY_USER],
        );

        static::assertInstanceOf(
            SpyPermissionQuery::class,
            $container[RepresentativeCompanyUserTradeFairRestApiDependencyProvider::PROPEL_QUERY_PERMISSION],
        );
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
            ->withConsecutive(['representativeCompanyUserTradeFair'], ['companyType'])
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->withConsecutive(['facade'], ['facade'])
            ->willReturnOnConsecutiveCalls(
                $this->representativeCompanyUserTradeFairFacadeMock,
                $this->companyTypeFacadeMock,
            );

        $container = $this->dependencyProvider->provideBusinessLayerDependencies($this->containerMock);

        static::assertEquals($this->containerMock, $container);

        static::assertInstanceOf(
            RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface::class,
            $container[RepresentativeCompanyUserTradeFairRestApiDependencyProvider::FACADE_REPRESENTATIVE_COMPANY_USER],
        );

        static::assertInstanceOf(
            RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeInterface::class,
            $container[RepresentativeCompanyUserTradeFairRestApiDependencyProvider::FACADE_COMPANY_TYPE],
        );
    }
}
