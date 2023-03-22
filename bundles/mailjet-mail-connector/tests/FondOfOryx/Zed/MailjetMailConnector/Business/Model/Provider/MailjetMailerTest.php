<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business\Model\Provider;

use Codeception\Test\Unit;
use FondOfOryx\Zed\MailjetMailConnector\MailjetMailConnectorConfig;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\MailjetTemplateTransfer;
use Generated\Shared\Transfer\MailTransfer;
use Mailjet\Client;

class MailjetMailerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\MailjetMailConnectorConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Mailjet\Client|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailjetClientMock;

    /**
     * @var \Generated\Shared\Transfer\MailTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \Generated\Shared\Transfer\MailjetTemplateTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailjetTemplateTransferMock;

    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\Business\Model\Provider\MailjetMailer
     */
    protected $mailer;

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

        $this->mailer = new MailjetMailer($this->configMock, $this->mailjetClientMock);
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
            ->method('getWhitelistedTLD')
            ->willReturn(['fondof.de']);

        $this->configMock->expects(self::never())
            ->method('getSandboxMode');

        $this->mailer->sendMail($this->mailTransferMock);
    }
}
