<?php

namespace FondOfOryx\Zed\CompanyUserMailConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUserMailConnector\Business\Model\Mail\CompanyUserCreationNotificationMailHandlerInterface;
use FondOfOryx\Zed\CompanyUserMailConnector\Business\Model\Mail\MailHandlerInterface;
use Generated\Shared\Transfer\CompanyUserTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class CompanyUserMailConnectorFacadeTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUserTransfer|MockObject $companyUserTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\Business\CompanyUserMailConnectorFacadeInterface
     */
    protected CompanyUserMailConnectorFacadeInterface $facade;

    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\Business\CompanyUserMailConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUserMailConnectorBusinessFactory|MockObject $factoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\Business\Model\Mail\MailHandlerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MailHandlerInterface|MockObject $mailHandlerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\Business\Model\Mail\CompanyUserCreationNotificationMailHandlerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUserCreationNotificationMailHandlerInterface|MockObject $notificationMailHandlerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyUserTransferMock = $this
            ->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this->getMockBuilder(CompanyUserMailConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailHandlerMock = $this->getMockBuilder(MailHandlerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->notificationMailHandlerMock = $this->getMockBuilder(CompanyUserCreationNotificationMailHandlerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompanyUserMailConnectorFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testSendMail(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createMailHandler')
            ->willReturn($this->mailHandlerMock);

        $this->mailHandlerMock->expects(static::atLeastOnce())
            ->method('sendMail')
            ->willReturn($this->companyUserTransferMock);

        static::assertInstanceOf(
            CompanyUserTransfer::class,
            $this->facade->sendMail($this->companyUserTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testSendInformationMail(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCompanyUserCreationNotificationMailHandler')
            ->willReturn($this->notificationMailHandlerMock);

        $this->notificationMailHandlerMock->expects(static::atLeastOnce())
            ->method('sendCustomerNotificationMails')
            ->willReturn($this->companyUserTransferMock);

        static::assertInstanceOf(
            CompanyUserTransfer::class,
            $this->facade->sendCustomerNotificationMails($this->companyUserTransferMock),
        );
    }
}
