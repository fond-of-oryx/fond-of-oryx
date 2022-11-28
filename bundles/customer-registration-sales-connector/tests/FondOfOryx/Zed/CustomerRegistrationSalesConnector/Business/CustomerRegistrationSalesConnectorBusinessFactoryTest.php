<?php

namespace FondOfOryx\Zed\CustomerRegistrationSalesConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerRegistrationSalesConnector\Business\Processor\RegistrationProcessorInterface;
use FondOfOryx\Zed\CustomerRegistrationSalesConnector\CustomerRegistrationSalesConnectorDependencyProvider;
use FondOfOryx\Zed\CustomerRegistrationSalesConnector\Dependency\Facade\CustomerRegistrationSalesConnectorToCustomerRegistrationFacadeInterface;
use Spryker\Zed\Kernel\Container;

class CustomerRegistrationSalesConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationSalesConnector\Business\CustomerRegistrationSalesConnectorBusinessFactory
     */
    protected $customerRegistrationSalesConnectorBusinessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationSalesConnector\Dependency\Facade\CustomerRegistrationSalesConnectorToCustomerRegistrationFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationFacadeMock = $this->getMockBuilder(CustomerRegistrationSalesConnectorToCustomerRegistrationFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationSalesConnectorBusinessFactory = new CustomerRegistrationSalesConnectorBusinessFactory();
        $this->customerRegistrationSalesConnectorBusinessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateOneTimePasswordStep(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CustomerRegistrationSalesConnectorDependencyProvider::FACADE_CUSTOMER_REGISTRATION],
            )
            ->willReturnOnConsecutiveCalls(
                $this->customerRegistrationFacadeMock,
            );

        $this->assertInstanceOf(
            RegistrationProcessorInterface::class,
            $this->customerRegistrationSalesConnectorBusinessFactory->createRegistrationProcessor(),
        );
    }
}
