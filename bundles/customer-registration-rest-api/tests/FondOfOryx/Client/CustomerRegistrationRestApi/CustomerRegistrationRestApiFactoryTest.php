<?php

namespace FondOfOryx\Client\CustomerRegistrationRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\CustomerRegistrationRestApi\Dependency\Client\CustomerRegistrationRestApiToZedRequestClientInterface;
use FondOfOryx\Client\CustomerRegistrationRestApi\Zed\CustomerRegistrationRestApiStubInterface;
use Spryker\Client\Kernel\Container;

class CustomerRegistrationRestApiFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\CustomerRegistrationRestApi\CustomerRegistrationRestApiFactory
     */
    protected $customerRegistrationRestApiFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    protected $zedRequestClientMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(CustomerRegistrationRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationRestApiFactory = new CustomerRegistrationRestApiFactory();
        $this->customerRegistrationRestApiFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testGetZedRequestClient(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(CustomerRegistrationRestApiDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn($this->zedRequestClientMock);

        $this->assertInstanceOf(
            CustomerRegistrationRestApiStubInterface::class,
            $this->customerRegistrationRestApiFactory->createCustomerRegistrationZedStub(),
        );
    }
}
