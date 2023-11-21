<?php

namespace FondOfOryx\Zed\ErpOrder\Communication;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCustomerFacadeInterface;
use FondOfOryx\Zed\ErpOrder\ErpOrderDependencyProvider;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Kernel\Container;

class ErpOrderCommunicationFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container&\PHPUnit\Framework\MockObject\MockObject
     */
    protected Container|MockObject $containerMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Communication\ErpOrderCommunicationFactory
     */
    protected ErpOrderCommunicationFactory $factory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCustomerFacadeInterface $customerFacadeMock
     */
    protected MockObject|ErpOrderToCustomerFacadeInterface $customerFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerFacadeMock = $this->getMockBuilder(ErpOrderToCustomerFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new ErpOrderCommunicationFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testGetCustomerFacade(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [ErpOrderDependencyProvider::FACADE_CUSTOMER],
            )->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ErpOrderDependencyProvider::FACADE_CUSTOMER)
            ->willReturn($this->customerFacadeMock);

        static::assertInstanceOf(
            ErpOrderToCustomerFacadeInterface::class,
            $this->factory->getCustomerFacade(),
        );
    }
}
