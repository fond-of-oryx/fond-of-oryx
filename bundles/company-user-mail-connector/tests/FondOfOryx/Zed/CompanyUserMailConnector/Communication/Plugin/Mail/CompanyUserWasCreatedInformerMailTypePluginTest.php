<?php

namespace FondOfOryx\Zed\CompanyUserMailConnector\Communication\Plugin\CompanyUsersRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUserMailConnector\Communication\Plugin\Mail\CompanyUserWasCreatedInformerMailTypePlugin;
use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\NotificationCustomerTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Mail\Business\Model\Mail\Builder\MailBuilderInterface;

class CompanyUserWasCreatedInformerMailTypePluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\NotificationCustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected NotificationCustomerTransfer|MockObject $notificationCustomerTransferMock;

    /**
     * @var \Spryker\Zed\Mail\Business\Model\Mail\Builder\MailBuilderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MailBuilderInterface|MockObject $mailBuilderMock;

    /**
     * @var \Generated\Shared\Transfer\MailTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MailTransfer|MockObject $mailTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\Communication\Plugin\Mail\CompanyUserWasCreatedInformerMailTypePlugin
     */
    protected CompanyUserWasCreatedInformerMailTypePlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->mailBuilderMock = $this->getMockBuilder(MailBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailTransferMock = $this->getMockBuilder(MailTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->notificationCustomerTransferMock = $this->getMockBuilder(NotificationCustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanyUserWasCreatedInformerMailTypePlugin();
    }

    /**
     * @return void
     */
    public function testBuild(): void
    {
        $this->mailBuilderMock->expects(static::atLeastOnce())
            ->method('getMailTransfer')
            ->willReturn($this->mailTransferMock);

        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('requireNotifyCustomer')
            ->willReturnSelf();

        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('getNotifyCustomer')
            ->willReturn($this->notificationCustomerTransferMock);

        $this->notificationCustomerTransferMock->expects(static::atLeastOnce())
            ->method('getEmail')
            ->willReturn('max.mustermann@example.com');

        $this->notificationCustomerTransferMock->expects(static::atLeastOnce())
            ->method('getFirstName')
            ->willReturn('Max');

        $this->notificationCustomerTransferMock->expects(static::atLeastOnce())
            ->method('getLastName')
            ->willReturn('Mustermann');

        $this->plugin->build($this->mailBuilderMock);
    }

    /**
     * @return void
     */
    public function testGetName(): void
    {
        static::assertEquals('company user was created notification type', $this->plugin->getName());
    }
}
