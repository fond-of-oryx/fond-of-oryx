<?php

namespace FondOfOryx\Zed\CompanyProductListApi;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyProductListApi\Dependency\Facade\CompanyProductListApiToApiFacadeInterface;
use FondOfOryx\Zed\CompanyProductListApi\Dependency\Facade\CompanyProductListApiToCompanyProductListConnectorFacadeInterface;
use FondOfOryx\Zed\CompanyProductListConnector\Business\CompanyProductListConnectorFacadeInterface;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Api\Business\ApiFacadeInterface;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;

class CompanyProductListApiDependencyProviderTest extends Unit
{
    /**
     * @var \Spryker\Zed\Api\Business\ApiFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiFacadeMock;

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
     * @var \FondOfOryx\Zed\CompanyProductListConnector\Business\CompanyProductListConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $companyProductListConnectorFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListApi\CompanyProductListApiDependencyProvider
     */
    protected $companyProductListApiDependencyProvider;

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

        $this->companyProductListConnectorFacadeMock = $this
            ->getMockBuilder(CompanyProductListConnectorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiFacadeMock = $this
            ->getMockBuilder(ApiFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyProductListApiDependencyProvider = new CompanyProductListApiDependencyProvider();
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
                ['companyProductListConnector'],
                ['api'],
            )->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->withConsecutive(
                ['facade'],
                ['facade'],
            )->willReturnOnConsecutiveCalls(
                $this->companyProductListConnectorFacadeMock,
                $this->apiFacadeMock,
            );

        $container = $this->companyProductListApiDependencyProvider
            ->provideBusinessLayerDependencies($this->containerMock);

        static::assertEquals($this->containerMock, $container);

        static::assertInstanceOf(
            CompanyProductListApiToCompanyProductListConnectorFacadeInterface::class,
            $container[CompanyProductListApiDependencyProvider::FACADE_COMPANY_PRODUCT_LIST_CONNECTOR],
        );

        static::assertInstanceOf(
            CompanyProductListApiToApiFacadeInterface::class,
            $container[CompanyProductListApiDependencyProvider::FACADE_API],
        );
    }
}
