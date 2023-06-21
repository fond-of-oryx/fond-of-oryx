<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business\Model\Provider;

use Codeception\Test\Unit;
use FondOfOryx\Zed\MailjetMailConnector\MailjetMailConnectorConfig;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\MailjetTemplateTransfer;
use Generated\Shared\Transfer\MailTransfer;
use Mailjet\Client;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Log\LoggerInterface;

class MailjetMailerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\MailjetMailConnectorConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|MailjetMailConnectorConfig $configMock;

    /**
     * @var \Mailjet\Client|\PHPUnit\Framework\MockObject\MockObject
     */
    protected Client|MockObject $mailjetClientMock;

    /**
     * @var \Generated\Shared\Transfer\MailTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|MailTransfer $mailTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CustomerTransfer|MockObject $customerTransferMock;

    /**
     * @var \Generated\Shared\Transfer\MailjetTemplateTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|MailjetTemplateTransfer $mailjetTemplateTransferMock;

    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\Business\Model\Provider\MailjetMailer
     */
    protected MailjetMailer $mailer;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Psr\Log\LoggerInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected LoggerInterface|MockObject $loggerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->mailTransferMock = $this->getMockBuilder(MailTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailjetTemplateTransferMock = $this->getMockBuilder(MailjetTemplateTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(MailjetMailConnectorConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailjetClientMock = $this->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->loggerMock = $this->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailer = new MailjetMailer(
            $this->configMock,
            $this->mailjetClientMock,
            $this->loggerMock,
        );
    }

    /**
     * @return void
     */
    public function testSendMail(): void
    {
        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getFromEmail')
            ->willReturn('john.doe@fondof.de');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getFromName')
            ->willReturn('John Doe');

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getEmail')
            ->willReturn('customer.address@example.com');

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getFirstName')
            ->willReturn('Customer Firstname');

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getLastName')
            ->willReturn('Customer Lastname');

        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('getMailjetTemplate')
            ->willReturn($this->mailjetTemplateTransferMock);

        $this->mailjetTemplateTransferMock->expects(static::atLeastOnce())
            ->method('getTemplateId')
            ->willReturn(123);

        $this->mailjetTemplateTransferMock->expects(static::atLeastOnce())
            ->method('getTemplateId')
            ->willReturn(123);

        $this->mailjetTemplateTransferMock->expects(static::atLeastOnce())
            ->method('getVariables')
            ->willReturn([]);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getTemplateLanguage')
            ->willReturn(true);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSandboxMode')
            ->willReturn(false);

        $this->mailer->sendMail($this->mailTransferMock);
    }

    /**
     * @return void
     */
    public function testDontSendMail(): void
    {
        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getFromEmail')
            ->willReturn('john.doe@fondof.de');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getFromName')
            ->willReturn('John Doe');

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getEmail')
            ->willReturn('customer.address@example.com');

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getFirstName')
            ->willReturn('Customer Firstname');

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getLastName')
            ->willReturn('Customer Lastname');

        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('getMailjetTemplate')
            ->willReturn($this->mailjetTemplateTransferMock);

        $this->mailjetTemplateTransferMock->expects(static::atLeastOnce())
            ->method('getTemplateId')
            ->willReturn(123);

        $this->mailjetTemplateTransferMock->expects(static::atLeastOnce())
            ->method('getTemplateId')
            ->willReturn(123);

        $this->mailjetTemplateTransferMock->expects(static::atLeastOnce())
            ->method('getVariables')
            ->willReturn([]);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getTemplateLanguage')
            ->willReturn(true);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSandboxMode')
            ->willReturn(true);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getWhitelistedEmails')
            ->willReturn(['test@example.de']);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getWhitelistedTLD')
            ->willReturn(['fondof.de']);

        $this->configMock->expects(self::atLeastOnce())
            ->method('getSandboxMode')
            ->willReturn(true);

        $this->mailer->sendMail($this->mailTransferMock);
    }

    /**
     * @return void
     */
    public function testSendMailWithWhitelistedTLD(): void
    {
        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getFromEmail')
            ->willReturn('john.doe@fondof.de');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getFromName')
            ->willReturn('John Doe');

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getEmail')
            ->willReturn('test@fondof.de');

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getFirstName')
            ->willReturn('Customer Firstname');

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getLastName')
            ->willReturn('Customer Lastname');

        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('getMailjetTemplate')
            ->willReturn($this->mailjetTemplateTransferMock);

        $this->mailjetTemplateTransferMock->expects(static::atLeastOnce())
            ->method('getTemplateId')
            ->willReturn(123);

        $this->mailjetTemplateTransferMock->expects(static::atLeastOnce())
            ->method('getTemplateId')
            ->willReturn(123);

        $this->mailjetTemplateTransferMock->expects(static::atLeastOnce())
            ->method('getVariables')
            ->willReturn([]);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getTemplateLanguage')
            ->willReturn(true);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getWhitelistedEmails')
            ->willReturn(['test@example.de']);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getWhitelistedTLD')
            ->willReturn(['fondof.de']);

        $this->configMock->expects(self::never())
            ->method('getSandboxMode');

        $this->mailer->sendMail($this->mailTransferMock);
    }

    /**
     * @return void
     */
    public function testSendMailWithWhitelistedEmail(): void
    {
        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getFromEmail')
            ->willReturn('john.doe@fondof.de');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getFromName')
            ->willReturn('John Doe');

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getEmail')
            ->willReturn('customer.address@example.com');

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getFirstName')
            ->willReturn('Customer Firstname');

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getLastName')
            ->willReturn('Customer Lastname');

        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('getMailjetTemplate')
            ->willReturn($this->mailjetTemplateTransferMock);

        $this->mailjetTemplateTransferMock->expects(static::atLeastOnce())
            ->method('getTemplateId')
            ->willReturn(123);

        $this->mailjetTemplateTransferMock->expects(static::atLeastOnce())
            ->method('getTemplateId')
            ->willReturn(123);

        $this->mailjetTemplateTransferMock->expects(static::atLeastOnce())
            ->method('getVariables')
            ->willReturn([]);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getTemplateLanguage')
            ->willReturn(true);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getWhitelistedEmails')
            ->willReturn(['customer.address@example.com']);

        $this->configMock->expects(static::never())
            ->method('getWhitelistedTLD');

        $this->configMock->expects(self::never())
            ->method('getSandboxMode');

        $this->mailer->sendMail($this->mailTransferMock);
    }
}
