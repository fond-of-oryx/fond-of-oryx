<?php

namespace FondOfOryx\Zed\SplittableCheckout;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeBridge;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeBridge;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Checkout\Business\CheckoutFacadeInterface;
use Spryker\Zed\Customer\Business\CustomerFacadeInterface;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;
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
     * @var \FondOfOryx\Zed\SplittableCheckout\SplittableCheckoutDependencyProvider
     */
    protected $splittableCheckoutDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Checkout\Business\CheckoutFacadeInterface;
     */
    protected $checkoutFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Quote\Business\QuoteFacadeInterface
     */
    protected $quoteFacadeMock;

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

        $this->customerFacadeMock = $this->getMockBuilder(CustomerFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->checkoutFacadeMock = $this->getMockBuilder(CheckoutFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteFacadeMock = $this->getMockBuilder(QuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutDependencyProvider = new SplittableCheckoutDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $this->containerMock->expects(self::atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects(self::atLeastOnce())
            ->method('__call')
            ->withConsecutive(['checkout'], ['quote'])
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(self::atLeastOnce())
            ->method('__call')
            ->with('facade')
            ->willReturnOnConsecutiveCalls(
                $this->checkoutFacadeMock,
                $this->quoteFacadeMock
            );

        $container = $this->splittableCheckoutDependencyProvider
            ->provideBusinessLayerDependencies($this->containerMock);

        $this->assertEquals($this->containerMock, $container);

        $this->assertInstanceOf(
            SplittableCheckoutToCheckoutFacadeBridge::class,
            $this->containerMock[SplittableCheckoutDependencyProvider::FACADE_CHECKOUT]
        );

        $this->assertInstanceOf(
            SplittableCheckoutToQuoteFacadeBridge::class,
            $this->containerMock[SplittableCheckoutDependencyProvider::FACADE_QUOTE]
        );
    }
}
