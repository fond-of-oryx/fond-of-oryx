<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi;

use Codeception\Test\Unit;
use Exception;
use FondOfImpala\Zed\CompanyType\Business\CompanyTypeFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Business\RepresentativeCompanyUserTradeFairFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface;
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
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfImpala\Zed\CompanyType\Business\CompanyTypeFacadeInterface
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

        $containerMock = $this->getMockBuilder(Container::class);

        /** @phpstan-ignore-next-line */
        if (method_exists($containerMock, 'setMethodsExcept')) {
            /** @phpstan-ignore-next-line */
            $containerMock->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet']);
        } else {
            /** @phpstan-ignore-next-line */
            $containerMock->onlyMethods(['getLocator'])->enableOriginalClone();
        }

        $this->containerMock = $containerMock->getMock();

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
        $self = $this;
        $this->containerMock->expects($this->atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects($this->atLeastOnce())
            ->method('__call')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case 'representativeCompanyUserTradeFair':
                        return $self->bundleProxyMock;
                    case 'companyType':
                        return $self->bundleProxyMock;
                }

                throw new Exception('Invalid key');
            });

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
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
