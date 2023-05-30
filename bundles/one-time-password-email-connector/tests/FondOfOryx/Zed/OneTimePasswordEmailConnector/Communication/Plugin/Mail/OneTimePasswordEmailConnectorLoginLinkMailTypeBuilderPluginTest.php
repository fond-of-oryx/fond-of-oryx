<?php

namespace FondOfOryx\Zed\OneTimePasswordEmailConnector\Communication\Plugin\Mail;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\MailTransfer;

class OneTimePasswordEmailConnectorLoginLinkMailTypeBuilderPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\MailTransfer
     */
    protected $mailTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CustomerTransfer
     */
    protected $customerTransferMock;

    /**
     * @var \FondOfOryx\Zed\OneTimePasswordEmailConnector\Communication\Plugin\Mail\OneTimePasswordEmailConnectorLoginLinkMailTypeBuilderPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->mailTransferMock = $this->getMockBuilder(MailTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new OneTimePasswordEmailConnectorLoginLinkMailTypeBuilderPlugin();
    }

    /**
     * @return void
     */
    public function testGetName(): void
    {
        static::assertEquals(
            OneTimePasswordEmailConnectorLoginLinkMailTypeBuilderPlugin::MAIL_TYPE,
            $this->plugin->getName(),
        );
    }

    /**
     * @return void
     */
    public function testBuild(): void
    {
        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('setSubject')
            ->with('mail.customer.one-time-password.login-link.subject')
            ->willReturnSelf();

        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerOrFail')
            ->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getFirstName')
            ->willReturn('John');

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getLastName')
            ->willReturn('Doe');

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getEmail')
            ->willReturn('john.doe@mailinator.com');

        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('addTemplate')
            ->willReturnSelf();

        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('addRecipient')
            ->willReturnSelf();

        $mailTransfer = $this->plugin->build($this->mailTransferMock);

        static::assertEquals($mailTransfer, $this->mailTransferMock);
    }
}
