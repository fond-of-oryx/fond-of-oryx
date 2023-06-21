<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business;

use Codeception\Test\Unit;
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
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Zed\Kernel\Container&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected Container|MockObject $containerMock;

    /**
     * @var (\FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToCustomerFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|BusinessOnBehalfProductListConnectorToCustomerFacadeInterface $customerFacadeMock;

    /**
     * @var (\FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToBusinessOnBehalfFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected BusinessOnBehalfProductListConnectorToBusinessOnBehalfFacadeInterface|MockObject $businessOnBehalfFacadeMock;

    /**
     * @var (\FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToProductListFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|BusinessOnBehalfProductListConnectorToProductListFacadeInterface $productListFacadeMock;

    /**
     * @var (\FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Persistence\BusinessOnBehalfProductListConnectorRepository&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
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
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [BusinessOnBehalfProductListConnectorDependencyProvider::FACADE_CUSTOMER],
                [BusinessOnBehalfProductListConnectorDependencyProvider::FACADE_BUSINESS_ON_BEHALF],
                [BusinessOnBehalfProductListConnectorDependencyProvider::FACADE_CUSTOMER],
                [BusinessOnBehalfProductListConnectorDependencyProvider::FACADE_PRODUCT_LIST],
            )
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [BusinessOnBehalfProductListConnectorDependencyProvider::FACADE_CUSTOMER],
                [BusinessOnBehalfProductListConnectorDependencyProvider::FACADE_BUSINESS_ON_BEHALF],
                [BusinessOnBehalfProductListConnectorDependencyProvider::FACADE_CUSTOMER],
                [BusinessOnBehalfProductListConnectorDependencyProvider::FACADE_PRODUCT_LIST],
            )
            ->willReturnOnConsecutiveCalls(
                $this->customerFacadeMock,
                $this->businessOnBehalfFacadeMock,
                $this->customerFacadeMock,
                $this->productListFacadeMock,
            );

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
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [BusinessOnBehalfProductListConnectorDependencyProvider::FACADE_CUSTOMER],
                [BusinessOnBehalfProductListConnectorDependencyProvider::FACADE_BUSINESS_ON_BEHALF],
                [BusinessOnBehalfProductListConnectorDependencyProvider::FACADE_CUSTOMER],
                [BusinessOnBehalfProductListConnectorDependencyProvider::FACADE_PRODUCT_LIST],
            )
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [BusinessOnBehalfProductListConnectorDependencyProvider::FACADE_CUSTOMER],
                [BusinessOnBehalfProductListConnectorDependencyProvider::FACADE_BUSINESS_ON_BEHALF],
                [BusinessOnBehalfProductListConnectorDependencyProvider::FACADE_CUSTOMER],
                [BusinessOnBehalfProductListConnectorDependencyProvider::FACADE_PRODUCT_LIST],
            )
            ->willReturnOnConsecutiveCalls(
                $this->customerFacadeMock,
                $this->businessOnBehalfFacadeMock,
                $this->customerFacadeMock,
                $this->productListFacadeMock,
            );

        static::assertInstanceOf(
            ProductListRestrictionValidator::class,
            $this->businessFactory->createProductListRestrictionValidator(),
        );
    }
}
