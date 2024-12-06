<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Filter\RestrictedItemsFilter;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Validator\ProductListRestrictionValidator;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\BusinessOnBehalfProductListConnectorDependencyProvider;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToBusinessOnBehalfFacadeInterface;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToCustomerFacadeInterface;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToProductListFacadeInterface;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Persistence\BusinessOnBehalfProductListConnectorRepository;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Kernel\Container;

class BusinessOnBehalfProductListConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected Container|MockObject $containerMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToCustomerFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|BusinessOnBehalfProductListConnectorToCustomerFacadeInterface $customerFacadeMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToBusinessOnBehalfFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected BusinessOnBehalfProductListConnectorToBusinessOnBehalfFacadeInterface|MockObject $businessOnBehalfFacadeMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToProductListFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|BusinessOnBehalfProductListConnectorToProductListFacadeInterface $productListFacadeMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Persistence\BusinessOnBehalfProductListConnectorRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected BusinessOnBehalfProductListConnectorRepository|MockObject $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\BusinessOnBehalfProductListConnectorBusinessFactory
     */
    protected BusinessOnBehalfProductListConnectorBusinessFactory $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerFacadeMock = $this->getMockBuilder(BusinessOnBehalfProductListConnectorToCustomerFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessOnBehalfFacadeMock = $this->getMockBuilder(BusinessOnBehalfProductListConnectorToBusinessOnBehalfFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListFacadeMock = $this->getMockBuilder(BusinessOnBehalfProductListConnectorToProductListFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(BusinessOnBehalfProductListConnectorRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new BusinessOnBehalfProductListConnectorBusinessFactory();
        $this->businessFactory->setRepository($this->repositoryMock);
        $this->businessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateRestrictedItemsFilter(): void
    {
        $self = $this;

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case BusinessOnBehalfProductListConnectorDependencyProvider::FACADE_CUSTOMER:
                        return $self->customerFacadeMock;
                    case BusinessOnBehalfProductListConnectorDependencyProvider::FACADE_BUSINESS_ON_BEHALF:
                        return $self->businessOnBehalfFacadeMock;
                    case BusinessOnBehalfProductListConnectorDependencyProvider::FACADE_PRODUCT_LIST:
                        return $self->productListFacadeMock;
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            RestrictedItemsFilter::class,
            $this->businessFactory->createRestrictedItemsFilter(),
        );
    }

    /**
     * @return void
     */
    public function testCreateProductListRestrictionValidator(): void
    {
        $self = $this;

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case BusinessOnBehalfProductListConnectorDependencyProvider::FACADE_CUSTOMER:
                        return $self->customerFacadeMock;
                    case BusinessOnBehalfProductListConnectorDependencyProvider::FACADE_BUSINESS_ON_BEHALF:
                        return $self->businessOnBehalfFacadeMock;
                    case BusinessOnBehalfProductListConnectorDependencyProvider::FACADE_PRODUCT_LIST:
                        return $self->productListFacadeMock;
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            ProductListRestrictionValidator::class,
            $this->businessFactory->createProductListRestrictionValidator(),
        );
    }
}
