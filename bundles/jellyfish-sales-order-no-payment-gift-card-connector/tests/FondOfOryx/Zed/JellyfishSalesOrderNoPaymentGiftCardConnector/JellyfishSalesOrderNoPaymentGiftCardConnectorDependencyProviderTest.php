<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\GiftCardProportionalValue\Business\GiftCardProportionalValueFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Dependency\Facade\JellyfishSalesOrderNoPaymentGiftCardConnectorToGiftCardProportionalValueFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Dependency\Facade\JellyfishSalesOrderNoPaymentGiftCardConnectorToSalesFacadeInterface;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;
use Spryker\Zed\Sales\Business\SalesFacadeInterface;

class JellyfishSalesOrderNoPaymentGiftCardConnectorDependencyProviderTest extends Unit
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
     * @var \FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\JellyfishSalesOrderNoPaymentGiftCardConnectorDependencyProvider
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

        $this->proportionalValueConnectorFacadeMock = $this
            ->getMockBuilder(GiftCardProportionalValueFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dependencyProvider =
            new JellyfishSalesOrderNoPaymentGiftCardConnectorDependencyProvider();
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
                    case 'giftCardProportionalValue':
                        return $self->bundleProxyMock;
                }

                throw new Exception('Invalid key');
            });

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->willReturnOnConsecutiveCalls(
                $this->salesFacadeMock,
                $this->proportionalValueConnectorFacadeMock,
            );

        $container = $this->dependencyProvider
            ->provideBusinessLayerDependencies($this->containerMock);

        static::assertEquals($this->containerMock, $container);

        static::assertInstanceOf(
            JellyfishSalesOrderNoPaymentGiftCardConnectorToSalesFacadeInterface::class,
            $container[JellyfishSalesOrderNoPaymentGiftCardConnectorDependencyProvider::FACADE_SALES],
        );

        static::assertInstanceOf(
            JellyfishSalesOrderNoPaymentGiftCardConnectorToGiftCardProportionalValueFacadeInterface::class,
            $container[JellyfishSalesOrderNoPaymentGiftCardConnectorDependencyProvider::FACADE_GIFT_CARD_PROPORTIONAL_VALUE],
        );
    }
}
