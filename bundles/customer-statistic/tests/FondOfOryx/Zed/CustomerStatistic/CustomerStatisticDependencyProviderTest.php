<?php

namespace FondOfOryx\Zed\CustomerStatistic;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerStatistic\Dependency\QueryContainer\CustomerStatisticToCustomerQueryContainerBridge;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Customer\Persistence\CustomerQueryContainerInterface;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;

class CustomerStatisticDependencyProviderTest extends Unit
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
     * @var \Spryker\Zed\Customer\Persistence\CustomerQueryContainerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerQueryContainerMock;

    /**
     * @var \FondOfOryx\Zed\CustomerStatistic\CustomerStatisticDependencyProvider
     */
    protected $customerStatisticDependencyProvider;

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

        $this->customerQueryContainerMock = $this->getMockBuilder(CustomerQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerStatisticDependencyProvider = new CustomerStatisticDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvidePersistenceLayerDependencies(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects(static::atLeastOnce())
            ->method('__call')
            ->with('customer')
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->with('queryContainer')
            ->willReturn($this->customerQueryContainerMock);

        $container = $this->customerStatisticDependencyProvider->providePersistenceLayerDependencies(
            $this->containerMock,
        );

        static::assertEquals($this->containerMock, $container);

        static::assertInstanceOf(
            CustomerStatisticToCustomerQueryContainerBridge::class,
            $container[CustomerStatisticDependencyProvider::QUERY_CONTAINER_CUSTOMER],
        );
    }
}
