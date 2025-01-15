<?php

namespace FondOfOryx\Zed\CustomerProductListApi;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\CustomerProductListApi\Dependency\Facade\CustomerProductListApiToApiFacadeInterface;
use FondOfOryx\Zed\CustomerProductListApi\Dependency\Facade\CustomerProductListApiToCustomerProductListConnectorFacadeInterface;
use FondOfOryx\Zed\CustomerProductListConnector\Business\CustomerProductListConnectorFacadeInterface;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Api\Business\ApiFacadeInterface;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;

class CustomerProductListApiDependencyProviderTest extends Unit
{
    /**
     * @var \Spryker\Zed\Api\Business\ApiFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiFacadeMock;

    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject
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
     * @var \FondOfOryx\Zed\CustomerProductListConnector\Business\CustomerProductListConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerProductListConnectorFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListApi\CustomerProductListApiDependencyProvider
     */
    protected $customerProductListApiDependencyProvider;

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

        $this->customerProductListConnectorFacadeMock = $this
            ->getMockBuilder(CustomerProductListConnectorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiFacadeMock = $this
            ->getMockBuilder(ApiFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerProductListApiDependencyProvider = new CustomerProductListApiDependencyProvider();
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
                    case 'customerProductListConnector':
                        return $self->bundleProxyMock;
                    case 'api':
                        return $self->bundleProxyMock;
                }

                throw new Exception('Invalid key');
            });

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->willReturnOnConsecutiveCalls(
                $this->customerProductListConnectorFacadeMock,
                $this->apiFacadeMock,
            );

        $container = $this->customerProductListApiDependencyProvider
            ->provideBusinessLayerDependencies($this->containerMock);

        static::assertEquals($this->containerMock, $container);

        static::assertInstanceOf(
            CustomerProductListApiToCustomerProductListConnectorFacadeInterface::class,
            $container[CustomerProductListApiDependencyProvider::FACADE_CUSTOMER_PRODUCT_LIST_CONNECTOR],
        );

        static::assertInstanceOf(
            CustomerProductListApiToApiFacadeInterface::class,
            $container[CustomerProductListApiDependencyProvider::FACADE_API],
        );
    }
}
