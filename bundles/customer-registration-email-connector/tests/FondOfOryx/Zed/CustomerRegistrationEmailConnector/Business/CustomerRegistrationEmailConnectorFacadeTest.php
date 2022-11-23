<?php

namespace FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\Sender\WelcomeMailSenderInterface;
use Generated\Shared\Transfer\CustomerTransfer;

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
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\Sender\WelcomeMailSenderInterface|\PHPUnit\Framework\MockObject\MockObject
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

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->welcomeMailSenderMock = $this->getMockBuilder(WelcomeMailSenderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationEmailConnectorFacade = new CustomerRegistrationEmailConnectorFacade();
        $this->customerRegistrationEmailConnectorFacade->setFactory($this->customerRegistrationEmailConnectorBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testSendCustomerRegistrationMail(): void
    {
        $this->customerRegistrationEmailConnectorBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createWelcomeMailSender')
            ->willReturn($this->welcomeMailSenderMock);

        $this->welcomeMailSenderMock->expects($this->atLeastOnce())
            ->method('sendWelcomeMail')
            ->with($this->customerTransferMock);

        $this->customerRegistrationEmailConnectorFacade->sendWelcomeMail($this->customerTransferMock, 'test');
    }
}
