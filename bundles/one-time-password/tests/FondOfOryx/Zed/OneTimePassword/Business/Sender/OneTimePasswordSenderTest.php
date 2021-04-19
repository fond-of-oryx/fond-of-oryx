<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Sender;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordGeneratorInterface;
use FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToOneTimePasswordEmailConnectorFacadeInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;

class OneTimePasswordSenderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\Sender\OneTimePasswordSender
     */
    protected $oneTimePasswordSender;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordGeneratorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordGeneratorMock;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToOneTimePasswordEmailConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordEmailConnectorFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\OneTimePasswordResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->oneTimePasswordGeneratorMock = $this->getMockBuilder(OneTimePasswordGeneratorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordEmailConnectorFacadeMock = $this->getMockBuilder(OneTimePasswordToOneTimePasswordEmailConnectorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordResponseTransferMock = $this->getMockBuilder(OneTimePasswordResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordSender = new OneTimePasswordSender(
            $this->oneTimePasswordGeneratorMock,
            $this->oneTimePasswordEmailConnectorFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testRequestOneTimePassword(): void
    {
        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('requireEmail')
            ->willReturnSelf();

        $this->oneTimePasswordGeneratorMock->expects($this->atLeastOnce())
            ->method('generateOneTimePassword')
            ->with($this->customerTransferMock)
            ->willReturn($this->oneTimePasswordResponseTransferMock);

        $this->oneTimePasswordResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccess')
            ->willReturn(true);

        $this->oneTimePasswordEmailConnectorFacadeMock->expects($this->atLeastOnce())
            ->method('sendOneTimePasswordMail')
            ->with($this->oneTimePasswordResponseTransferMock);

        $this->assertSame(
            $this->oneTimePasswordResponseTransferMock,
            $this->oneTimePasswordSender->requestOneTimePassword(
                $this->customerTransferMock
            )
        );
    }
}
