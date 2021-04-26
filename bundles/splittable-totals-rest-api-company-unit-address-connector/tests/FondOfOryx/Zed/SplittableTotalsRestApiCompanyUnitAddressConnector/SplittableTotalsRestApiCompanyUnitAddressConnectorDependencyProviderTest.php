<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Dependency\Facade\SplittableTotalsRestApiCompanyUnitAddressConnectorToCompanyUnitAddressFacadeBridge;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\CompanyUnitAddress\Business\CompanyUnitAddressFacadeInterface;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;

class SplittableTotalsRestApiCompanyUnitAddressConnectorDependencyProviderTest extends Unit
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
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\BundleProxy
     */
    protected $bundleProxyMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\CompanyUnitAddress\Business\CompanyUnitAddressFacadeInterface
     */
    protected $companyUnitAddressFacadeMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\SplittableTotalsRestApiCompanyUnitAddressConnectorDependencyProvider
     */
    protected $dependencyProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet', 'has', 'offsetExists'])
            ->getMock();

        $this->locatorMock = $this->getMockBuilder(Locator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bundleProxyMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressFacadeMock = $this->getMockBuilder(CompanyUnitAddressFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dependencyProvider = new SplittableTotalsRestApiCompanyUnitAddressConnectorDependencyProvider();
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
            ->with('companyUnitAddress')
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->with('facade')
            ->willReturn($this->companyUnitAddressFacadeMock);

        $container = $this->dependencyProvider->provideBusinessLayerDependencies(
            $this->containerMock
        );

        static::assertEquals($this->containerMock, $container);
        static::assertInstanceOf(
            SplittableTotalsRestApiCompanyUnitAddressConnectorToCompanyUnitAddressFacadeBridge::class,
            $container[SplittableTotalsRestApiCompanyUnitAddressConnectorDependencyProvider::FACADE_COMPANY_UNIT_ADDRESS]
        );
    }
}
