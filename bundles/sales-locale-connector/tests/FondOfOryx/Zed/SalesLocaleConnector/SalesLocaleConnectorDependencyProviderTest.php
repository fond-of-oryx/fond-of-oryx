<?php

namespace FondOfOryx\Zed\SalesLocaleConnector;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SalesLocaleConnector\Dependency\Facade\SalesLocaleConnectorToLocaleFacadeBridge;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;
use Spryker\Zed\Locale\Business\LocaleFacadeInterface;

class SalesLocaleConnectorDependencyProviderTest extends Unit
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
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Locale\Business\LocaleFacadeInterface
     */
    protected $localeFacadeMock;

    /**
     * @var \FondOfOryx\Zed\SalesLocaleConnector\SalesLocaleConnectorDependencyProvider
     */
    protected $salesLocaleConnectorDependencyProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet'])
            ->getMock();

        $this->locatorMock = $this->getMockBuilder(Locator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bundleProxyMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeFacadeMock = $this->getMockBuilder(LocaleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesLocaleConnectorDependencyProvider = new SalesLocaleConnectorDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects($this->atLeastOnce())
            ->method('__call')
            ->with('locale')
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects($this->atLeastOnce())
            ->method('__call')
            ->with('facade')
            ->willReturn($this->localeFacadeMock);

        $container = $this->salesLocaleConnectorDependencyProvider->provideBusinessLayerDependencies(
            $this->containerMock,
        );

        $this->assertEquals($this->containerMock, $container);
        $this->assertInstanceOf(
            SalesLocaleConnectorToLocaleFacadeBridge::class,
            $container[SalesLocaleConnectorDependencyProvider::FACADE_LOCALE],
        );
    }
}
