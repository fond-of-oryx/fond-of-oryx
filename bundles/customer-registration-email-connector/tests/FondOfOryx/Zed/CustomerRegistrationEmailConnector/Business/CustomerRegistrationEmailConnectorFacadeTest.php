<?php

namespace FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\Steps\WelcomeMailSenderStepInterface;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;

class CustomerRegistrationEmailConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\CustomerRegistrationEmailConnectorFacade
     */
    protected $customerRegistrationEmailConnectorFacade;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\CustomerRegistrationEmailConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationEmailConnectorBusinessFactoryMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationRequestTransfer;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\Steps\WelcomeMailSenderStepInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $welcomeMailSenderMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->customerRegistrationEmailConnectorBusinessFactoryMock = $this->getMockBuilder(CustomerRegistrationEmailConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationRequestTransfer = $this->getMockBuilder(CustomerRegistrationRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->welcomeMailSenderMock = $this->getMockBuilder(WelcomeMailSenderStepInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationEmailConnectorFacade = new CustomerRegistrationEmailConnectorFacade();
        $this->customerRegistrationEmailConnectorFacade->setFactory($this->customerRegistrationEmailConnectorBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testSendWelcomeMail(): void
    {
        $this->customerRegistrationEmailConnectorBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createWelcomeMailSenderStep')
            ->willReturn($this->welcomeMailSenderMock);

        $this->welcomeMailSenderMock->expects($this->atLeastOnce())
            ->method('sendWelcomeMail')
            ->with($this->customerRegistrationRequestTransfer)->willReturn($this->customerRegistrationRequestTransfer);

        $this->customerRegistrationEmailConnectorFacade->sendWelcomeMail($this->customerRegistrationRequestTransfer);
    }
}
