<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFair;

use Codeception\Test\Unit;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\RepresentativeCompanyUserFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Dependency\Facade\RepresentativeCompanyUserTradeFairToRepresentativeCompanyUserInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Dependency\Service\RepresentativeCompanyUserTradeFairToUtilUuidGeneratorServiceInterface;
use Orm\Zed\Company\Persistence\SpyCompanyQuery;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery;
use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUserQuery;
use Spryker\Service\UtilUuidGenerator\UtilUuidGeneratorServiceInterface;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;

class RepresentativeCompanyUserTradeFairDependencyProviderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Locator
     */
    protected $locatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\CompanyUser\Business\CompanyUserFacadeInterface
     */
    protected $representativeCompanyUserFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Service\UtilUuidGenerator\UtilUuidGeneratorServiceInterface
     */
    protected $uuidGeneratorServiceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\BundleProxy
     */
    protected $bundleProxyMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\RepresentativeCompanyUserTradeFairDependencyProvider
     */
    protected $representativeCompanyUserTradeFairDependencyProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet'])
            ->getMock();

        $this->bundleProxyMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->locatorMock = $this->getMockBuilder(Locator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserFacadeMock = $this->getMockBuilder(RepresentativeCompanyUserFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->uuidGeneratorServiceMock = $this->getMockBuilder(UtilUuidGeneratorServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTradeFairDependencyProvider = new RepresentativeCompanyUserTradeFairDependencyProvider();
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
            ->withConsecutive(['representativeCompanyUser'], ['utilUuidGenerator'])
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->withConsecutive(['facade'], ['service'])
            ->willReturnOnConsecutiveCalls(
                $this->representativeCompanyUserFacadeMock,
                $this->uuidGeneratorServiceMock,
            );

        $container = $this->representativeCompanyUserTradeFairDependencyProvider->provideBusinessLayerDependencies(
            $this->containerMock,
        );

        static::assertEquals($this->containerMock, $container);
        static::assertInstanceOf(
            RepresentativeCompanyUserTradeFairToRepresentativeCompanyUserInterface::class,
            $container[RepresentativeCompanyUserTradeFairDependencyProvider::FACADE_REPRESENTATIVE_COMPANY_USER],
        );
        static::assertInstanceOf(
            RepresentativeCompanyUserTradeFairToUtilUuidGeneratorServiceInterface::class,
            $container[RepresentativeCompanyUserTradeFairDependencyProvider::SERVICE_UTIL_UUID_GENERATOR],
        );
    }

    /**
     * @return void
     */
    public function testProvidePersistenceLayerDependencies(): void
    {
        $container = $this->representativeCompanyUserTradeFairDependencyProvider->providePersistenceLayerDependencies(
            $this->containerMock,
        );

        static::assertEquals($this->containerMock, $container);
        static::assertInstanceOf(
            SpyCompanyQuery::class,
            $container[RepresentativeCompanyUserTradeFairDependencyProvider::QUERY_COMPANY],
        );
        static::assertInstanceOf(
            SpyCustomerQuery::class,
            $container[RepresentativeCompanyUserTradeFairDependencyProvider::QUERY_CUSTOMER],
        );
        static::assertInstanceOf(
            FooRepresentativeCompanyUserQuery::class,
            $container[RepresentativeCompanyUserTradeFairDependencyProvider::QUERY_REPRESENTATIVE_COMPANY_USER],
        );
        static::assertInstanceOf(
            SpyCompanyRoleQuery::class,
            $container[RepresentativeCompanyUserTradeFairDependencyProvider::QUERY_COMPANY_ROLE],
        );
    }
}
