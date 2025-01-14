<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\GiftCardProportionalValue\Business\GiftCardProportionalValueFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade\JellyfishSalesOrderPayoneGiftCardConnectorToGiftCardProportionalValueFacadeInterface;
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
     * @var \FondOfOryx\Zed\GiftCardProportionalValue\Business\GiftCardProportionalValueFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $proportionalValueConnectorFacadeMock;

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

        $this->salesFacadeMock = $this
            ->getMockBuilder(SalesFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->payoneServiceMock = $this
            ->getMockBuilder(PayoneServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->proportionalValueConnectorFacadeMock = $this
            ->getMockBuilder(GiftCardProportionalValueFacadeInterface::class)
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
        $self = $this;
        $this->containerMock->expects($this->atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects($this->atLeastOnce())
            ->method('__call')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case 'sales':
                        return $self->bundleProxyMock;
                    case 'payone':
                        return $self->bundleProxyMock;
                    case 'giftCardProportionalValue':
                        return $self->bundleProxyMock;
                }

                throw new Exception('Invalid key');
            });

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->willReturnOnConsecutiveCalls(
                $this->salesFacadeMock,
                $this->payoneServiceMock,
                $this->proportionalValueConnectorFacadeMock,
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

        static::assertInstanceOf(
            JellyfishSalesOrderPayoneGiftCardConnectorToGiftCardProportionalValueFacadeInterface::class,
            $container[JellyfishSalesOrderPayoneGiftCardConnectorDependencyProvider::FACADE_GIFT_CARD_PROPORTIONAL_VALUE_CONNECTOR],
        );
    }
}
