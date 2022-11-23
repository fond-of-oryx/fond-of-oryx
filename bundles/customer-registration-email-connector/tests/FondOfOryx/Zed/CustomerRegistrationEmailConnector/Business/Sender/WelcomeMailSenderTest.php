<?php

namespace FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\Sender;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerRegistrationEmailConnector\Communication\Plugins\Mail\CustomerRegistrationEmailConnectorWelcomeMailTypePlugin;
use FondOfOryx\Zed\CustomerRegistrationEmailConnector\Dependency\Facade\CustomerRegistrationEmailConnectorToMailInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\MailTransfer;

class WelcomeMailSenderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationEmailConnector\Dependency\Facade\CustomerRegistrationEmailConnectorToMailInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\Sender\WelcomeMailSenderInterface
     */
    protected $sender;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailFacadeMock = $this->getMockBuilder(CustomerRegistrationEmailConnectorToMailInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->sender = new WelcomeMailSender(
            $this->mailFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testHandleMail(): void
    {
        $self = $this;
        $this->customerTransferMock->expects(static::atLeastOnce())->method('getLocale')->willReturn($this->localeTransferMock);

        $this->mailFacadeMock->expects(static::once())->method('handleMail')->willReturnCallback(static function (MailTransfer $mailTransfer) use ($self) {
            $self->assertSame('link', $mailTransfer->getEmailVerificationLink());
            $self->assertSame(CustomerRegistrationEmailConnectorWelcomeMailTypePlugin::MAIL_TYPE, $mailTransfer->getType());
            $self->assertSame($self->customerTransferMock, $mailTransfer->getCustomer());
            $self->assertSame($self->localeTransferMock, $mailTransfer->getCustomer()->getLocale());
        });

        $this->sender->sendWelcomeMail(
            $this->customerTransferMock,
            'link',
        );
    }
}
