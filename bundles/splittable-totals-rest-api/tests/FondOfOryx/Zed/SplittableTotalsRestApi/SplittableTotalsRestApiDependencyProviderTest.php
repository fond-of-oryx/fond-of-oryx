<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableTotals\Business\SplittableTotalsFacadeInterface;
use FondOfOryx\Zed\SplittableTotalsRestApi\Dependency\Facade\SplittableTotalsRestApiToQuoteFacadeInterface;
use FondOfOryx\Zed\SplittableTotalsRestApi\Dependency\Facade\SplittableTotalsRestApiToSplittableTotalsFacadeInterface;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;
use Spryker\Zed\Quote\Business\QuoteFacadeInterface;

class SplittableTotalsRestApiDependencyProviderTest extends Unit
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
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Quote\Business\QuoteFacadeInterface
     */
    protected $quoteFacadeMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotals\Business\SplittableTotalsFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableTotalsFacadeMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApi\SplittableTotalsRestApiDependencyProvider
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

        $this->quoteFacadeMock = $this->getMockBuilder(QuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableTotalsFacadeMock = $this->getMockBuilder(SplittableTotalsFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dependencyProvider = new SplittableTotalsRestApiDependencyProvider();
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
            ->withConsecutive(['quote'], ['splittableTotals'])
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->withConsecutive(['facade'], ['facade'])
            ->willReturnOnConsecutiveCalls($this->quoteFacadeMock, $this->splittableTotalsFacadeMock);

        $container = $this->dependencyProvider->provideBusinessLayerDependencies($this->containerMock);

        static::assertEquals($this->containerMock, $container);

        static::assertInstanceOf(
            SplittableTotalsRestApiToQuoteFacadeInterface::class,
            $container[SplittableTotalsRestApiDependencyProvider::FACADE_QUOTE]
        );

        static::assertInstanceOf(
            SplittableTotalsRestApiToSplittableTotalsFacadeInterface::class,
            $container[SplittableTotalsRestApiDependencyProvider::FACADE_SPLITTABLE_TOTALS]
        );

        static::assertIsArray($container[SplittableTotalsRestApiDependencyProvider::PLUGINS_QUOTE_EXPANDER]);
    }
}
