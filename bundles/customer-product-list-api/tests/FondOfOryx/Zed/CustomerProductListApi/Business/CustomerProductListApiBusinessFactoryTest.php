<?php

namespace FondOfOryx\Zed\CustomerProductListApi\Business;

use Codeception\Test\Unit;
use Exception;
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
        $self = $this;

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case CustomerProductListApiDependencyProvider::FACADE_CUSTOMER_PRODUCT_LIST_CONNECTOR:
                        return $self->customerProductListConnectorFacadeMock;
                    case CustomerProductListApiDependencyProvider::FACADE_API:
                        return $self->apiFacadeMock;
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            CustomerProductListApiInterface::class,
            $this->businessFactory->createCustomerProductListApi(),
        );
    }
}
