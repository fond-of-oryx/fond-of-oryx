<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToBusinessOnBehalfFacadeInterface;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToCustomerFacadeInterface;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToProductListFacadeInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\BusinessOnBehalf\Business\BusinessOnBehalfFacadeInterface;
use Spryker\Zed\Customer\Business\CustomerFacadeInterface;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;
use Spryker\Zed\ProductList\Business\ProductListFacadeInterface;

class BusinessOnBehalfProductListConnectorDependencyProviderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected MockObject|Container $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Locator
     */
    protected MockObject|Locator $locatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\BundleProxy
     */
    protected MockObject|BundleProxy $bundleProxyMock;

    /**
     * @var \Spryker\Zed\BusinessOnBehalf\Business\BusinessOnBehalfFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected BusinessOnBehalfFacadeInterface|MockObject $businessOnBehalfFacadeMock;

    /**
     * @var \Spryker\Zed\Customer\Business\CustomerFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CustomerFacadeInterface|MockObject $customerFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\ProductList\Business\ProductListFacadeInterface
     */
    protected MockObject|ProductListFacadeInterface $productListFacadeMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\BusinessOnBehalfProductListConnectorDependencyProvider
     */
    protected BusinessOnBehalfProductListConnectorDependencyProvider $dependencyProvider;

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

        $this->businessOnBehalfFacadeMock = $this->getMockBuilder(BusinessOnBehalfFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerFacadeMock = $this->getMockBuilder(CustomerFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListFacadeMock = $this->getMockBuilder(ProductListFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dependencyProvider = new BusinessOnBehalfProductListConnectorDependencyProvider();
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
                    case 'businessOnBehalf':
                        return $self->bundleProxyMock;
                    case 'customer':
                        return $self->bundleProxyMock;
                    case 'productList':
                        return $self->bundleProxyMock;
                }

                throw new Exception('Invalid key');
            });

        $this->bundleProxyMock->expects($this->atLeastOnce())
            ->method('__call')
            ->with('facade')
            ->willReturnOnConsecutiveCalls(
                $this->businessOnBehalfFacadeMock,
                $this->customerFacadeMock,
                $this->productListFacadeMock,
            );

        $container = $this->dependencyProvider->provideBusinessLayerDependencies($this->containerMock);

        static::assertEquals($this->containerMock, $container);

        static::assertInstanceOf(
            BusinessOnBehalfProductListConnectorToBusinessOnBehalfFacadeInterface::class,
            $container[BusinessOnBehalfProductListConnectorDependencyProvider::FACADE_BUSINESS_ON_BEHALF],
        );

        static::assertInstanceOf(
            BusinessOnBehalfProductListConnectorToCustomerFacadeInterface::class,
            $container[BusinessOnBehalfProductListConnectorDependencyProvider::FACADE_CUSTOMER],
        );

        static::assertInstanceOf(
            BusinessOnBehalfProductListConnectorToProductListFacadeInterface::class,
            $container[BusinessOnBehalfProductListConnectorDependencyProvider::FACADE_PRODUCT_LIST],
        );
    }
}
