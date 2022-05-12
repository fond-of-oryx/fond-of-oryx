<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade\JellyfishSalesOrderPayoneGiftCardConnectorToSalesFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Service\JellyfishSalesOrderPayoneGiftCardConnectorToPayoneServiceInterface;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;
use Spryker\Zed\Sales\Business\SalesFacadeInterface;
use SprykerEco\Service\Payone\PayoneServiceInterface;

class JellyfishSalesOrderPayoneGiftCardConnectorDependencyProviderTest extends Unit
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
     * @var \Spryker\Zed\Sales\Business\SalesFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $salesFacadeMock;

    /**
     * @var \Spryker\Zed\Sales\Business\SalesFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $payoneServiceMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\JellyfishSalesOrderPayoneGiftCardConnectorDependencyProvider
     */
    protected $dependencyProvider;

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

        $this->salesFacadeMock = $this
            ->getMockBuilder(SalesFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->payoneServiceMock = $this
            ->getMockBuilder(PayoneServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dependencyProvider =
            new JellyfishSalesOrderPayoneGiftCardConnectorDependencyProvider();
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
                ['sales'],
                ['payone'],
            )->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->withConsecutive(
                ['facade'],
                ['service'],
            )
            ->willReturnOnConsecutiveCalls(
                $this->salesFacadeMock,
                $this->payoneServiceMock,
            );

        $container = $this->dependencyProvider
            ->provideBusinessLayerDependencies($this->containerMock);

        static::assertEquals($this->containerMock, $container);

        static::assertInstanceOf(
            JellyfishSalesOrderPayoneGiftCardConnectorToSalesFacadeInterface::class,
            $container[JellyfishSalesOrderPayoneGiftCardConnectorDependencyProvider::FACADE_SALES],
        );

        static::assertInstanceOf(
            JellyfishSalesOrderPayoneGiftCardConnectorToPayoneServiceInterface::class,
            $container[JellyfishSalesOrderPayoneGiftCardConnectorDependencyProvider::SERVICE_PAYONE],
        );
    }
}
