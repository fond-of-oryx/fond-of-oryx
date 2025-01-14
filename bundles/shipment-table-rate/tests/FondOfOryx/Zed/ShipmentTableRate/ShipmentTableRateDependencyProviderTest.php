<?php

namespace FondOfOryx\Zed\ShipmentTableRate;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Service\UtilMathFormula\UtilMathFormulaServiceInterface;
use FondOfOryx\Zed\ShipmentTableRate\Communication\Plugin\ShipmentTableRateExtension\PriceToPayFilterPlugin;
use FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToCountryFacadeBridge;
use FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToStoreFacadeBridge;
use FondOfOryx\Zed\ShipmentTableRate\Dependency\Service\ShipmentTableRateToUtilMathFormulaServiceBridge;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Country\Business\CountryFacadeInterface;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;
use Spryker\Zed\Store\Business\StoreFacadeInterface;

class ShipmentTableRateDependencyProviderTest extends Unit
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
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Store\Business\StoreFacadeInterface
     */
    protected $storeFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Country\Business\CountryFacadeInterface
     */
    protected $countryFacadeMock;

    /**
     * @var \FondOfOryx\Service\UtilMathFormula\UtilMathFormulaServiceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $utilMathFormulaServiceMock;

    /**
     * @var \FondOfOryx\Zed\ShipmentTableRate\ShipmentTableRateDependencyProvider
     */
    protected $shipmentTableRateDependencyProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
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

        $this->storeFacadeMock = $this->getMockBuilder(StoreFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->countryFacadeMock = $this->getMockBuilder(CountryFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->utilMathFormulaServiceMock = $this->getMockBuilder(UtilMathFormulaServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentTableRateDependencyProvider = new ShipmentTableRateDependencyProvider();
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
                    case 'country':
                        return $self->bundleProxyMock;
                    case 'store':
                        return $self->bundleProxyMock;
                    case 'utilMathFormula':
                        return $self->bundleProxyMock;
                }

                throw new Exception('Invalid key');
            });

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->willReturnOnConsecutiveCalls(
                $this->countryFacadeMock,
                $this->storeFacadeMock,
                $this->utilMathFormulaServiceMock,
            );

        $container = $this->shipmentTableRateDependencyProvider->provideBusinessLayerDependencies(
            $this->containerMock,
        );

        static::assertEquals($this->containerMock, $container);
        static::assertInstanceOf(
            ShipmentTableRateToCountryFacadeBridge::class,
            $container[ShipmentTableRateDependencyProvider::FACADE_COUNTRY],
        );
        static::assertInstanceOf(
            ShipmentTableRateToStoreFacadeBridge::class,
            $container[ShipmentTableRateDependencyProvider::FACADE_STORE],
        );
        static::assertInstanceOf(
            ShipmentTableRateToUtilMathFormulaServiceBridge::class,
            $container[ShipmentTableRateDependencyProvider::SERVICE_UTIL_MATH_FORMULA],
        );
        static::assertInstanceOf(
            PriceToPayFilterPlugin::class,
            $container[ShipmentTableRateDependencyProvider::PLUGIN_PRICE_TO_PAY_FILTER],
        );
    }
}
