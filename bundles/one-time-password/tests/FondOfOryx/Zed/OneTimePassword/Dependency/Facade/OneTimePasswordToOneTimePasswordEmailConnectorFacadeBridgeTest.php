<?php

namespace FondOfOryx\Zed\OneTimePassword\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OneTimePasswordEmailConnector\Business\OneTimePasswordEmailConnectorFacadeInterface;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;

class OneTimePasswordToOneTimePasswordEmailConnectorFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToOneTimePasswordEmailConnectorFacadeBridge
     */
    protected $oneTimePasswordEmailConnectorFacadeBridge;

    /**
     * @var \FondOfOryx\Zed\OneTimePasswordEmailConnector\Business\OneTimePasswordEmailConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordEmailConnectorFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\OneTimePasswordResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordResponseTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->oneTimePasswordEmailConnectorFacadeMock = $this->getMockBuilder(OneTimePasswordEmailConnectorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordResponseTransferMock = $this->getMockBuilder(OneTimePasswordResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordEmailConnectorFacadeBridge = new OneTimePasswordToOneTimePasswordEmailConnectorFacadeBridge(
            $this->oneTimePasswordEmailConnectorFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testSendOneTimePasswordMail(): void
    {
        $this->oneTimePasswordEmailConnectorFacadeMock->expects($this->atLeastOnce())
            ->method('sendOneTimePasswordMail')
            ->with($this->oneTimePasswordResponseTransferMock);

        $this->oneTimePasswordEmailConnectorFacadeBridge->sendOneTimePasswordMail(
            $this->oneTimePasswordResponseTransferMock
        );
    }
}
