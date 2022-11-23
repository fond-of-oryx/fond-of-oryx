<?php

namespace FondOfOryx\Zed\CustomerRegistrationEmailConnector\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\MailTransfer;
use Spryker\Zed\Mail\Business\MailFacadeInterface;

class CustomerRegistrationEmailConnectorToMailBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationEmailConnector\Dependency\Facade\CustomerRegistrationEmailConnectorToMailBridge
     */
    protected $oneTimePasswordEmailConnectorToMailBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Mail\Business\MailFacadeInterface
     */
    protected $mailFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\MailTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->mailFacadeMock = $this->getMockBuilder(MailFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailTransferMock = $this->getMockBuilder(MailTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordEmailConnectorToMailBridge = new CustomerRegistrationEmailConnectorToMailBridge(
            $this->mailFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testHandleMail(): void
    {
        $this->oneTimePasswordEmailConnectorToMailBridge->handleMail(
            $this->mailTransferMock,
        );
    }
}
