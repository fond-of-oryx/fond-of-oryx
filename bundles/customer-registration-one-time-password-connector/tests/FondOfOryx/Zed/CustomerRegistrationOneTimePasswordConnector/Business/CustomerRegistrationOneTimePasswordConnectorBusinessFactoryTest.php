<?php

namespace FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Business\Steps\OneTimePasswordStepInterface;
use FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\CustomerRegistrationOneTimePasswordConnectorDependencyProvider;
use FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Dependency\Facade\CustomerRegistrationOneTimePasswordConnectorToLocaleFacadeInterface;
use FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Dependency\Facade\CustomerRegistrationOneTimePasswordConnectorToOneTimePasswordFacadeInterface;
use Spryker\Zed\Kernel\Container;

class CustomerRegistrationOneTimePasswordConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Business\CustomerRegistrationOneTimePasswordConnectorBusinessFactory
     */
    protected $customerRegistrationEmailConnectorBusinessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Dependency\Facade\CustomerRegistrationOneTimePasswordConnectorToOneTimePasswordFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $otpFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Dependency\Facade\CustomerRegistrationOneTimePasswordConnectorToLocaleFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->otpFacadeMock = $this->getMockBuilder(CustomerRegistrationOneTimePasswordConnectorToOneTimePasswordFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeFacadeMock = $this->getMockBuilder(CustomerRegistrationOneTimePasswordConnectorToLocaleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationEmailConnectorBusinessFactory = new CustomerRegistrationOneTimePasswordConnectorBusinessFactory();
        $this->customerRegistrationEmailConnectorBusinessFactory->setContainer($this->containerMock);
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
                [CustomerRegistrationOneTimePasswordConnectorDependencyProvider::FACADE_ONE_TIME_PASSWORD],
                [CustomerRegistrationOneTimePasswordConnectorDependencyProvider::FACADE_LOCALE],
                [CustomerRegistrationOneTimePasswordConnectorDependencyProvider::PLUGINS_ONE_TIME_PASSWORD_PRE],
                [CustomerRegistrationOneTimePasswordConnectorDependencyProvider::PLUGINS_ONE_TIME_PASSWORD_POST],
            )
            ->willReturnOnConsecutiveCalls(
                $this->otpFacadeMock,
                $this->localeFacadeMock,
                [],
                [],
            );

        $this->assertInstanceOf(
            OneTimePasswordStepInterface::class,
            $this->customerRegistrationEmailConnectorBusinessFactory->createOneTimePasswordStep(),
        );
    }
}
