<?php

namespace FondOfOryx\Zed\CustomerBrandProductListConnector\Business;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\CustomerBrandProductListConnector\Business\Persister\CustomerBrandRelationPersister;
use FondOfOryx\Zed\CustomerBrandProductListConnector\CustomerBrandProductListConnectorDependencyProvider;
use FondOfOryx\Zed\CustomerBrandProductListConnector\Dependecny\Facade\CustomerBrandProductListConnectorToBrandCustomerFacadeInterface;
use FondOfOryx\Zed\CustomerBrandProductListConnector\Dependecny\Facade\CustomerBrandProductListConnectorToBrandProductListConnectorFacadeInterface;
use Spryker\Zed\Kernel\Container;

class CustomerBrandProductListConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\CustomerBrandProductListConnector\Dependecny\Facade\CustomerBrandProductListConnectorToBrandProductListConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $brandProductListConnectorFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CustomerBrandProductListConnector\Dependecny\Facade\CustomerBrandProductListConnectorToBrandCustomerFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $brandCustomerFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CustomerBrandProductListConnector\Business\CustomerBrandProductListConnectorBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandProductListConnectorFacadeMock = $this->getMockBuilder(
            CustomerBrandProductListConnectorToBrandProductListConnectorFacadeInterface::class,
        )->disableOriginalConstructor()->getMock();

        $this->brandCustomerFacadeMock = $this->getMockBuilder(
            CustomerBrandProductListConnectorToBrandCustomerFacadeInterface::class,
        )->disableOriginalConstructor()->getMock();

        $this->factory = new CustomerBrandProductListConnectorBusinessFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateCustomerBrandRelationPersister(): void
    {
        $self = $this;

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case CustomerBrandProductListConnectorDependencyProvider::FACADE_BRAND_PRODUCT_LIST_CONNECTOR:
                        return $self->brandProductListConnectorFacadeMock;
                    case CustomerBrandProductListConnectorDependencyProvider::FACADE_BRAND_CUSTOMER:
                        return $self->brandCustomerFacadeMock;
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            CustomerBrandRelationPersister::class,
            $this->factory->createCustomerBrandRelationPersister(),
        );
    }
}
