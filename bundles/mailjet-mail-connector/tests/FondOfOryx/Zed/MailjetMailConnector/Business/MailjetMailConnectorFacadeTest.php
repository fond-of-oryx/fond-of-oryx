<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\MailjetMailConnector\Business\Model\Provider\MailjetMailer;
use Generated\Shared\Transfer\MailTransfer;

class MailjetMailConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\Business\MailjetMailConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\Business\Model\Provider\MailjetMailer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailjetMailerMock;

    /**
     * @var \Generated\Shared\Transfer\MailTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailTransferMock;

    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\Business\MailjetMailConnectorFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(MailjetMailConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailjetMailerMock = $this->getMockBuilder(MailjetMailer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailTransferMock = $this->getMockBuilder(MailTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new MailjetMailConnectorFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testSendMail(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createMailjetMailer')
            ->willReturn($this->mailjetMailerMock);

        $this->mailjetMailerMock->expects(static::atLeastOnce())
            ->method('sendMail')
            ->with($this->mailTransferMock);

        $this->facade->sendMail($this->mailTransferMock);
    }
}
