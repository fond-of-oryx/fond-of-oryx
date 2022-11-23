<?php

namespace FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\Sender\WelcomeMailSenderInterface;
use FondOfOryx\Zed\CustomerRegistrationEmailConnector\CustomerRegistrationEmailConnectorDependencyProvider;
use FondOfOryx\Zed\CustomerRegistrationEmailConnector\Dependency\Facade\CustomerRegistrationEmailConnectorToMailBridge;
use Spryker\Zed\Kernel\Container;

class CustomerRegistrationEmailConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\CustomerRegistrationEmailConnectorBusinessFactory
     */
    protected $customerRegistrationEmailConnectorBusinessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationEmailConnector\Dependency\Facade\CustomerRegistrationEmailConnectorToMailBridge|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailFacadeMock = $this->getMockBuilder(CustomerRegistrationEmailConnectorToMailBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationEmailConnectorBusinessFactory = new CustomerRegistrationEmailConnectorBusinessFactory();
        $this->customerRegistrationEmailConnectorBusinessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateWelcomeMailSender(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(CustomerRegistrationEmailConnectorDependencyProvider::FACADE_MAIL)
            ->willReturn($this->mailFacadeMock);

        $this->assertInstanceOf(
            WelcomeMailSenderInterface::class,
            $this->customerRegistrationEmailConnectorBusinessFactory->createWelcomeMailSender(),
        );
    }
}
