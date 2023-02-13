<?php

namespace FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\Mail;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\MailTransfer;
use Spryker\Zed\Mail\Business\Model\Mail\Builder\MailBuilder;
use Spryker\Zed\Mail\MailConfig;

class CustomerRegistrationConfirmationMailTypeBuilderTest extends Unit
{
    /**
     * @var \Spryker\Zed\Mail\Business\Model\Mail\Builder\MailBuilder|\PHPUnit\Framework\MockObject\MockObject
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
     * @var \Spryker\Zed\Mail\MailConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailConfigMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\Mail\CustomerRegistrationConfirmationMailTypeBuilder
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->mailBuilderMock = $this->getMockBuilder(MailBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailTransferMock = $this->getMockBuilder(MailTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailConfigMock = $this->getMockBuilder(MailConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CustomerRegistrationConfirmationMailTypeBuilder($this->mailConfigMock);
    }

    /**
     * @return void
     */
    public function testGetName(): void
    {
        static::assertEquals(
            'customer registration confirmation mail',
            $this->plugin->getName(),
        );
    }

    /**
     * @return void
     */
    public function testBuild(): void
    {
        $this->mailBuilderMock->expects(static::atLeastOnce())
            ->method('setSubject')
            ->with('mail.customer.customer-registration.welcome-mail.subject')
            ->willReturnSelf();

        $this->mailBuilderMock->expects(static::atLeastOnce())
            ->method('setHtmlTemplate')
            ->with('CustomerRegistrationEmailConnector/Mail/customer_registration_email_connector_welcome_mail.html.twig')
            ->willReturnSelf();

        $this->mailBuilderMock->expects(static::atLeastOnce())
            ->method('setTextTemplate')
            ->with('CustomerRegistrationEmailConnector/Mail/customer_registration_email_connector_welcome_mail.text.twig')
            ->willReturnSelf();

        $this->mailConfigMock->expects(static::atLeastOnce())
            ->method('getSenderEmail')
            ->willReturn('sender@fondof.de');

        $this->mailConfigMock->expects(static::atLeastOnce())
            ->method('getSenderName')
            ->willReturn('FONDOF');

        $this->mailBuilderMock->expects(static::atLeastOnce())
            ->method('setSender')
            ->with('sender@fondof.de', 'FONDOF')
            ->willReturnSelf();

        $this->mailBuilderMock->expects(static::atLeastOnce())
            ->method('getMailTransfer')
            ->willReturn($this->mailTransferMock);

        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerOrFail')
            ->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getEmail')
            ->willReturn('john.doe@fondof.de');

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getFirstName')
            ->willReturn('John');

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getLastName')
            ->willReturn('Doe');

        $this->plugin->build($this->mailBuilderMock);
    }
}
