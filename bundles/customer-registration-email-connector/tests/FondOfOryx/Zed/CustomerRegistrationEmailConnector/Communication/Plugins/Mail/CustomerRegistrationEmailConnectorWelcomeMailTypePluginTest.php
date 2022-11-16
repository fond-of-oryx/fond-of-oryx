<?php

namespace FondOfOryx\Zed\CustomerRegistrationEmailConnector\Communication\Plugins\Mail;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\MailTransfer;
use Spryker\Zed\Mail\Business\Model\Mail\Builder\MailBuilderInterface;
use Spryker\Zed\Mail\MailConfig;

class CustomerRegistrationEmailConnectorWelcomeMailTypePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationEmailConnector\Communication\Plugins\Mail\CustomerRegistrationEmailConnectorWelcomeMailTypePlugin
     */
    protected $plugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Mail\Business\Model\Mail\Builder\MailBuilderInterface
     */
    protected $mailBuilderMock;

    /**
     * @var \Generated\Shared\Transfer\MailTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Mail\MailConfig
     */
    protected $mailConfigMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->mailBuilderMock = $this->getMockBuilder(MailBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailTransferMock = $this->getMockBuilder(MailTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->email = 'email';

        $this->firstName = 'first-name';

        $this->lastName = 'last-name';

        $this->mailConfigMock = $this->getMockBuilder(MailConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CustomerRegistrationEmailConnectorWelcomeMailTypePlugin(
            $this->mailConfigMock,
        );
    }

    /**
     * @return void
     */
    public function testGetName(): void
    {
        $this->assertIsString(
            $this->plugin->getName(),
        );
    }

    /**
     * @return void
     */
    public function testBuild(): void
    {
        $this->mailBuilderMock->expects($this->atLeastOnce())
            ->method('setSubject')
            ->willReturnSelf();

        $this->mailBuilderMock->expects($this->atLeastOnce())
            ->method('setHtmlTemplate')
            ->willReturnSelf();

        $this->mailBuilderMock->expects($this->atLeastOnce())
            ->method('setTextTemplate')
            ->willReturnSelf();

        $this->mailBuilderMock->expects($this->atLeastOnce())
            ->method('setSender')
            ->willReturnSelf();

        $this->mailBuilderMock->expects($this->atLeastOnce())
            ->method('getMailTransfer')
            ->willReturn($this->mailTransferMock);

        $this->mailTransferMock->expects($this->atLeastOnce())
            ->method('getCustomerOrFail')
            ->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('getEmail')
            ->willReturn($this->email);

        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('getFirstName')
            ->willReturn($this->firstName);

        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('getLastName')
            ->willReturn($this->lastName);

        $this->mailConfigMock->expects($this->atLeastOnce())
            ->method('getSenderEmail')
            ->willReturn($this->email);

        $this->mailConfigMock->expects($this->atLeastOnce())
            ->method('getSenderName')
            ->willReturn($this->firstName);

        $this->plugin->build(
            $this->mailBuilderMock,
        );
    }
}
