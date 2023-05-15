<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableCheckout\Business\SplittableCheckoutFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToCartFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToQuoteFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableCheckoutFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableTotalsFacadeInterface;
use FondOfOryx\Zed\SplittableTotals\Business\SplittableTotalsFacadeInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Cart\Business\CartFacadeInterface;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;
use Spryker\Zed\Quote\Business\QuoteFacadeInterface;

class SplittableCheckoutRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Zed\Kernel\Container&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected Container|MockObject $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Zed\Kernel\Locator&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected MockObject|Locator $locatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Shared\Kernel\BundleProxy&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected BundleProxy|MockObject $bundleProxyMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Zed\Cart\Business\CartFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected MockObject|CartFacadeInterface $cartFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Zed\Quote\Business\QuoteFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected QuoteFacadeInterface|MockObject $quoteFacadeMock;

    /**
     * @var (\FondOfOryx\Zed\SplittableCheckout\Business\SplittableCheckoutFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected SplittableCheckoutFacadeInterface|MockObject $splittableCheckoutFacadeMock;

    /**
     * @var (\FondOfOryx\Zed\SplittableTotals\Business\SplittableTotalsFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected SplittableTotalsFacadeInterface|MockObject $splittableTotalsFacadeMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\SplittableCheckoutRestApiDependencyProvider
     */
    protected SplittableCheckoutRestApiDependencyProvider $dependencyProvider;

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

        $this->cartFacadeMock = $this->getMockBuilder(CartFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteFacadeMock = $this->getMockBuilder(QuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutFacadeMock = $this->getMockBuilder(SplittableCheckoutFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableTotalsFacadeMock = $this->getMockBuilder(SplittableTotalsFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dependencyProvider = new SplittableCheckoutRestApiDependencyProvider();
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
            ->withConsecutive(['cart'], ['quote'], ['splittableCheckout'], ['splittableTotals'])
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->withConsecutive(['facade'], ['facade'], ['facade'], ['facade'])
            ->willReturnOnConsecutiveCalls(
                $this->cartFacadeMock,
                $this->quoteFacadeMock,
                $this->splittableCheckoutFacadeMock,
                $this->splittableTotalsFacadeMock,
            );

        $container = $this->dependencyProvider->provideBusinessLayerDependencies($this->containerMock);

        static::assertEquals($this->containerMock, $container);

        static::assertInstanceOf(
            SplittableCheckoutRestApiToCartFacadeInterface::class,
            $container[SplittableCheckoutRestApiDependencyProvider::FACADE_CART],
        );

        static::assertInstanceOf(
            SplittableCheckoutRestApiToQuoteFacadeInterface::class,
            $container[SplittableCheckoutRestApiDependencyProvider::FACADE_QUOTE],
        );

        static::assertInstanceOf(
            SplittableCheckoutRestApiToSplittableCheckoutFacadeInterface::class,
            $container[SplittableCheckoutRestApiDependencyProvider::FACADE_SPLITTABLE_CHECKOUT],
        );

        static::assertInstanceOf(
            SplittableCheckoutRestApiToSplittableTotalsFacadeInterface::class,
            $container[SplittableCheckoutRestApiDependencyProvider::FACADE_SPLITTABLE_TOTALS],
        );

        static::assertIsArray($container[SplittableCheckoutRestApiDependencyProvider::PLUGINS_QUOTE_EXPANDER]);
    }
}
