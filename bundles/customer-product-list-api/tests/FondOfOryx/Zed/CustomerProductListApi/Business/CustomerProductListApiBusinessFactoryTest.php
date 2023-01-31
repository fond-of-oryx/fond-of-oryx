<?php

namespace FondOfOryx\Zed\CustomerProductListApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerProductListApi\Business\Model\CustomerProductListApiInterface;
use FondOfOryx\Zed\CustomerProductListApi\CustomerProductListApiDependencyProvider;
use FondOfOryx\Zed\CustomerProductListApi\Dependency\Facade\CustomerProductListApiToApiFacadeInterface;
use FondOfOryx\Zed\CustomerProductListApi\Dependency\Facade\CustomerProductListApiToCustomerProductListConnectorFacadeInterface;
use Spryker\Zed\Kernel\Container;

class CustomerProductListApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CustomerProductListApi\Dependency\Facade\CustomerProductListApiToCustomerProductListConnectorFacadeInterface
     */
    protected $customerProductListConnectorFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CustomerProductListApi\Dependency\Facade\CustomerProductListApiToApiFacadeInterface
     */
    protected $apiFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListApi\Business\CustomerProductListApiBusinessFactory
     */
    protected $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerProductListConnectorFacadeMock = $this
            ->getMockBuilder(CustomerProductListApiToCustomerProductListConnectorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiFacadeMock = $this
            ->getMockBuilder(CustomerProductListApiToApiFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new CustomerProductListApiBusinessFactory();
        $this->businessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateCustomerProductListApi(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [CustomerProductListApiDependencyProvider::FACADE_CUSTOMER_PRODUCT_LIST_CONNECTOR],
                [CustomerProductListApiDependencyProvider::FACADE_API],
            )->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CustomerProductListApiDependencyProvider::FACADE_CUSTOMER_PRODUCT_LIST_CONNECTOR],
                [CustomerProductListApiDependencyProvider::FACADE_API],
            )->willReturnOnConsecutiveCalls(
                $this->customerProductListConnectorFacadeMock,
                $this->apiFacadeMock,
            );

        static::assertInstanceOf(
            CustomerProductListApiInterface::class,
            $this->businessFactory->createCustomerProductListApi(),
        );
    }
}
