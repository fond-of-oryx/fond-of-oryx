<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser;

use Codeception\Test\Unit;
use FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToCompanyUserFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToEventFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Service\RepresentativeCompanyUserToUtilUuidGeneratorServiceInterface;
use Orm\Zed\Company\Persistence\SpyCompanyQuery;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;
use Spryker\Service\UtilUuidGenerator\UtilUuidGeneratorServiceInterface;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\CompanyUser\Business\CompanyUserFacadeInterface;
use Spryker\Zed\Event\Business\EventFacadeInterface;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;

class RepresentativeCompanyUserDependencyProviderTest extends Unit
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
    protected $companyUserFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Event\Business\EventFacadeInterface
     */
    protected $eventFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Service\UtilUuidGenerator\UtilUuidGeneratorServiceInterface
     */
    protected $uuidGeneratorServiceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\BundleProxy
     */
    protected $bundleProxyMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\RepresentativeCompanyUserDependencyProvider
     */
    protected $productLocaleRestrictionStorageDependencyProvider;

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

        $this->companyUserFacadeMock = $this->getMockBuilder(CompanyUserFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->uuidGeneratorServiceMock = $this->getMockBuilder(UtilUuidGeneratorServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->eventFacadeMock = $this->getMockBuilder(EventFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productLocaleRestrictionStorageDependencyProvider = new RepresentativeCompanyUserDependencyProvider();
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
            ->withConsecutive(['companyUser'], ['event'], ['utilUuidGenerator'])
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->withConsecutive(['facade'], ['facade'], ['service'])
            ->willReturnOnConsecutiveCalls(
                $this->companyUserFacadeMock,
                $this->eventFacadeMock,
                $this->uuidGeneratorServiceMock,
            );

        $container = $this->productLocaleRestrictionStorageDependencyProvider->provideBusinessLayerDependencies(
            $this->containerMock,
        );

        static::assertEquals($this->containerMock, $container);
        static::assertInstanceOf(
            RepresentativeCompanyUserToCompanyUserFacadeInterface::class,
            $container[RepresentativeCompanyUserDependencyProvider::FACADE_COMPANY_USER],
        );
        static::assertInstanceOf(
            RepresentativeCompanyUserToEventFacadeInterface::class,
            $container[RepresentativeCompanyUserDependencyProvider::FACADE_EVENT],
        );
        static::assertInstanceOf(
            RepresentativeCompanyUserToUtilUuidGeneratorServiceInterface::class,
            $container[RepresentativeCompanyUserDependencyProvider::SERVICE_UTIL_UUID_GENERATOR],
        );
        static::assertIsArray(
            $container[RepresentativeCompanyUserDependencyProvider::PLUGINS_TASKS],
        );
    }

    /**
     * @return void
     */
    public function testProvidePersistenceLayerDependencies(): void
    {
        $container = $this->productLocaleRestrictionStorageDependencyProvider->providePersistenceLayerDependencies(
            $this->containerMock,
        );

        static::assertEquals($this->containerMock, $container);
        static::assertInstanceOf(
            SpyCompanyUserQuery::class,
            $container[RepresentativeCompanyUserDependencyProvider::QUERY_COMPANY_USER],
        );
        static::assertInstanceOf(
            SpyCompanyQuery::class,
            $container[RepresentativeCompanyUserDependencyProvider::QUERY_COMPANY],
        );
    }
}
