<?php

namespace FondOfOryx\Zed\CompanyUserMailConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUserMailConnector\Business\Model\Mail\MailHandlerInterface;
use Generated\Shared\Transfer\CompanyUserTransfer;

class CompanyUserMailConnectorFacadeTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $companyUserTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\Business\CompanyUserMailConnectorFacadeInterface
     */
    protected $facade;

    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\Business\CompanyUserMailConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\Business\Model\Mail\MailHandlerInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $mailHandlerMock;

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
}
