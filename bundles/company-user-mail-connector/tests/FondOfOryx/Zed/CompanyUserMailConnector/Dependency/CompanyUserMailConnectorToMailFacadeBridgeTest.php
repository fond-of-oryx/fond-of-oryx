<?php

namespace FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\MailTransfer;
use Spryker\Zed\Mail\Business\MailFacadeInterface;

class CompanyUserMailConnectorToMailFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade\CompanyUserMailConnectorToMailFacadeInterface
     */
    protected $facadeBridge;

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
        parent::_before();

        $this->mailTransferMock = $this->getMockBuilder(MailTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailFacadeMock = $this->getMockBuilder(MailFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeBridge = new CompanyUserMailConnectorToMailFacadeBridge($this->mailFacadeMock);
    }

    /**
     * @return void
     */
    public function testHandleMail(): void
    {
        $this->mailFacadeMock->expects(static::atLeastOnce())
            ->method('handleMail')
            ->with($this->mailTransferMock);

        $this->facadeBridge->handleMail($this->mailTransferMock);
    }
}
