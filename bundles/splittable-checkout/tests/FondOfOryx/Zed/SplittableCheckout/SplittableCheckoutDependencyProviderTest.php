<?php

namespace FondOfOryx\Zed\SplittableCheckout;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToPermissionFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToSplittableQuoteFacadeInterface;
use FondOfOryx\Zed\SplittableQuote\Business\SplittableQuoteFacadeInterface;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Checkout\Business\CheckoutFacadeInterface;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;
use Spryker\Zed\Permission\Business\PermissionFacadeInterface;
use Spryker\Zed\Quote\Business\QuoteFacadeInterface;

class SplittableCheckoutDependencyProviderTest extends Unit
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
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Checkout\Business\CheckoutFacadeInterface;
     */
    protected $checkoutFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Quote\Business\QuoteFacadeInterface
     */
    protected $quoteFacadeMock;

    /**
     * @var \FondOfOryx\Zed\SplittableQuote\Business\SplittableQuoteFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableQuoteFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Permission\Business\PermissionFacadeInterface|mixed
     */
    protected $permissionFacadeMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckout\SplittableCheckoutDependencyProvider
     */
    protected $splittableCheckoutDependencyProvider;

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

        $this->checkoutFacadeMock = $this->getMockBuilder(CheckoutFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteFacadeMock = $this->getMockBuilder(QuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableQuoteFacadeMock = $this->getMockBuilder(SplittableQuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->permissionFacadeMock = $this->getMockBuilder(PermissionFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutDependencyProvider = new SplittableCheckoutDependencyProvider();
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
                    case 'checkout':
                        return $self->bundleProxyMock;
                    case 'quote':
                        return $self->bundleProxyMock;
                    case 'splittableQuote':
                        return $self->bundleProxyMock;
                    case 'permission':
                        return $self->bundleProxyMock;
                }

                throw new Exception('Invalid key');
            });

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->with('facade')
            ->willReturnOnConsecutiveCalls(
                $this->checkoutFacadeMock,
                $this->quoteFacadeMock,
                $this->splittableQuoteFacadeMock,
                $this->permissionFacadeMock,
            );

        $container = $this->splittableCheckoutDependencyProvider
            ->provideBusinessLayerDependencies($this->containerMock);

        static::assertEquals($this->containerMock, $container);

        static::assertInstanceOf(
            SplittableCheckoutToCheckoutFacadeInterface::class,
            $this->containerMock[SplittableCheckoutDependencyProvider::FACADE_CHECKOUT],
        );

        static::assertInstanceOf(
            SplittableCheckoutToQuoteFacadeInterface::class,
            $this->containerMock[SplittableCheckoutDependencyProvider::FACADE_QUOTE],
        );

        static::assertInstanceOf(
            SplittableCheckoutToSplittableQuoteFacadeInterface::class,
            $this->containerMock[SplittableCheckoutDependencyProvider::FACADE_SPLITTABLE_QUOTE],
        );

        static::assertInstanceOf(
            SplittableCheckoutToPermissionFacadeInterface::class,
            $this->containerMock[SplittableCheckoutDependencyProvider::FACADE_PERMISSION],
        );

        static::assertEquals(
            null,
            $this->containerMock[SplittableCheckoutDependencyProvider::PLUGIN_IDENTIFIER_EXTRACTOR],
        );
    }
}
