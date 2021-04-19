<?php

namespace FondOfOryx\Zed\OneTimePasswordEmailConnector\Business;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;

class OneTimePasswordEmailConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OneTimePasswordEmailConnector\Business\OneTimePasswordEmailConnectorFacade
     */
    protected $oneTimePasswordEmailConnectorFacade;

    /**
     * @var \FondOfOryx\Zed\OneTimePasswordEmailConnector\Business\OneTimePasswordEmailConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordEmailConnectorBusinessFactoryMock;

    /**
     * @var \Generated\Shared\Transfer\OneTimePasswordResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\OneTimePasswordEmailConnector\Business\OneTimePasswordEmailConnectorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordEmailConnectorMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->oneTimePasswordEmailConnectorBusinessFactoryMock = $this->getMockBuilder(OneTimePasswordEmailConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordResponseTransferMock = $this->getMockBuilder(OneTimePasswordResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordEmailConnectorMock = $this->getMockBuilder(OneTimePasswordEmailConnectorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordEmailConnectorFacade = new OneTimePasswordEmailConnectorFacade();
        $this->oneTimePasswordEmailConnectorFacade->setFactory($this->oneTimePasswordEmailConnectorBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testSendOneTimePasswordMail(): void
    {
        $this->oneTimePasswordEmailConnectorBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createOneTimePasswordEmailConnector')
            ->willReturn($this->oneTimePasswordEmailConnectorMock);

        $this->oneTimePasswordEmailConnectorMock->expects($this->atLeastOnce())
            ->method('sendOneTimePasswordMail')
            ->with($this->oneTimePasswordResponseTransferMock);

        $this->oneTimePasswordEmailConnectorFacade->sendOneTimePasswordMail($this->oneTimePasswordResponseTransferMock);
    }
}
